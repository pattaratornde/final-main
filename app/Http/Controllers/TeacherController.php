<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Tainfo;
use App\Models\TaCourse;
use App\Models\TA;
use App\Models\StudentClass;
use App\Models\Teaching;
use App\Models\Teacher;
use App\Models\Subject;
use Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**$teacher_id = $request->teacher_id;
        $teach = TaCourse::findOrFail($teacher_id);
        return view('layouts.student.teacher',compact('teach'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ta_id)
    {
        $teach = TaCourse::findOrFail($ta_id);
        foreach($teach->course->classes as $class)
        {
            $class = StudentClass::findOrFail();
        }
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
    public function showTeacher(Request $request)
    {
        $teacher_id = $request->teacher_id;

        $teach = Teacher::find($teacher_id);
        $courseteach = Course::where('owner_teacher_id',$teacher_id)->whereHas('semester',function($q){
            $q->where('year','>=','2565');
        })->get();
        //dd($teach);

        return view('layouts.student.teacher',compact('teach','courseteach'));
    }
    public function showSubject(Request $request)
    {
        $subject_id = $request->subject_id;

        $subject = Subject::find($subject_id);
        $courseSubject = Course::where('subject_id',$subject_id)->whereHas('semester',function($q){
            $q->where('year','>=','2565');
        })->get();
        //dd($subject);

        return view('layouts.student.subject',compact('subject','courseSubject'));
    }
}
