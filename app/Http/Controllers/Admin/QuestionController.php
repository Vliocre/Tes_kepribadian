<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::query()->orderBy('id', 'desc')->get();

        return view('admin.questions.index', [
            'questions' => $questions,
            'categoryLabels' => $this->categoryLabels(),
        ]);
    }

    public function create()
    {
        return view('admin.questions.form', [
            'question' => new Question(),
            'weights' => $this->blankWeights(),
            'categories' => $this->categories(),
            'categoryLabels' => $this->categoryLabels(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateQuestion($request);
        $data['weights'] = $this->extractWeights($request);

        Question::query()->create($data);

        return redirect()
            ->route('admin.questions.index')
            ->with('status', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Question $question)
    {
        $question->category = $this->normalizeCategory($question->category);

        return view('admin.questions.form', [
            'question' => $question,
            'weights' => $this->normalizeWeights($question->weights),
            'categories' => $this->categories(),
            'categoryLabels' => $this->categoryLabels(),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $data = $this->validateQuestion($request);
        $data['weights'] = $this->extractWeights($request);

        $question->update($data);

        return redirect()
            ->route('admin.questions.index')
            ->with('status', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()
            ->route('admin.questions.index')
            ->with('status', 'Pertanyaan berhasil dihapus.');
    }

    private function validateQuestion(Request $request): array
    {
        return $request->validate([
            'question_text' => 'required|string|max:500',
            'category' => 'required|string|in:' . implode(',', $this->categories()),
        ]);
    }

    private function categories(): array
    {
        return ['normal', 'introvert', 'jomok', 'femboy', 'pedo'];
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

    private function normalizeCategory(string $category): string
    {
        if ($category === 'psikis') {
            return 'pedo';
        }

        return $category;
    }

    private function blankWeights(): array
    {
        $weights = [];
        foreach (range(1, 5) as $score) {
            foreach ($this->categories() as $category) {
                $weights[$score][$category] = 0;
            }
        }

        return $weights;
    }

    private function normalizeWeights(?array $weights): array
    {
        $normalized = $this->blankWeights();
        if (!$weights) {
            return $normalized;
        }

        foreach (range(1, 5) as $score) {
            foreach ($this->categories() as $category) {
                $normalized[$score][$category] = (int)($weights[(string)$score][$category] ?? 0);
            }
        }

        return $normalized;
    }

    private function extractWeights(Request $request): ?array
    {
        $weightsInput = $request->input('weights', []);
        $weights = $this->blankWeights();
        $hasAny = false;

        foreach (range(1, 5) as $score) {
            foreach ($this->categories() as $category) {
                $value = (int)($weightsInput[$score][$category] ?? 0);
                if ($value < 0) {
                    $value = 0;
                }
                if ($value > 10) {
                    $value = 10;
                }
                if ($value > 0) {
                    $hasAny = true;
                }
                $weights[$score][$category] = $value;
            }
        }

        return $hasAny ? $weights : null;
    }
}
