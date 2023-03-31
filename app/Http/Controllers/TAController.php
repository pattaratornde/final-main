<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TA;


class TAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $tas = TA::all();
        return view('request.ta'); //resources/views/tasPage.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('views.create'); //resources/views/create.blade.php
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
            'ta_id' => 'required|max:10:regex:/^-?[0-9]?$/',
            'student_id' => 'required|max:11:regex:/^-?[0-9]?$/',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'users_id' => 'required'
        ]);

        $ta = new TA([
            'ta_id' => $request->get('ta_id'),
            'student_id' => $request->get('student_id'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'users_id' => $request->get('users_id'),
        ]);
        $stock->save();
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
        $ta = TA::find($id);
        return view('views.edit', compact('tas')); //resource/views/tas/edit.blade.php
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
        $request->validate([
            'ta_id' => 'required|max:10:regex:/^-?[0-9]?$/',
            'student_id' => 'required|max:11:regex:/^-?[0-9]?$/',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'users_id' => 'required'
        ]);

        $ta = TA::find($id);

        $ta->ta_id = $request->get('ta_id');
        $ta->student_id = $request->get('student_id');
        $ta->name = $request->get('name');
        $ta->address = $request->get('address');
        $ta->email = $request->get('email');
        $ta->users_id = $request->get('users_id');
        $ta->save();

        return redirect('/tas')->with('success', 'Data updated.'); //resource/views/tas/tasPage.blade.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ta = TA::find($id);
        $ta ->delete();
        
        return redirect()->back()('success','Data removed.'); 
    }
}
