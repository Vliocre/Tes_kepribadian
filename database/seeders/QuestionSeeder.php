<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            // Femboy
            [
                'category' => 'femboy',
                'question_text' => 'Kamu lebih suka pake hoodie kegedean sampe tangan kamu ilang?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3, 'introvert' => 1],
                    '3' => ['normal' => 2, 'introvert' => 2],
                    '4' => ['femboy' => 4, 'introvert' => 1],
                    '5' => ['femboy' => 5, 'introvert' => 2],
                ],
            ],
            [
                'category' => 'femboy',
                'question_text' => 'Sering dikira cewek pas lagi chatan sama orang asing?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['normal' => 2, 'introvert' => 2],
                    '4' => ['femboy' => 4],
                    '5' => ['femboy' => 5, 'introvert' => 1],
                ],
            ],

            // Jomok (Meme context)
            [
                'category' => 'jomok',
                'question_text' => 'Kalau liat otot temen cowok, bawaannya pengen pegang?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['normal' => 2, 'introvert' => 1],
                    '4' => ['jomok' => 4],
                    '5' => ['jomok' => 4, 'femboy' => 2, 'introvert' => 1],
                ],
            ],
            [
                'category' => 'jomok',
                'question_text' => 'Sering bercanda "wangy-wangy" ke sesama jenis?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['jomok' => 2, 'normal' => 2],
                    '4' => ['jomok' => 4],
                    '5' => ['jomok' => 5, 'introvert' => 1],
                ],
            ],

            // Introvert
            [
                'category' => 'introvert',
                'question_text' => 'Lebih mending di kamar seharian daripada nongkrong di kafe?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['introvert' => 2, 'normal' => 2],
                    '4' => ['introvert' => 4],
                    '5' => ['introvert' => 5, 'pedo' => 1],
                ],
            ],
            [
                'category' => 'introvert',
                'question_text' => 'Kalau ada telpon masuk, kamu nunggu sampe mati baru chat "kenapa nelpon"?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['introvert' => 3],
                    '4' => ['introvert' => 4],
                    '5' => ['introvert' => 5, 'pedo' => 1],
                ],
            ],

            // Pedo
            [
                'category' => 'pedo',
                'question_text' => 'Sering ketawa sendiri padahal gak ada yang lucu?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['pedo' => 3],
                    '4' => ['pedo' => 4, 'introvert' => 1],
                    '5' => ['pedo' => 5, 'introvert' => 2],
                ],
            ],
            [
                'category' => 'pedo',
                'question_text' => 'Suka ngajak ngomong benda mati (guling, tembok)?',
                'weights' => [
                    '1' => ['normal' => 4],
                    '2' => ['normal' => 3],
                    '3' => ['pedo' => 3],
                    '4' => ['pedo' => 4],
                    '5' => ['pedo' => 5, 'introvert' => 1],
                ],
            ],

            // Normal
            [
                'category' => 'normal',
                'question_text' => 'Hidup kamu lempeng-lempeng aja kayak jalan tol?',
                'weights' => [
                    '1' => ['pedo' => 2, 'introvert' => 1],
                    '2' => ['normal' => 2, 'introvert' => 1],
                    '3' => ['normal' => 3],
                    '4' => ['normal' => 4],
                    '5' => ['normal' => 5],
                ],
            ],
            [
                'category' => 'normal',
                'question_text' => 'Mandi sehari minimal 2 kali?',
                'weights' => [
                    '1' => ['pedo' => 2, 'introvert' => 1],
                    '2' => ['normal' => 2],
                    '3' => ['normal' => 3],
                    '4' => ['normal' => 4],
                    '5' => ['normal' => 5],
                ],
            ],
        ];

        foreach ($questions as $question) {
            Question::query()->create($question);
        }
    }
}
