<!-- Add Student Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Student</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First Name" name="fname"
                                    required>
                            </div>
                            <div class="col">
                                <input required type="text" class="form-control" placeholder="Last Name" name="lname">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <select name="class" required class="custom-select">
                                    <option value="">Class</option>
                                    <option value="2021A">2021A</option>
                                    <option value="2021B">2021B</option>
                                    <option value="2021C">2021C</option>
                                    <option value="WEP2020A">WEP2020A</option>
                                    <option value="WEP2020B">WEP2020B</option>
                                    <option value="SNA2020">SNA2020</option>
                                </select>
                            </div>
                            <div class="col">
                                <input class="form-control" type="file" name="picture">
                            </div>
                            <div class="col">
                                <select name="tutor" class="custom-select">
                                    <option selected value="">Tutor</option>
                                    @foreach ($tutors as $tutor)
                                    <option value="{{$tutor->id}}">{{$tutor->firstName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <textarea class="form-control" rows="5" 
                                    placeholder="Description" name="description"></textarea>
                            </div>
                        </div>
                    </div>




                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>