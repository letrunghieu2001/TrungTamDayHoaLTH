<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentsInClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'class_students';
}
