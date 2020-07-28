@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Follow Up</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Out of Followup</a>
        </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            @if (Auth::user()->role==1)
            <a href="#" data-toggle="modal" data-target="#myModal">Add Student</a>
            <br>
            <br>
            @endif
            @include('followuplist')
        </div>
        <div id="menu1" class="container tab-pane fade"><br>
            @include('outfollowuplist')
        </div>
    </div>
</div>

@include('addstudent')
@include('editstudent')

@endsection
