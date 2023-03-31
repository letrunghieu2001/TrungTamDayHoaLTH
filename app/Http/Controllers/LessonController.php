<?php

namespace App\Http\Controllers;

use App\Models\ChemistryClass;
use App\Models\Exam;
use App\Models\ExamInLesson;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function store(Request $request, ChemistryClass $class)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        Lesson::create([
            'class_id' => $class->id,
            'name' => $request->name
        ]);

        return back()->with('succes', 'Tạo bài học thành công');
    }

    public function storeExam(Request $request, ChemistryClass $class, Lesson $lesson)
    {
        ExamInLesson::create([
            'lesson_id' => $lesson->id,
            'exam_id' => $request->exam_id,
        ]);

        return back()->with('succes', 'Thêm bài kiểm tra thành công');
    }

    public function destroyExam(Lesson $lesson, Exam $exam)
    {
        ExamInLesson::where('lesson_id', $lesson->id)->where('exam_id', $exam->id)->delete();
        return back()->with('succes', 'Xóa thành công');
    }

    public function update(Request $request,Lesson $lesson)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        DB::table('lessons')->where('id', $lesson->id)->update([
            'name' => $request->name
        ]);

        return back()->with('succes', 'Sửa thành công');
    }
}
