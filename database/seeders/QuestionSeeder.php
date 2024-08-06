<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Tipo 1 questions
        Question::create([
            'name' => 'Tipo 1',
            'list_questions' => '1,2,3,4,5,6,7,8,9,10'
        ]);

        // Insert Tipo 2 questions
        Question::create([
            'name' => 'Tipo 2',
            'list_questions' => '1,2,3,4,5,8,9,10'
        ]);

        // Insert Tipo 3 questions
        Question::create([
            'name' => 'Tipo 3',
            'list_questions' => '1,2,3,4,5,8,10'
        ]);
    }
}
