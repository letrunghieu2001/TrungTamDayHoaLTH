<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ChemistryClass;
use App\Models\Lesson;
use App\Models\LessonDetail;
use App\Models\StudentsInClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonDetailController extends Controller
{
    public function store(Request $request, ChemistryClass $class, Lesson $lesson)
    {
        $validatedData = $request->validate([
            'content' => 'required|mimes:jpeg,png,jpg,zip,pdf,ppt, pptx, xlx, xlsx,docx,doc,gif,webm,mp4,mpeg',
        ]);

        $content = $request->content;
        if ($content != null) {
            $contentName = $content->getClientOriginalName();
            $content->storeAs('public/lesson-detail', $contentName);

            LessonDetail::create([
                'lesson_id' => $lesson->id,
                'content' => $contentName
            ]);
        }

        return back()->with('succes', 'Thêm dữ liệu thành công');
    }

    public function download(Request $request, ChemistryClass $class, Lesson $lesson, LessonDetail $lesson_detail)
    {
        $file = storage_path() . "/app/public/lesson-detail/" . $lesson_detail->content;

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            echo ('Không tìm thấy file.');
        }
    }

    public function addAttendance(ChemistryClass $class, Lesson $lesson)
    {
        $studentsList = User::join('class_students', 'class_students.student_id', '=', 'users.id')
            ->where('users.role_id', 3)
            ->where('class_students.class_id', $class->id)
            ->orderBy('lastname')
            ->get();

        return view('pages.class-management.attendance', compact('class', 'lesson', 'studentsList'));
    }

    public function storeAttendance(Request $request, ChemistryClass $class, Lesson $lesson)
    {
        $status = $request->status;
        $studentsList = User::join('class_students', 'class_students.student_id', '=', 'users.id')
            ->where('users.role_id', 3)
            ->where('class_students.class_id', $class->id)
            ->get();
        foreach ($studentsList as $student) {
            if (Attendance::where('lesson_id', $lesson->id)->where('student_id', $student->student_id)->exists()) {
                Attendance::where('lesson_id', $lesson->id)->where('student_id', $student->student_id)->update([
                    'status' => $status[$student->student_id]
                ]);
            } else {
                Attendance::create([
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->student_id,
                    'status' => $status[$student->student_id]
                ]);
            }
        };
        return redirect()->route('class.show', [$class->id])->with('succes', 'Điểm danh thành công');
    }

    public function destroy(LessonDetail $lesson_detail)
    {
        $lesson_detail->delete();
        return back()->with('succes', 'Xóa thành công');
    }
}
