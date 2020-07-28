<input class="form-control" id="searchOut" type="text" placeholder="Search..">
<br>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th style="width:10%">Picture</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Class</th>
                    @if (Auth::user()->role==1)
                    <th style="width:5%">Action</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody id="outTable">
                @foreach ($studentOut as $student)
                    <tr data-student="{{$student->id}}" >
                        <td><img src="{{asset('image/'.$student->picture)}}" alt="avatar" width="100px" height="100px"></td>
                        <td>{{$student->firstName}}</td>
                        <td> {{$student->lastName}}</td>
                        <td>{{$student->class}}</td>
                        @if (Auth::user()->role==1)
                        <td> <a class="text-danger" href="{{route('backtofollowup',$student->id)}}" data-toggle="tooltip" data-placement="bottom" title="Back to Followup"><i class="fas fa-hospital-user"></i></a></td>
                        @endif
                        
                    </tr>         
                @endforeach      
            </tbody>
        </table>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function(){
      $("#searchOut").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#outTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

    });

</script>
@endpush 