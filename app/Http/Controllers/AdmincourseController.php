<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tainfo;
use App\Models\TaCourse;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\StudentClass;
use App\Models\TaRequest;
use App\Models\TA;

use Auth;

class AdmincourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admincourse = TaCourse::all();
        /*$admincourse = Tainfo::findOrFail($user_id);*/
        return view('layouts.admin.course',compact('admincourse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admincourse = TaCourse::all();
        /*$admincourse = Tainfo::findOrFail($user_id);*/
        return view('layouts.admin.approveattend',compact('admincourse'));
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
        $admincourse = TaCourse::findOrFail($ta_id);
        return view('layouts.admin.detail',compact('admincourse'));
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

    /*public function search(Request $request)
    {
        $query = $request->input('query');
        $admincourse = TaCourse::query()
            ->join('tas', 'name', '=', 'name')

            ->where('tas.name', 'LIKE', "%{$query}%")
            ->get();
            
        return view('layouts.admin.course', compact('admincourse'));
    }*/

    
    public function search(Request $request)
    {

        $name = $request->search;                               
                 
        $tas = TA::where('student_id',"LIKE","%{$name}%")->orWhere('name',"LIKE","%{$name}%")->pluck('ta_id');
        //dd($tas);
        //$subject = Course::where('subject_id',"LIKE","%{$name}%")->orWhere('name_en',"LIKE","%{$name}%")->pluck('subject_id');
        //dd($subject);
        $admincourse = TaCourse::whereIn('ta_id', $tas)->get();     
        
        //dd($admincourse);
        return view("layouts.admin.course",compact('admincourse','tas'));                                               
        
    }
    
}
