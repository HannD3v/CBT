<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'challenge_id',
        'user_id',
        'reviewed_by',
        'status',
        'content_text',
        'ai_feedback',
        'ai_assistance_score',
        'teacher_score',
        'teacher_comment',
    ];

    protected $casts = [
        'ai_assistance_score' => 'decimal:2',
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
