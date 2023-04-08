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

class ExamController extends Controller
{
    public function management(Request $request)
    {
        $query = Exam::query();

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', "%" . $q . "%");
            });
        }

        $exams = $query->latest()->paginate(9);
        return view('pages.exam-management.index', compact('exams'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'time' => 'required|numeric|min:1',
            'number_questions' => 'required|numeric|min:1|max:100',
        ]);
        Exam::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'time' => $request->time,
            'number_questions' => $request->number_questions
        ]);

        return back()->with('succes', 'Tạo đề thi thành công');
    }

    public function addQuestion(Exam $exam, Request $request)
    {
        $questions = Question::where('exam_id', $exam->id)->get();
        return view('pages.exam-management.add-question', compact('exam', 'questions'));
    }

    public function storeQuestion(Exam $exam, Request $request)
    {
        if (!Question::where('exam_id', $exam->id)->exists()) {
            for ($i = 1; $i <= $exam->number_questions; $i++) {
                Question::create([
                    'exam_id' => $exam->id,
                    'question' => $request->input("question" . $i),
                    'answer_1' => $request->input("answer_1" . $i),
                    'answer_2' => $request->input("answer_2" . $i),
                    'answer_3' => $request->input("answer_3" . $i),
                    'answer_4' => $request->input("answer_4" . $i),
                    'answer_correct' => $request->input("answer_correct" . $i),
                ]);
            };
        } else {
            foreach ($request->id as $item) {
                DB::table('questions')->where('exam_id', $exam->id)->where('id', $item)->update([
                    'exam_id' => $exam->id,
                    'question' => $request->input("question" . $item),
                    'answer_1' => $request->input("answer_1" . $item),
                    'answer_2' => $request->input("answer_2" . $item),
                    'answer_3' => $request->input("answer_3" . $item),
                    'answer_4' => $request->input("answer_4" . $item),
                    'answer_correct' => $request->input("answer_correct" . $item),
                ]);
            }
        };

        return redirect()->route('exam.management')->with('succes', 'Thêm câu hỏi thành công');
    }

    public function warningExam(Exam $exam, Lesson $lesson)
    {
        return view('pages.exam-management.warning-exam', compact('exam', 'lesson'));
    }

    public function doExam(Exam $exam, Lesson $lesson)
    {
        if (!Grade::where('lesson_id', $lesson->id)->where('student_id', Auth::user()->id)->where('exam_id', $exam->id)->exists()) {
            $questions = Question::where('exam_id', $exam->id)->get();
            return view('pages.exam-management.do-exam', compact('exam', 'questions', 'lesson'));
        } else {
            return redirect()->route('exam.result-exam', [$exam->id, $lesson->id, Auth::user()->id]);
        }
    }

    public function resultExam(Exam $exam, Lesson $lesson, User $user)
    {
        $questions = Question::where('exam_id', $exam->id)->get();
        $grade = Grade::where('exam_id', $exam->id)->where('lesson_id', $lesson->id)->where('student_id', $user->id)->first();
        foreach ($questions as $question) {
            $result[$question->id] = ExamResult::where('user_id', $user->id)->where('question_id', $question->id)->first();
        }
        return view('pages.exam-management.result', compact('exam', 'questions', 'lesson', 'grade', 'result'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'time' => 'required|numeric|min:1'
        ]);

        $exam->update([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'time' => $request->time,
        ]);

        return back()->with('succes', 'Thay đổi thông tin đề thi thành công');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return back()->with('succes', 'Xóa đề thi thành công');
    }
}
