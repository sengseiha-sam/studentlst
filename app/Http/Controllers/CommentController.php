<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
class CommentController extends Controller
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
        // dd(Auth::user()->firstName);
        // dd($request);
        $student = Student::find($request->studentid);
        // dd($student->users);
        $student->users()->attach(Auth::id(),['comment'=>$request->comment]);
        return redirect('students/'.$request->studentid);
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
        $studentid=Auth::user()->students->pluck('pivot')[0]['student_id'];
        // dd(Auth::user()->students()->wherePivot('id',$id));
        Auth::user()->students()->wherePivot('id',$id)->update(['comment'=>$request->editcomment]);
        return redirect('students/'.$studentid);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentid=Auth::user()->students->pluck('pivot')[0]['student_id'];
        // dd(Auth::user()->students()->wherePivot('id',$id));
        Auth::user()->students()->wherePivot('id',$id)->detach();
        return redirect('students/'.$studentid);
        return "destroy comment..".$id;
    }
}
