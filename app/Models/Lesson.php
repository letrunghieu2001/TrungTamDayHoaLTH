<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $table = 'lessons';

    public function lesson_details()
    {
        return $this->hasMany(LessonDetail::class);
    }
    
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'lesson_exams', 'lesson_id', 'exam_id');
    }

}
