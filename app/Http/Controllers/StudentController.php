<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        // dd($request->picture->extension());
        $student = new Student;
        $student->firstName = $request->fname;
        $student->lastName = $request->lname;
        $student->class = $request->class;
        $student->description = $request->description;
        $student->user_id = $request->tutor;
        if($request->file('picture')){
            $request->validate([
                'picture' => 'image|mimes:jpeg,png,jpg'
            ]);
            $imageName = time().'.'.$request->picture->extension();    
            // dd('picture...'.$imageName);
            $request->picture->move(public_path('image'), $imageName);
            $student->picture = $imageName;
        }

        $student->save();
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // dd($student);
        return view('followupdetail',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->firstName = $request->fname;
        $student->lastName = $request->lname;
        $student->class = $request->class;
        $student->description = $request->description;
        $student->user_id = $request->tutor;
        if($request->picture!=null){           
            $request->validate([
                'picture' => 'image|mimes:jpeg,png,jpg'
            ]);
            $imageName = time().'.'.$request->picture->extension();   
            $request->picture->move(public_path('image'), $imageName);
            $student->picture = $imageName;
        }
        $student->save();
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
