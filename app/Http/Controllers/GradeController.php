<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function storeGrade(Request $request, Exam $exam, User $user, Lesson $lesson)
    {
        $grade = 0;
        foreach ($request->id as $item) {
            $question = Question::where('exam_id', $exam->id)->where('id', $item)->first();
            $user_answer = $request->input("answer" . $item);
            if ($user_answer == $question->answer_correct) {
                $grade = $grade + 1;
            }
            ExamResult::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'answer' => $user_answer
            ]);
        }

        $grade = number_format(($grade) * 10 / ($exam->number_questions), 2);
        Grade::create([
            'grade' => $grade,
            'student_id' => $user->id,
            'exam_id' => $exam->id,
            'lesson_id' => $lesson->id
        ]);

        return redirect()->route('exam.result-exam', [$exam->id, $lesson->id, Auth::user()->id]);
    }

    public function myGrade()
    {
        $user = Auth::user();
        $exams = Exam::join('lesson_exams', 'lesson_exams.exam_id', '=', 'exams.id')
            ->join('lessons', 'lessons.id', '=', 'lesson_exams.lesson_id')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->join('grades', 'grades.exam_id', '=', 'exams.id')
            ->join('class_students', 'class_students.id', '=', 'classes.id')
            ->where('grades.student_id', $user->id)
            ->select('classes.name AS class_name', 'lessons.name as lesson_name', 'exams.name as exam_name', 'exams.id as exam_id', 'grades.grade', 'lessons.id as lesson_id')
            ->get();

        return view('pages.grade-management.my-grade', compact('user', 'exams'));
    }

    public function index(Request $request)
    {
        $query = User::query()->where('role_id', '3');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $users = $query->latest()->paginate(9);

        return view('pages.grade-management.index', compact('users'));
    }
    public function show(User $user)
    {
        $exams = Exam::join('lesson_exams', 'lesson_exams.exam_id', '=', 'exams.id')
            ->join('lessons', 'lessons.id', '=', 'lesson_exams.lesson_id')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->join('grades', 'grades.exam_id', '=', 'exams.id')
            ->join('class_students', 'class_students.id', '=', 'classes.id')
            ->where('grades.student_id', $user->id)
            ->select('classes.name AS class_name', 'lessons.name as lesson_name', 'exams.name as exam_name', 'exams.id as exam_id', 'grades.grade', 'lessons.id as lesson_id')
            ->get();

        return view('pages.grade-management.show', compact('user', 'exams'));
    }
}
