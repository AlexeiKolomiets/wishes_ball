<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answers;

class AnswersTableSeeder extends Seeder
{
    protected $answers = [
        'Да',
        'Нет',
        'Возможно',
        'Вопрос не ясен',
        'Абсолютно точно',
        'Никогда',
        'Даже не думай',
        'Сконцентрируйся и спроси опять',
    ];
    public function run()
    {
        foreach ($this->answers as $answer) {
            Answers::insert([
                'answer' => $answer,
            ]);
        }
    }
}
