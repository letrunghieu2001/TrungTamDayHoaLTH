<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInLesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'lesson_exams';
}
