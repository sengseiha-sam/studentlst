<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
class FollowupController extends Controller
{
    public function outoffollow($id){
        $student = Student::find($id);
        $student->activeFollowup = 0;
        $student->save();
        return redirect('home');
    }
    public function backtofollow($id){
        $student = Student::find($id);
        $student->activeFollowup = 1;
        $student->save();
        return redirect('home');
    }
}
