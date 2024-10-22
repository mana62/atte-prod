<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AttendanceSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class AttendanceSheetController extends Controller
{
    use Notifiable;

    //日付一覧の表示
    public function index(Request $request)
    {

        $date = $request->input('date', Carbon::today('Asia/Tokyo'));

        $users = User::whereHas('attendanceSheets', function ($query) use ($date) {
            $query->whereDate('start_time', $date->format('Y-m-d'));
        })
            ->with([
                'attendanceSheets' => function ($query) use ($date) {
                    $query->whereDate('start_time', $date->format('Y-m-d'))
                        ->orderBy('start_time', 'desc');
                }
            ])
            ->paginate(5);

        return view('attendance-sheet', compact('users', 'date'));
    }

    //日付の前後
    public function show($date)
    {
        $date = Carbon::parse($date)->setTimezone('Asia/Tokyo');

        $users = User::whereHas('attendanceSheets', function ($query) use ($date) {
            $query->whereDate('start_time', $date->format('Y-m-d'));
        })
            ->with([
                'attendanceSheets' => function ($query) use ($date) {
                    $query->whereDate('start_time', $date->format('Y-m-d'))
                        ->orderBy('start_time', 'desc');
                }
            ])
            ->paginate(5);

        return view('attendance-sheet', compact('users', 'date'));
    }

    public function total($id)
    {
        $attendance = AttendanceSheet::with('breakTimes')->find($id);

        if ($attendance && $attendance->start_time && $attendance->finish_time) { //勤務開始・終了が存在する場合
            //勤務時間の計算
            $startTime = Carbon::parse($attendance->start_time);
            $finishTime = Carbon::parse($attendance->finish_time);
            $totalWorkMinutes = $finishTime->diffInMinutes($startTime);

            //休憩時間の合計の計算
            $totalBreakMinutes = $attendance->breakTimes->reduce(function ($carry, $breakTime) {
                //休憩終了時間が存在するかチェック
                if ($breakTime->finish_break) {
                    $startBreak = Carbon::parse($breakTime->start_break);
                    $finishBreak = Carbon::parse($breakTime->finish_break);
                    return $carry + $finishBreak->diffInMinutes($startBreak);
                }
                return $carry;
            }, 0);

            //実働時間 = 勤務時間 - 休憩時間
            $actualWorkMinutes = $totalWorkMinutes - $totalBreakMinutes;

            return view('attendance.total', [
                'attendance' => $attendance,
                'totalWorkHours' => floor($totalWorkMinutes / 60),
                'totalWorkMinutes' => $totalWorkMinutes % 60,
                'totalBreakHours' => floor($totalBreakMinutes / 60),
                'totalBreakMinutes' => $totalBreakMinutes % 60,
                'actualWorkHours' => floor($actualWorkMinutes / 60),
                'actualWorkMinutes' => $actualWorkMinutes % 60,
            ]);
        }

        //勤務データが存在しない場合
        return redirect()->back();
    }
}