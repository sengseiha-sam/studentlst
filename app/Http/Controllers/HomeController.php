<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tutors = User::all();
        $students = Student::with('user','users')->where('activeFollowup','1')->get();
        $studentOut = Student::with('user','users')->where('activeFollowup','0')->get();
        // dd($students);
        return view('home',compact('tutors','students','studentOut'));
    }
}
