<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AtteController extends Controller
{
    public function login()
    {
        return view('atte.login');
    }
    public function date()
    {
        $attendances = Attendance::latest()->get();
        $rests = Rest::latest()->get();
        return view('atte.date', compact('attendances', 'rests'));
    }
    public function stamp()
    {
        if (Auth::check()) {
            $attendances = Attendance::latest()->get();
            return view('atte.stamp', compact('attendances'));
        }else{
            return view('atte.login');
            }
    }
    public function start_edit($id){
        return view('atte.stamp');
    }
    public function start_time(Request $request)
    {
        $user = Auth::user();

        // 出勤打刻は１日一回まで
        // $attendance = Attendance::where('user_id', $user->id)->latest()->first();
        //  if ($attendance) {
        //     $attendanceStartTime = new Carbon($attendance->start_time);
        //     $attendanceDay = $attendanceStartTime->startOfDay();
        // }
        // $newAttendanceDay = Carbon::today();

        // ２回目の出勤打刻時にエラーを表示
        // if (($attendanceStartTime == $newAttendanceDay) && (empty($attendance->end_time))){
        //     \Session::flash('start_error', 'すでに出勤打刻がされています');
        //     return redirect()->back();
        // }

        // 勤務開始を押したら新しくデータが作られる
        Attendance::create([
            'user_id' => $request->user_id,
            'rest_id' => $request->rest_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        Rest::create([
            'user_id' => $request->user_id,
            'rest_start_time' => $request->rest_start_time,
            'rest_end_time' => $request->rest_end_time,
        ]);
        \Session::flash('start_msg', '勤務を開始しました');
        return redirect()->back();
    }
    public function end_edit($id){
        return view('atte.stamp');
    }
   public function end_time(Request $request, $id)
    {
        $user = Auth::user();
        // 退勤したあとは退勤できない
        // if('$attendance->end_time' !== 'null') {
        //     \Session::flash('end_error', '既に退勤の打刻がされています');
        //     return redirect()->back();
        // }
        // if(!empty($attendance->end_time)) {
        //     \Session::flash('end_error', '既に退勤の打刻がされています');
        //     return redirect()->back();
        // }

        $param = [
            'end_time' => $request->end_time
        ];
        $end_time = Attendance::where('user_id', $user->id)->latest()->first()->update($param);
        \Session::flash('end_msg', 'お疲れ様でした');
        return redirect()->back();
    }
    public function rest_start_edit($id){
        return view('atte.stamp');
    }
    public function rest_start_time(Request $request, $id)
    {
        $user = Auth::user();
        $param = [
            'rest_start_time' => $request->rest_start_time,
            'rest_end_time' => $request->rest_end_time
        ];
        $rest_start_time = Rest::where('user_id', $user->id)->latest()->first()->update($param);
        \Session::flash('lest_start', '休憩を開始しました');
        return redirect()->back();
    }
    public function rest_end_edit($id){
        return view('atte.stamp');
    }
    public function rest_end_time(Request $request, $id)
    {
        $user = Auth::user();
        // if(!empty($attendance->lest_end_time)) {
        //     \Session::flash('lest_end_error', '既に休憩終了の打刻がされています');
        //     return redirect()->back();
        // }
        $param = [
            'rest_end_time' => $request->lest_end_time
        ];
        $rest_end_time = Attendance::where('user_id', $user->id)->latest()->first()->update($param);
        \Session::flash('lest_end', '休憩を終了しました');
        return redirect()->back();
    }
}
