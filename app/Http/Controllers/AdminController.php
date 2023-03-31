<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaRequest;
use App\Models\Course;
use App\Models\User;
use App\Models\TA;
use App\Models\FileUpload;
use App\Models\TaCourse;
use App\Models\StudentClass;


use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $reqs = TaRequest::all();
       
        return view('layouts.admin.ta', compact('reqs'));
        //
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
    public function edit($request_id)
    {
        {
            $req = TaRequest::where('request_id',$request_id)->first();
            $courses = Course::where('semester_id',25651,25652)->get();
            $users = User::all();
            return view('layouts.admin.edit', compact('courses','users','req'));
    
        }
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $request_id)
    {
        //dd('$req');
        $request->validate([
                'course_id' => 'required',
                
            ]);

            //dd($request_id);
            $reqs = TaRequest::find($request_id);

            //dd($reqs->student_user);
            $oldstatus = $reqs->status;
            //$reqs->course_id = $request->get('course_id');
            $reqs->status = $request->get('status');
            $reqs->comment = $request->get('comment');
            $user = Auth::user()->id;
            
            if ($reqs->status == "Y" and $oldstatus !=$reqs->status){
                $this->approvetas($reqs);

                $reqs->approved_at =  date('Y-m-d H:i:s');
            }
                
        $reqs->save();

        return redirect()->route('admin.index')->with('success', 'Data updated.');
    }
    public function approvetas($req){
        $student_user = $req->student_user;
        $ta = TA::where('student_id',$student_user->student_id)->get()->first();
        $ta_new = $ta;
        //dd($ta_new);
       
        if ($ta == null) { //เช็คค่าว่ามีข้อมูลในDBหรือไม่ 
            $ta_new = new TA([
                'student_id' => $student_user->student_id,
                'name' => $student_user->name,
                'email' => $student_user->email,
                'ta_user_id' => $student_user->id,
                ]);
        }
        
        
        $ta_new->save();
        $this->addcourseta($ta_new ,$req->course_id);
        

        

       ///return this()->approvetas($id);
    }
    public function addcourseta($ta, $course_id){
        $ta_course = new TaCourse([
            'ta_id' => $ta->ta_id,
            'course_id' => $course_id,
            ]);
        $ta_course ->save();

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

    public function delete($id)
    {
        $reqs = TaRequest::find($id)->delete();
  
        return back();
    }
}
