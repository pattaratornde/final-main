<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tainfo;
use App\Models\TaCourse;
use App\Models\User;
use App\Models\Course;
use App\Models\Teaching;
use App\Models\Attendance;
use App\Models\StudentClass;
use App\Models\ClassType;
use App\Models\ClassTypeAttendance;
use Auth;

class ClassAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ta = new TaCourse;
        $ta_user_id = Auth::user()->id;
        $ta = TaCourse::where("ta_id",$ta_user_id)->get()->first();
        $classattend = ClassTypeAttendance::all();
        $course_id = $request->course_id;
        $course = Course::where("course_id",$course_id)->first();
        //dd($course);
        return view('layouts.student.classattend',compact('classattend','course'));
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
        $classattend = new ClassTypeAttendance;
        $classattend->aact_detail = request('aact_detail');
        $classattend->start_work = request('start_work');
        $classattend->duration = intval(request('duration_hours'))*60+intval(request('duration_minutes'));
        $classattend->class_type_id = request('class_type_id');
        $classattend->ta_id = $ta->ta_id;
        //dd($classattend);
        $classattend->save();
        return redirect(route('tainfo.show',$request->id))->with('success', 'Data saved.');

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
