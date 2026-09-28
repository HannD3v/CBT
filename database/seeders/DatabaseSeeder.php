<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\SchoolClass;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \App\Models\Category::truncate();
        Material::truncate();
        Quiz::truncate();
        Question::truncate();
        Answer::truncate();
        User::truncate();
        SchoolClass::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $classes = $this->createClasses();
        $admin = $this->createAdmin();
        $students = $this->createStudents($classes);
        $categories = $this->createCategories();
        $materials = $this->createMaterials($categories, $admin);
        $quizzes = $this->createQuizzes($materials, $admin);
        $questions = $this->createQuestions($quizzes);
        $this->createAnswers($questions);
    }

    private function createClasses(): array
    {
        $classList = [
            'PPLG X-1', 'PPLG XI-1',
            'DKV X-1', 'DKV XI-1',
            'MPLB X-1', 'MPLB XI-1',
        ];

        return collect($classList)->map(fn ($className) => SchoolClass::create(['name' => $className]))->all();
    }

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Pembina',
            'username' => 'pembina',
            'password' => Hash::make('password'),
            'role' => 'pembina',
            'class_id' => null,
        ]);
    }

    private function createStudents(array $classes): array
    {
        $students = [];

        foreach ($classes as $class) {
            for ($i = 1; $i <= 3; $i++) {
                $students[] = User::create([
                    'name' => "Siswa {$class->name} - {$i}",
                    'username' => "siswa_{$class->name}_{$i}",
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                    'class_id' => $class->id,
                ]);
            }
        }

        return $students;
    }

    private function createCategories(): array
    {
        $categories = ['Grammar', 'Vocabulary', 'Reading', 'Writing', 'Listening'];

        return collect($categories)->map(fn ($name) => \App\Models\Category::create(['name' => $name]))->all();
    }

    private function createMaterials(array $categories, User $admin): array
    {
        $materials = [];

        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                $materials[] = Material::create([
                    'category_id' => $category->id,
                    'created_by' => $admin->id,
                    'title' => "Materi {$category->name} - Part {$i}",
                    'content' => "Isi konten materi {$category->name} bagian {$i}. Ini adalah contoh konten dummy untuk testing.",
                ]);
            }
        }

        return $materials;
    }

    private function createQuizzes(array $materials, User $admin): array
    {
        $quizzes = [];

        foreach ($materials as $material) {
            $quizzes[] = Quiz::create([
                'material_id' => $material->id,
                'created_by' => $admin->id,
                'title' => "Quiz {$material->title}",
                'type' => 'quiz',
            ]);
        }

        return $quizzes;
    }

    private function createQuestions(array $quizzes): array
    {
        $questions = [];

        foreach ($quizzes as $quiz) {
            for ($i = 1; $i <= 5; $i++) {
                $questions[] = Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => "Soal nomor {$i} dari quiz {$quiz->title}. Apa jawaban yang benar?",
                ]);
            }
        }

        return $questions;
    }

    private function createAnswers(array $questions): void
    {
        foreach ($questions as $question) {
            for ($i = 1; $i <= 4; $i++) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => "Pilihan jawaban {$i}",
                    'is_correct' => $i === 1,
                ]);
            }
        }
    }
}
