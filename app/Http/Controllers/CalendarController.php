<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class CalendarController extends Controller
{
    public function management(Request $request)
    {
        $calendars = Calendar::query()->with('classes')->latest()->paginate(9);

        return view('pages.calendar-management.index', compact('calendars'));
    }

    public function create(Request $request)
    {
        return view('pages.calendar-management.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'day_of_the_week' => 'required',
            'start_hour' => 'required',
            'end_hour' => 'required | after:start_hour'
        ]);

        if (Calendar::where('day_of_the_week', $request->input('day_of_the_week'))->where('start_hour', $request->input('start_hour'))->where('end_hour', $request->input('end_hour'))->exists()) {
            return back()->with('error', 'Lịch học này đã có trên hệ thống');
        } else {
            Calendar::create([
                'day_of_the_week' => $request->day_of_the_week,
                'start_hour' => $request->start_hour,
                'end_hour' => $request->end_hour
            ]);

            return redirect()->route('calendar.management')->with('succes', 'Tạo lịch học thành công');
        }
    }
}
