<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaRequest;
use App\Models\Course;
use App\Models\StudentClass;
use App\Models\User;
use App\Models\TA;
use App\Models\FileUpload;
use App\Models\TaCourse;

use Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $reqs = TaRequest::where('student_user_id',$user_id)->get();
        $photo = FileUpload::all();
        return view('request.index', compact('reqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $reqs = TaRequest::all();
        $courses = Course::where('semester_id',25651,25652)->get();
        $classes = StudentClass::where('course_id',25651,25652)->get();
        $users = User::all();
        $photo = FileUpload::all();
        return view('layouts.student.form',compact('courses','users','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filename = $request->file('filename')->getClientOriginalName();
        //dd($photo);

        $newfilename = $request->file('filename')->store('public/student_files/');
        $photo = new FileUpload;
        $photo-> filename = basename($newfilename);
        $photo->save();
        
        $user_id = Auth::user()->id;
        $ta_req = TaRequest::create([
                'student_user_id' => $user_id,
                'status' => 'W',
                'course_id' => $request->course_id,
                'file_id' => $photo->file_id,
         ]);
        return redirect()->route('request.index')->with('success', 'Data saved.');
        //return redirect()->back();


        // $request->validate([
        //     'request_id' => 'required',
        //     'detail' => 'required',
        //     'user_id' => 'required',
        //     'course_id' => 'required',
        // ]);
        // $reqs = new TaRequest([
        //     'request_id' => $request->get('request_id'),
        //     'detail' => $request->get('detail'),
        //     'user_id' => $user_id,
        //     'course_id' => $request->get('course_id'),
            
        // ]);
        // $reqs->save();
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
        $req = TaRequest::where('request_id',$request_id)->first();
        $courses = Course::where('semester_id',25651,25652)->get();
        $users = User::all();
        return view('layouts.student.edit', compact('courses','users','req'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function createTas(){

    }

    public function update(Request $request, $request_id)
    {
        //dd('$req');
        $request->validate([
                'course_id' => 'required',
                
            ]);

            //dd($request_id);
            $reqs = TaRequest::find($request_id);

            //dd($reqs->student_user);
            //$reqs->course_id = $request->get('course_id');
            $user = Auth::user()->id;
                
        $reqs->save();

        return redirect()->route('request.index')->with('success', 'Data updated.');
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
        $reqs = TaRequest::find($id);
        $reqs->delete();
        
        return redirect()->back()->with('success','Data removed.'); 
    }
    public function delete($id)
    {
        $reqs = TaRequest::find($id);
        $reqs->delete();
        
        return redirect()->back()->with('success','Data removed.'); 
    }

    
}
