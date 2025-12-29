<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function start(Request $request)
    {
        $identity = $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $request->session()->put('quiz.identity', $identity);

        return redirect()->route('quiz.show');
    }

    public function quiz(Request $request)
    {
        $identity = $request->session()->get('quiz.identity');
        if (!$identity) {
            return redirect()->route('home')->withErrors([
                'nama' => 'Isi identitas dulu ya.',
            ]);
        }

        // Ambil semua pertanyaan acak
        $questions = Question::inRandomOrder()->get();

        return view('quiz', [
            'questions' => $questions,
            'nama' => $identity['nama'],
        ]);
    }

    public function submit(Request $request)
    {
        $identity = $request->session()->get('quiz.identity');
        if (!$identity) {
            return redirect()->route('home')->withErrors([
                'nama' => 'Isi identitas dulu ya.',
            ]);
        }

        $data = $request->validate([
            'answers' => 'required|array', // Array jawaban ID Pertanyaan => Skala 1-5
            'answers.*' => 'required|integer|min:1|max:5',
        ]);

        $scores = [
            'femboy' => 0,
            'jomok' => 0,
            'introvert' => 0,
            'pedo' => 0,
            'normal' => 0,
        ];

        $maxScores = $scores; // Untuk menghitung persentase (Total soal per kategori * 5)

        // Hitung Skor
        foreach ($data['answers'] as $questionId => $score) {
            $question = Question::find($questionId);
            if ($question) {
                $score = (int)$score;
                $weights = $question->weights;

                if (is_array($weights) && !empty($weights)) {
                    $answerWeights = $weights[(string)$score] ?? [];
                    if (is_array($answerWeights)) {
                        foreach ($answerWeights as $cat => $points) {
                            if (!array_key_exists($cat, $scores)) {
                                $scores[$cat] = 0;
                                $maxScores[$cat] = 0;
                            }
                            $scores[$cat] += (int)$points;
                        }
                    }

                    $maxByCategory = [];
                    foreach ($weights as $weightSet) {
                        if (!is_array($weightSet)) {
                            continue;
                        }
                        foreach ($weightSet as $cat => $points) {
                            $points = (int)$points;
                            if (!isset($maxByCategory[$cat]) || $points > $maxByCategory[$cat]) {
                                $maxByCategory[$cat] = $points;
                            }
                        }
                    }

                    foreach ($maxByCategory as $cat => $points) {
                        if (!array_key_exists($cat, $scores)) {
                            $scores[$cat] = 0;
                            $maxScores[$cat] = 0;
                        }
                        $maxScores[$cat] += $points;
                    }
                } else {
                    $category = $question->category;
                    if (!array_key_exists($category, $scores)) {
                        $scores[$category] = 0;
                        $maxScores[$category] = 0;
                    }
                    // Tambahkan skor user
                    $scores[$category] += $score;
                    // Tambahkan potensi skor maksimal (tiap soal max 5 poin)
                    $maxScores[$category] += 5;
                }
            }
        }

        // Hitung Persentase
        $percentages = [];
        foreach ($scores as $cat => $score) {
            if ($maxScores[$cat] > 0) {
                $percentages[$cat] = round(($score / $maxScores[$cat]) * 100);
            } else {
                $percentages[$cat] = 0;
            }
        }

        // Cari dominan
        arsort($percentages); // Urutkan dari yang terbesar
        $dominantTrait = array_key_first($percentages);
        $dominantScore = $percentages[$dominantTrait];
        $labels = $this->categoryLabels();
        $dominantLabel = $labels[$dominantTrait] ?? ucfirst($dominantTrait);

        // Logika "Introvert > 70%" digabung
        $isIntrovertSevere = $percentages['introvert'] > 70;
        $finalResultTitle = $dominantLabel;

        if ($dominantTrait != 'introvert' && $isIntrovertSevere) {
            $finalResultTitle = $dominantLabel . " dan Introvert";
        }

        return view('result', [
            'nama' => $identity['nama'],
            'percentages' => $percentages,
            'dominantTitle' => $finalResultTitle,
            'dominantTraitKey' => $dominantTrait,
            'dominantScore' => $dominantScore,
            'categoryLabels' => $labels,
        ]);
    }

    private function categoryLabels(): array
    {
        return [
            'normal' => 'Normal',
            'introvert' => 'Introvert',
            'jomok' => 'Jomok',
            'femboy' => 'Femboy',
            'pedo' => 'Pedo',
            'psikis' => 'Pedo',
        ];
    }
}
