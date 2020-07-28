<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Student extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'student_user','student_id','user_id')->withPivot('comment','id')->withTimestamps();
    }

    public function commentor($id){
        $user = User::find($id);        
        return $user->firstName;
    }
}
