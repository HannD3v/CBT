<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['category_id', 'created_by', 'title', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function progress()
    {
        return $this->hasMany(MaterialProgress::class);
    }
}
