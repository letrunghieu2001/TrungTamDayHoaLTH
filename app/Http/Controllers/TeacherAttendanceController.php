<?php

namespace App\Http\Controllers;

use App\Models\ChemistryClass;
use App\Models\Lesson;
use App\Models\TeacherAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function store(Request $request, ChemistryClass $class, Lesson $lesson, User $user)
    {
        $status = $request->status;
        $penalty_money = $request->penalty_money;
        if (TeacherAttendance::where('lesson_id', $lesson->id)->where('teacher_id', $user->id)->exists()) {
            TeacherAttendance::where('lesson_id', $lesson->id)->where('teacher_id', $user->id)->update([
                'status' => $status,
                'penalty_money' => -$penalty_money
            ]);
        } else {
            TeacherAttendance::create([
                'lesson_id' => $lesson->id,
                'teacher_id' => $user->id,
                'status' => $status,
                'penalty_money' => -$penalty_money
            ]);
        }

        return back()->with('succes', 'Chấm công thành công');
    }
}
