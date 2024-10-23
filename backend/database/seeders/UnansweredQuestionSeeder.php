<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnansweredQuestions;

class UnansweredQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnansweredQuestions::insert([
            ['question' => 'What is the address of the college?', 'answer' => 'The address of the college is 123 Main St.'],
            ['question' => 'How do I apply for financial aid?', 'answer' => 'You can apply for financial aid through the college website.'],
            ['question' => 'What are the office hours of the registrar?', 'answer' => 'The office hours of the registrar are from 9am to 5pm.'],
            ['question' => 'Can I change my major after the first semester?', 'answer' => 'Yes, you can change your major after the first semester.'],
            ['question' => 'How do I access the college\'s online library resources?', 'answer' => 'You can access the college\'s online library resources through the college website.'],
            ['question' => 'What is the deadline for course registration?', 'answer' => null],
        ]);
    }
}
