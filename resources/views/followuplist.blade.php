<input class="form-control" id="followupSearch" type="text" placeholder="Search..">
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
                    <th style="width:10%">Action</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody id="followupTable">
                @if (count($students)>0)
                @foreach ($students as $student)
                <tr data-student="{{$student->id}}" 
                    {{-- data-tutor="{{$student->user}}"  --}}
                    {{-- data-comment="{{$student->users()->comment}}"  --}}
                    {{-- data-toggle="modal" data-target="#detailModal" --}}
                    >
                    <td><img src="{{asset('image/'.$student->picture)}}" alt="avatar" width="100px" height="100px"></td>
                    <td>{{$student->firstName}}</td>
                    <td>{{$student->lastName}}</td>
                    <td>{{$student->class}}</td>
                    @if (Auth::user()->role==1)
                        
                   
                    <td> 
                        <a  class="text-success" data-toggle="tooltip" data-placement="bottom" title="Out from Followup"
                            href="{{route('outoffollow',$student->id)}}"><i class="fas fa-user-alt-slash"></i></a> |
                        <a 
                            {{-- style="pointer-events: auto;"  --}}
                            data-fname="{{$student->firstName}}" 
                            data-lname="{{$student->lastName}}" 
                            data-clss="{{$student->class}}" 
                            data-tutor="{{$student->user_id}}" 
                            data-description="{{$student->description}}" 
                            data-picture="{{asset('image/'.$student->picture)}}" 
                            {{-- data-pichidden="{{$student->picture}}"  --}}
                            data-url="{{route('students.update',$student->id)}}"
                            data-toggle="modal" 
                            data-target="#editModal"
                            {{-- onclick="editStudent({{$student->id}},event)"  --}}
                            href="#"
                           
                            data-placement="bottom" title="Edit">
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach

                @endif

            </tbody>
        </table>
    </div>
</div>

{{-- @include('followupdetail') --}}

@push('scripts')
<script>
    $(document).ready(function(){
      $("#followupSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#followupTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

      $('#followupTable tr td:not(:last-child)').click(function (e) {
        e.preventDefault()
        var student = $(this).parent().data('student')
        console.log(student)
        window.location.href = '{!!'students/'!!}'+student//all referenct of student will pass to studentcontroller and show student detail
        // console.log(e)
        
        // console.log(student)
        // console.log("row..."+$(this).data('id'))
        // showDetail()
      });
      $('#outTable tr td:not(:last-child)').click(function (e) {
        e.preventDefault()
        var student = $(this).parent().data('student')
        console.log(student)
        window.location.href = '{!!'students/'!!}'+student
      });

      $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            console.log(button)
            var url = button.data('url')
            var fname = button.data('fname')
            var lname = button.data('lname')
            var clss = button.data('clss')
            var tutor = button.data('tutor')
            var description = button.data('description')
            var picture = button.data('picture')
            // var picHidden = button.data('pichidden')
            // console.log("pichidden"+picHidden)
            var modal = $(this)
            modal.find('#fname').val(fname)
            modal.find('#lname').val(lname)
            modal.find('#description').val(description)
            $("#editForm").attr('action',url)
            $('#clss').val(clss)
            $('#tutor').val(tutor)
            // $('#picHidden').val(picHidden)
            $('#picStudent').attr('src',picture)            
            console.log("url"+url)
       });
       $("#picture").change(function(){
        readURL(this);
        // console.log("picture changess...."+$("#picture").val())
        // $('#picHidden').val(this.value())
        });

        // $('#detailModal').on('hidden.bs.modal', function() {
        //     console.log("hidden...")
        //     $('#detailModal').removeData('bs.modal')
        //     console.log("remove...")
        // });

        // $('#detailModal').on('show.bs.modal', function (event) {  
        //     // console.log(event)          
        //     var button = $(event.relatedTarget)
        //     var student = button.data('student')
        //     var tutor = button.data('tutor')
        //     // var comments = button.data('comment')
        //     var studentName = student['firstName']+" "+student['lastName']
        //     // console.log("comment: "+ comments)
        //     var modal = $(this)
        //     modal.find('#studentname').text(studentName)
        //     modal.find('#studentid').val(student['id'])
        //     modal.find('#studentclass').text(student['class'])
        //     modal.find('#studentdescription').text(student['description'])
        //     if(student['user_id']!=null){
        //         modal.find('#studenttutor').text(tutor['firstName'])            
        //     }else{
        //         modal.find('#studenttutor').text("Not Yet Assinged")
        //     }
            
        //     // var student = $(this).parent().data('student')
        //     // console.log("student modal name..."+student['firstName'])
        //     // var student = button.data('student')
        //     // console.log("showdetailModal..."+student['firstName'])
        // })
    
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picStudent').attr('src', e.target.result);           
        }

        reader.readAsDataURL(input.files[0]);
    }

    
}

    function showDetail(){
        e.preventDefault()
        var student = $(this).parent().data('student')
        console.log(student)
        window.location.href = '{!!'students/'!!}'+student
    }

    // function editStudent(id,event){
    //     event.preventDefault()        
    //     console.log("id"+id)
    //     // $('#editModal').modal('show')
      
        
    // }
   
</script>
@endpush