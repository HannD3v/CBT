<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Material;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

// Controller untuk kelola quiz (pembina CRUD quiz & soal, siswa view quiz)
// Alur pembina: buat quiz -> tambah soal & jawaban -> siswa lihat quiz -> siswa kerjakan (di QuizAttemptController)
class QuizController extends Controller
{
    // Method index: tampilkan daftar semua quiz
    // Alur: ambil semua quiz -> load relasi materi & jumlah soal -> tampilkan dalam tabel
    // Return: view daftar quiz dengan data quiz, materi terkait, dan jumlah soal
    public function index()
    {
        // Ambil semua quiz dengan relasi materi dan soal, pagination 10 per halaman
        $quizzes = Quiz::with(['material', 'questions'])->latest()->paginate(10);

        return view('quizzes.index', compact('quizzes'));
    }

    // Method create: tampilkan form tambah quiz baru (khusus pembina)
    // Return: view form tambah quiz dengan dropdown materi
    public function create()
    {
        // Ambil semua materi untuk dropdown (quiz bisa dikaitkan ke materi atau standalone untuk diagnostic)
        $materials = Material::all();

        return view('quizzes.create', compact('materials'));
    }

    // Method store: proses tambah quiz baru (khusus pembina)
    // Alur: validasi input -> simpan quiz dengan created_by = pembina -> redirect ke halaman quiz untuk tambah soal
    // Input: material_id (opsional, ID materi terkait), title (judul quiz), type (jenis: 'quiz' atau 'diagnostic')
    // Return: redirect ke halaman detail quiz dengan notifikasi sukses
    public function store(Request $request)
    {
        // Validasi input: materi opsional (nullable), title wajib, type harus 'quiz' atau 'diagnostic'
        $validated = $request->validate([
            'material_id' => 'nullable|exists:materials,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:quiz,diagnostic',
        ]);

        // Set created_by otomatis dari pembina yang sedang login
        $validated['created_by'] = auth()->id();

        // Simpan quiz ke database
        $quiz = Quiz::create($validated);

        // Redirect ke halaman detail quiz agar pembina bisa tambah soal
        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Quiz berhasil dibuat. Silakan tambahkan soal.');
    }

    // Method show: tampilkan detail quiz beserta soal dan jawaban
    // Alur: ambil quiz -> load relasi materi, soal, dan jawaban -> tampilkan dalam view
    // Params: $quiz (model Quiz yang akan ditampilkan)
    // Return: view detail quiz dengan data quiz, soal, dan jawaban
    public function show(Quiz $quiz)
    {
        // Load relasi materi dan soal beserta jawabannya
        $quiz->load(['material', 'questions.answers']);

        return view('quizzes.show', compact('quiz'));
    }

    // Method storeQuestion: proses tambah soal & jawaban ke quiz (khusus pembina)
    // Alur: validasi input -> buat soal baru -> buat jawaban dengan 1 jawaban benar -> redirect
    // Params: $quiz (model Quiz yang akan ditambahkan soalnya)
    // Input: question_text (teks soal), answers (array jawaban), correct_answer (index jawaban benar)
    // Return: redirect kembali ke halaman quiz dengan notifikasi sukses
    public function storeQuestion(Request $request, Quiz $quiz)
    {
        // Validasi input: teks soal wajib, minimal 2 jawaban, harus ada jawaban benar
        $validated = $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2', // Minimal 2 pilihan jawaban
            'answers.*.answer_text' => 'required|string', // Setiap jawaban wajib diisi
            'correct_answer' => 'required|integer', // Index jawaban yang benar (0, 1, 2, 3)
        ]);

        // Buat soal baru terkait quiz ini
        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $validated['question_text'],
        ]);

        // Loop semua jawaban dan simpan ke database
        foreach ($validated['answers'] as $index => $answerData) {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $answerData['answer_text'],
                'is_correct' => $index == $validated['correct_answer'], // Tandai jawaban benar
            ]);
        }

        return back()->with('success', 'Soal berhasil ditambahkan.');
    }

    // Method destroy: hapus quiz (khusus pembina)
    // Alur: hapus quiz dari database (cascade delete akan hapus soal, jawaban, dan attempts terkait) -> redirect
    // Params: $quiz (model Quiz yang akan dihapus)
    // Return: redirect ke daftar quiz dengan notifikasi sukses
    public function destroy(Quiz $quiz)
    {
        // Hapus quiz (cascade delete otomatis hapus soal, jawaban, quiz attempts, dll)
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz berhasil dihapus.');
    }
}
