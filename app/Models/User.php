<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'password', 'role', 'class_id'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function createdMaterials()
    {
        return $this->hasMany(Material::class, 'created_by');
    }

    public function createdQuizzes()
    {
        return $this->hasMany(Quiz::class, 'created_by');
    }

    public function createdChallenges()
    {
        return $this->hasMany(Challenge::class, 'created_by');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'user_id');
    }

    public function reviewedSubmissions()
    {
        return $this->hasMany(Submission::class, 'reviewed_by');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function materialProgress()
    {
        return $this->hasMany(MaterialProgress::class);
    }
}
