<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookbank;
use App\Models\TaCourse;
use Auth;

class AddBookbankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.student.adbookbank');
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
        $request->validate([
            'bookbank_id' => 'required|unique:disbursements',
            'bookbank_name' => 'required',
            'bank_name' => 'required',
        ],
        [
            'bookbank_id.required'=>"กรุณากรอกเลขที่บัญชี",						 
            'bookbank_id.unique'=>"มีข้อมูลเลขที่บัญชีนี้เเล้ว",
            'bookbank_name.required'=>"กรุณากรอกชื่อบัญชี",
            'bank_name.required' => "กรุณากรอกธนาคาร",
        ]
   
        );

        
       
        
        $ta_user_id = Auth::user()->id;
        $ta = TaCourse::where("ta_id",$ta_user_id)->get()->first();
        $bookbank = new Bookbank;
        $bookbank->bookbank_id = $request->bookbank_id ;
        $bookbank->bookbank_name = $request->bookbank_name ;
        $bookbank->bank_name = $request->bank_name ;
        $bookbank->ta_id = $ta->ta_id;
        $bookbank->save();

        $filename = $request->file('filename');
        $newfilename = $request->file('filename')->store('public/disbursements_files/');
        $file = new Bookbank;
        $file-> filename = basename($newfilename);
        $file->save();

       
        
        //dd($bookbank);        

        return redirect()->route('request.index');

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
