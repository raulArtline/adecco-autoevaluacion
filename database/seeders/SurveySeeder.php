<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Survey::create([
            'client' => 'Artline',
            'question_id' => 1,
        ]);
        Survey::create([
            'client' => 'Artline',
            'question_id' => 1,
        ]);
        Survey::create([
            'client' => 'Enagas',
            'question_id' => 2,
        ]);
    }
}
