@extends('layouts.app')

@section('content')
{{-- {{dd($student)}} --}}
<div class="container">

    <div class="card">
        <div class="card-header text-center">
            <img src="{{asset('image/'.$student->picture)}}" alt="avatar" width="100px" height="100px">
        </div>
        <div class="card-body">
            <h2><strong id="studentname">{{$student->firstName}} {{$student->lastName}}</strong> - <span
                    id="studentclass">{{$student->class}}</span></h2>
            <br>
            <h3>Description</h3>
            <p id="studentdescription">
                {{$student->description}}
            </p>
            <h5>Tutor By:
                @if ($student->user)
                {{$student->user->firstName}}
                @else
                None
                @endif
            </h5>
            <hr>
            <div class="row bootstrap snippets">
                <div class="col-md-12 col-md-offset-2 col-sm-12">
                    <div class="comment-wrapper">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <form action="{{route('comments.store')}}" method="POST">
                                    @csrf
                                    <textarea class="form-control" placeholder="Write a comment..." rows="3"
                                        name="comment"></textarea>
                                    <input type="hidden" name="studentid" value="{{$student->id}}">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </form>
                                <div class="clearfix"></div>
                                <br>
                                {{-- <hr> --}}
                                <ul class="media-list">
                                    {{-- {{dd($student->users)}} --}}
                                    @foreach ($student->users as $user)
                                    {{-- {{dd($users)}} --}}
                                    <li class="media">
                                        {{-- <h1>id {{$user->pivot->id}}</h1> --}}
                                        <a href="#" class="pull-left">
                                            <img class="img-circle" src="{{asset('image/2.png')}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <strong>{{$student->commentor($user->pivot->user_id)}}</strong>
                                            <span class="text-muted pull-right">
                                                <small class="text-muted">{{$user->pivot->created_at}}</small>
                                            </span>
                                            <textarea readonly id="comment{{$user->pivot->user_id}}"
                                                class="form-control" rows="3">{{$user->pivot->comment}}</textarea>

                                            @if (Auth::id()==$user->pivot->user_id)
                                            <small>
                                                <a 
                                                    data-url="{{route('comments.update',$user->pivot->id)}}"
                                                    data-id="{{$user->id}}"
                                                    data-comment="{{$user->pivot->comment}}"
                                                    data-toggle="modal" 
                                                    data-target="#commentModal" href="#">Edit</a>                                                
                                                <form action="{{route('comments.destroy',$user->pivot->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                                
                                            </small>
                                            @endif

                                        </div>

                                    </li>

                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection


{{-- modal edit comment --}}

<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form id="editcommentstudent" action="" method="post">
        @csrf
        @method('PUT')
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">               
                    
                    <textarea name="editcomment" id="editcomment" class="form-control" rows="3"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
                
        </div>
    </div>
</form>
</div>


@push('scripts')

<script>
     $(document).ready(function(){
        $('#commentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var url = button.data('url')
            var id = button.data('id')
            console.log("id"+id)
            var comment = button.data('comment')
            var modal = $(this)
            modal.find('#editcomment').val(comment)
            $("#editcommentstudent").attr('action',url)
        })
     })

</script>

@endpush