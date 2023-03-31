<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tainfo;
use App\Models\TaCourse;
use App\Models\User;
use App\Models\Course;
use App\Models\Teaching;
use App\Models\Attendance;
use Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::all();
        return view('layouts.student.attendance',compact('attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attendance = Attendance::all();
        return view('layouts.student.attendance',compact('attendance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $ta = new TaCourse;
        $ta_user_id = Auth::user()->id;
        $ta = TaCourse::where("ta_id",$ta_user_id)->get()->first();
        $attendance = new Attendance;
        /**dd($attendance);*/
        $attendance->attend_data = request("attend_data");
        $attendance->status = "W";
        $attendance->approve_user_id = null;
        $attendance->user_id = $ta_user_id;
        $attendance->note = request("note");
        $attendance->teaching_id = request('teaching_id');
        $attendance->ta_id = $ta->ta_id;
        /**dd($attendance);*/
        $attendance->save();
        return redirect()->back()->with('success', 'Data saved.');

        /**$attendance = Attendance::create([
            'attend_id' => $request->get('attend_id'),
            'attend_data' => 'Y',
            'status' => 'W',
            'approve_user_id' => $user_id,
            'user_id' => $user_id,
        ]);*/
        return redirect()->back()->with('success', 'Data saved.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
