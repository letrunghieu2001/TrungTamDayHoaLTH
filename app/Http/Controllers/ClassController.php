<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\CalendarsInClass;
use App\Models\ChemistryClass;
use App\Models\ClassAnnouncement;
use App\Models\ClassCalendar;
use App\Models\Exam;
use App\Models\ExamInLesson;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonDetail;
use App\Models\StudentsInClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function management(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $query = ChemistryClass::query()->with('teacher', 'students', 'calendars');

            if ($request->has('q')) {
                $q = trim($request->input('q'));
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', "%" . $q . "%")
                        ->orWhere('unique_id', 'LIKE', "%" . $q . "%");
                });
            }

            $classes = $query->latest()->paginate(9);

            $calendars = CalendarsInClass::all();

            return view('pages.class-management.index', compact('classes', 'calendars'));
        } else if (Auth::user()->role_id == 2) {
            $query = ChemistryClass::query()->with('teacher', 'students', 'calendars');

            if ($request->has('q')) {
                $q = trim($request->input('q'));
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', "%" . $q . "%")
                        ->orWhere('unique_id', 'LIKE', "%" . $q . "%");
                });
            }

            $classes = $query->where('teacher_id', Auth::user()->id)->latest()->paginate(9);

            $calendars = CalendarsInClass::all();

            return view('pages.class-management.index', compact('classes', 'calendars'));
        } else if (Auth::user()->role_id == 3) {
            $query = ChemistryClass::query();

            if ($request->has('q')) {
                $q = trim($request->input('q'));
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', "%" . $q . "%")
                        ->orWhere('unique_id', 'LIKE', "%" . $q . "%");
                });
            }

            $classes = $query->join('class_students', 'class_students.class_id', '=', 'classes.id')->where('class_students.student_id', Auth::user()->id)->select('*','classes.id AS id')->with('teacher', 'students', 'calendars')->latest('classes.created_at')->paginate(9);

            $calendars = CalendarsInClass::all();

            return view('pages.class-management.index', compact('classes', 'calendars'));
        }
    }

    public function createStepOne(Request $request)
    {
        $class = $request->session()->get('class');
        return view('pages.class-management.create-step-one', compact('class'));
    }

    public function storeStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:classes',
            'price_per_student' => 'required|numeric',
            'status' => 'required'
        ]);

        if (empty($request->session()->get('class'))) {
            $class = new ChemistryClass();
            $class->fill($validatedData);
            $request->session()->put('class', $class);
        } else {
            $class = $request->session()->get('class');
            $class->fill($validatedData);
            $request->session()->put('class', $class);
        }

        return redirect()->route('class.create-step-two');
    }

    public function createStepTwo(Request $request)
    {
        $class = $request->session()->get('class');
        $query = User::query()->where('role_id', '2');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $teachers = $query->latest()->get();

        return view('pages.class-management.create-step-two', compact('teachers', 'class'));
    }

    public function storeStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required',
        ]);

        $class = $request->session()->get('class');
        $class->fill($validatedData);
        $request->session()->put('class', $class);
        $class->save();

        $request->session()->forget('class');

        return redirect()->route('class.show', [$class->id])->with('succes', 'Tạo lớp học thành công');
    }

    public function show(Request $request, ChemistryClass $class)
    {
        $lessons = Lesson::where('class_id', $class->id)->with('lesson_details', 'exams')->latest()->get();
        $announcements = ClassAnnouncement::where('class_id', $class->id)->with('user')->latest()->paginate(1);
        $exams = Exam::all();

        return view('pages.class-management.show', compact('class', 'lessons', 'announcements', 'exams'));
    }

    public function addStudent(Request $request, ChemistryClass $class)
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

        $studentsList = $query->latest()->get();

        return view('pages.class-management.add-student-into-class', compact('studentsList', 'studentsList', 'class'));
    }

    public function storeStudent(Request $request, ChemistryClass $class)
    {
        $request->session()->forget('class');
        $validatedData = $request->validate([
            'student_id' => 'required'
        ]);

        $students_id = $request->input('student_id');
        $class->students()->sync($students_id);
        return redirect()->route('class.show', [$class->id])->with('succes', 'Thay đổi học sinh thành công');
    }

    public function addCalendar(Request $request, ChemistryClass $class)
    {
        $calendars = Calendar::query()->latest()->paginate(9);
        return view('pages.class-management.add-calendar-into-class', compact('calendars', 'class'));
    }

    public function storeCalendar(Request $request, ChemistryClass $class)
    {
        $validatedData = $request->validate([
            'class_calendar_id' => 'required',
        ]);

        $class_calendars_id = $request->input('class_calendar_id');
        $class->calendars()->sync($class_calendars_id);

        return redirect()->route('class.show', [$class->id])->with('succes', 'Thêm lịch học thành công');
    }

    public function editTeacher(Request $request, ChemistryClass $class)
    {
        $query = User::query()->where('role_id', '2');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $teachers = $query->latest()->get();

        return view('pages.class-management.edit-teacher', compact('teachers', 'class'));
    }

    public function updateTeacher(Request $request, ChemistryClass $class)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required',
        ]);

        $class->update([
            'teacher_id' => $request->teacher_id
        ]);

        return redirect()->route('class.show', [$class->id])->with('succes', 'Thay đổi giáo viên thành công');
    }

    public function update(Request $request, ChemistryClass $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:classes,name,' . $class->id,
            'price_per_student' => 'required|numeric',
            'status' => 'required'
        ]);

        $class->update([
            'name' => $request->name,
            'price_per_student' => $request->price_per_student,
            'status' => $request->status
        ]);

        return back()->with('succes', 'Thay đổi thông tin lớp học thành công');
    }

    public function destroy(ChemistryClass $class)
    {
        $class->delete();
        return back()->with('succes', 'Lớp học trên đã bị ẩn');
    }

    public function deleteClass()
    {
        $classes = ChemistryClass::onlyTrashed()->with('teacher', 'students', 'calendars')->latest()->paginate(9);
        return view('pages.class-management.delete-class', compact('classes'));
    }

    public function restore($class)
    {
        ChemistryClass::onlyTrashed()->where('id', $class)->restore();
        return back()->with('succes', 'Lớp học trên đã được khôi phục');
    }

    public function restoreAll()
    {
        ChemistryClass::onlyTrashed()->restore();
        return back()->with('succes', 'Toàn bộ Lớp học đã được khôi phục');
    }

    public function forceDelete($class)
    {
        ChemistryClass::onlyTrashed()->where('id', $class)->forceDelete();
        return back()->with('succes', 'Lớp học trên đã bị xóa hoàn toàn khỏi hệ thống');
    }

    public function showAttendance(ChemistryClass $class)
    {
        $lessons = Lesson::where('class_id', $class->id)->with('lesson_details')->get();
        return view('pages.class-management.show-attendance', compact('class', 'lessons'));
    }

    public function showGrade(ChemistryClass $class)
    {
        $exams = Exam::join('lesson_exams', 'lesson_exams.exam_id', '=', 'exams.id')->join('lessons', 'lessons.id', '=', 'lesson_exams.lesson_id')->join('classes', 'classes.id', '=', 'lessons.class_id')->where('lessons.class_id', $class->id)->select('classes.name AS class_name', 'lessons.name as lesson_name', 'exams.name as exam_name', 'exams.id as exam_id')->get();
        return view('pages.class-management.show-grade', compact('class', 'exams'));
    }
}
