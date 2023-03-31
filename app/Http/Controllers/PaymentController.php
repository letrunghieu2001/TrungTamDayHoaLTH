<?php

namespace App\Http\Controllers;

use App\Models\AdminPayment;
use App\Models\Attendance;
use App\Models\ChemistryClass;
use App\Models\StudentPayment;
use App\Models\StudentsInClass;
use App\Models\TeacherAttendance;
use App\Models\TeacherPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function managementStudent(Request $request)
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

        foreach ($users as $user) {
            $start_date = Carbon::parse($user->created_at); // Lấy ra ngày tạo người dùng
            $start_month = $start_date->month; // Lấy ra tháng bắt đầu
            $start_year = $start_date->year; // Lấy ra năm bắt đầu

            $end_date = Carbon::now(); // Lấy ra thời gian hiện tại
            $end_month = $end_date->month; // Lấy ra tháng kết thúc
            $end_year = $end_date->year; // Lấy ra năm kết thúc

            $current_month = $start_month;
            $current_year = $start_year;

            $dates = [];

            while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
                $formatted_date = Carbon::createFromDate($current_year, $current_month, 1)->format('m/Y');
                $dates[] = $formatted_date;
                $current_month++;
                if ($current_month > 12) {
                    $current_month = 1;
                    $current_year++;
                }
            }
            $lessons = DB::table('lessons')
                ->join('classes', 'lessons.class_id', '=', 'classes.id')
                ->join('class_students', 'classes.id', '=', 'class_students.class_id')
                ->where('class_students.student_id', $user->id)
                ->select('*', 'classes.name AS class_name', 'lessons.name AS lesson_name', 'classes.id AS class_id', 'lessons.id AS lesson_id', 'lessons.created_at AS lesson_created_at')
                ->get();
            foreach ($dates as $date) {
                $money = 0;
                foreach ($lessons as $lesson) {
                    if (Attendance::where('lesson_id', $lesson->lesson_id)->where('student_id', $user->id)->where('status', 0)->exists()) {
                        $money += $lesson->price_per_student;
                    };
                }
                if (!StudentPayment::where('student_id', $user->id)->where('date', $date)->exists()) {
                    StudentPayment::create([
                        'student_id' => $user->id,
                        'date' => $date,
                        'status' => 1,
                        'money' => $money
                    ]);
                } else {
                    DB::table('payment_students')->where('student_id', $user->id)->where('date', $date)->update([
                        'money' => $money
                    ]);
                }
            };
        }

        return view('pages.payment-management.index-student', compact('users'));
    }

    public function showStudent(User $user)
    {
        $start_date = Carbon::parse($user->created_at); // Lấy ra ngày tạo người dùng
        $start_month = $start_date->month; // Lấy ra tháng bắt đầu
        $start_year = $start_date->year; // Lấy ra năm bắt đầu

        $end_date = Carbon::now(); // Lấy ra thời gian hiện tại
        $end_month = $end_date->month; // Lấy ra tháng kết thúc
        $end_year = $end_date->year; // Lấy ra năm kết thúc

        $current_month = $start_month;
        $current_year = $start_year;

        $dates = [];

        while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
            $formatted_date = Carbon::createFromDate($current_year, $current_month, 1)->format('m/Y');
            $dates[] = $formatted_date;
            $current_month++;
            if ($current_month > 12) {
                $current_month = 1;
                $current_year++;
            }
        }

        $lessons = DB::table('lessons')
            ->join('classes', 'lessons.class_id', '=', 'classes.id')
            ->join('class_students', 'classes.id', '=', 'class_students.class_id')
            ->where('class_students.student_id', $user->id)
            ->select('*', 'classes.name AS class_name', 'lessons.name AS lesson_name', 'classes.id AS class_id', 'lessons.id AS lesson_id', 'lessons.created_at AS lesson_created_at')
            ->get();

        return view('pages.payment-management.show-student', compact('user', 'lessons', 'dates'));
    }

    public function studentUpdateStatus(User $user, $dateMonth, $dateYear)
    {
        $date = $dateMonth . '/' . $dateYear;
        if (StudentPayment::where('status', 0)->where('student_id', $user->id)->where('date', $date)->exists()) {
            StudentPayment::where('student_id', $user->id)->where('date', $date)->update([
                'status' => '1',
            ]);
            return back()->with('succes', 'Thay đổi trạng thái thành công');
        }
        if (StudentPayment::where('status', 1)->where('student_id', $user->id)->where('date', $date)->exists()) {
            StudentPayment::where('student_id', $user->id)->where('date', $date)->update([
                'status' => '0',
            ]);
            return back()->with('succes', 'Thay đổi trạng thái thành công');
        }
    }

    public function managementTeacher(Request $request)
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

        $users = $query->latest()->paginate(9);

        foreach ($users as $user) {
            $start_date = Carbon::parse($user->created_at); // Lấy ra ngày tạo người dùng
            $start_month = $start_date->month; // Lấy ra tháng bắt đầu
            $start_year = $start_date->year; // Lấy ra năm bắt đầu

            $end_date = Carbon::now(); // Lấy ra thời gian hiện tại
            $end_month = $end_date->month; // Lấy ra tháng kết thúc
            $end_year = $end_date->year; // Lấy ra năm kết thúc

            $current_month = $start_month;
            $current_year = $start_year;

            $dates = [];

            while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
                $formatted_date = Carbon::createFromDate($current_year, $current_month, 1)->format('m/Y');
                $dates[] = $formatted_date;
                $current_month++;
                if ($current_month > 12) {
                    $current_month = 1;
                    $current_year++;
                }
            }

            $lessons = DB::table('lessons')
                ->join('classes', 'lessons.class_id', '=', 'classes.id')
                ->where('classes.teacher_id', $user->id)
                ->select('*', 'classes.name AS class_name', 'lessons.name AS lesson_name', 'classes.id AS class_id', 'lessons.id AS lesson_id', 'lessons.created_at AS lesson_created_at')
                ->get();

            foreach ($dates as $date) {
                $money = 0;
                foreach ($lessons as $lesson) {
                    if (Carbon::parse($lesson->lesson_created_at)->month == explode('/', $date)[0]) {
                        if (
                            TeacherAttendance::where('lesson_id', $lesson->lesson_id)->where('teacher_id', $user->id)->where('status', 2)->exists() ||
                            !TeacherAttendance::where('lesson_id', $lesson->lesson_id)->where('teacher_id', $user->id)->exists()
                        ) {
                            $money += 0;
                        } else {
                            $item = TeacherAttendance::where('lesson_id', $lesson->lesson_id)
                                ->where('teacher_id', $user->id)
                                ->first();
                            $penalty_money = $item->penalty_money;
                            $money += $lesson->price_per_student * 60 / 100 + $penalty_money;
                        }
                    };
                }
                if (!TeacherPayment::where('teacher_id', $user->id)->where('date', $date)->exists()) {
                    TeacherPayment::create([
                        'teacher_id' => $user->id,
                        'date' => $date,
                        'status' => 1,
                        'money'  => $money
                    ]);
                } else {
                    DB::table('payment_teachers')->where('teacher_id', $user->id)->where('date', $date)->update([
                        'money' => $money
                    ]);
                }
            };
        }

        return view('pages.payment-management.index-teacher', compact('users'));
    }

    public function showTeacher(User $user)
    {
        $start_date = Carbon::parse($user->created_at); // Lấy ra ngày tạo người dùng
        $start_month = $start_date->month; // Lấy ra tháng bắt đầu
        $start_year = $start_date->year; // Lấy ra năm bắt đầu

        $end_date = Carbon::now(); // Lấy ra thời gian hiện tại
        $end_month = $end_date->month; // Lấy ra tháng kết thúc
        $end_year = $end_date->year; // Lấy ra năm kết thúc

        $current_month = $start_month;
        $current_year = $start_year;

        $dates = [];

        while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
            $formatted_date = Carbon::createFromDate($current_year, $current_month, 1)->format('m/Y');
            $dates[] = $formatted_date;
            $current_month++;
            if ($current_month > 12) {
                $current_month = 1;
                $current_year++;
            }
        }

        $lessons = DB::table('lessons')
            ->join('classes', 'lessons.class_id', '=', 'classes.id')
            ->where('classes.teacher_id', $user->id)
            ->select('*', 'classes.name AS class_name', 'lessons.name AS lesson_name', 'classes.id AS class_id', 'lessons.id AS lesson_id', 'lessons.created_at AS lesson_created_at')
            ->get();

        return view('pages.payment-management.show-teacher', compact('user', 'lessons', 'dates'));
    }

    public function teacherUpdateStatus(User $user, $dateMonth, $dateYear)
    {
        $date = $dateMonth . '/' . $dateYear;
        if (TeacherPayment::where('status', 0)->where('teacher_id', $user->id)->where('date', $date)->exists()) {
            TeacherPayment::where('teacher_id', $user->id)->where('date', $date)->update([
                'status' => '1',
            ]);
            return back()->with('succes', 'Thay đổi trạng thái thành công');
        }
        if (TeacherPayment::where('status', 1)->where('teacher_id', $user->id)->where('date', $date)->exists()) {
            TeacherPayment::where('teacher_id', $user->id)->where('date', $date)->update([
                'status' => '0',
            ]);
            return back()->with('succes', 'Thay đổi trạng thái thành công');
        }
    }

    public function managementAdmin()
    {
        $start_month = 1; // Lấy ra tháng bắt đầu
        $start_year = 2023; // Lấy ra năm bắt đầu

        $end_date = Carbon::now(); // Lấy ra thời gian hiện tại
        $end_month = $end_date->month; // Lấy ra tháng kết thúc
        $end_year = $end_date->year; // Lấy ra năm kết thúc

        $current_month = $start_month;
        $current_year = $start_year;

        $dates = [];

        while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
            $formatted_date = Carbon::createFromDate($current_year, $current_month, 1)->format('m/Y');
            $dates[] = $formatted_date;
            $current_month++;
            if ($current_month > 12) {
                $current_month = 1;
                $current_year++;
            }
        }

        foreach ($dates as $date) {
            $moneyForTeacher = TeacherPayment::where('date', $date)->where('status', 0)->sum('money');
            $moneyForStudent = StudentPayment::where('date', $date)->where('status', 0)->sum('money');
            if (!AdminPayment::where('date', $date)->where('content', 'Trả lương cho giáo viên')->exists()) {
                AdminPayment::create([
                    'content' => 'Trả lương cho giáo viên',
                    'date' => $date,
                    'status' => 0,
                    'money' => -$moneyForTeacher
                ]);
            }
            if (!AdminPayment::where('date', $date)->where('content', 'Học phí của học sinh')->exists()) {
                AdminPayment::create([
                    'content' => 'Học phí của học sinh',
                    'date' => $date,
                    'status' => 1,
                    'money' => $moneyForStudent
                ]);
            }
            if (AdminPayment::where('date', $date)->where('content', 'Trả lương cho giáo viên')->exists()) {
                DB::table('payment_admins')->where('date', $date)->where('content', 'Trả lương cho giáo viên')->update([
                    'money' => -$moneyForTeacher
                ]);
            }
            if (AdminPayment::where('date', $date)->where('content', 'Học phí của học sinh')->exists()) {
                DB::table('payment_admins')->where('date', $date)->where('content', 'Học phí của học sinh')->update([
                    'money' => $moneyForStudent
                ]);
            }
        };

        $firstMoney = 100000000;
        $payments = AdminPayment::all();
        return view('pages.payment-management.index-admin', compact('dates', 'firstMoney', 'payments'));
    }

    public function store($dateMonth, $dateYear, Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'money' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        $date = $dateMonth . '/' . $dateYear;

        if ($request->status == 0) {
            AdminPayment::create([
                'content' => $request->content,
                'money' => -$request->money,
                'status' => 0,
                'date' => $date
            ]);
        }
        if ($request->status == 1) {
            AdminPayment::create([
                'content' => $request->content,
                'money' => $request->money,
                'status' => 1,
                'date' => $date
            ]);
        }

        return back()->with('succes', 'Thêm chi tiêu thành công');
    }

    public function update(AdminPayment $payment, Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'money' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        if ($request->status == 0) {
            AdminPayment::where('id', $payment->id)->update([
                'content' => $request->content,
                'money' => -$request->money,
                'status' => 0
            ]);
        }
        if ($request->status == 1) {
            AdminPayment::where('id', $payment->id)->update([
                'content' => $request->content,
                'money' => $request->money,
                'status' => 1
            ]);
        }

        return back();
    }

    public function destroy(AdminPayment $payment)
    {
        $payment->delete();
        return back()->with('succes', 'Đã xóa');
    }

    public function generatePdfAdmin($dateMonth, $dateYear, Request $request)
    {
        $date = $dateMonth . '/' . $dateYear;
        $payments = AdminPayment::where('date', $dateMonth . '/' . $dateYear)->get();

        return view('pages.payment-management.admin-generate-pdf', compact('date', 'payments'));
    }

    public function billing()
    {
        return view('pages.payment-management.billing');
    }
}
