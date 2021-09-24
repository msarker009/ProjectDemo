@extends('layouts.app')

@section('content')

    <!-- AddStudentModal -->
    <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>

                </div>

                <form id="AddStudentForm" method="POST" enctype="multipart/form-data" >
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" id="name" name="name" class="name form-control">
                            <span id="saveForm_errList_name" style="color:#FF0000;"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" id="email" name="email" class="email form-control">
                            <span id="saveForm_errList_email" style="color:#FF0000;"></span>

                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone</label>
                            <input type="text" id="phone" name="phone" class="phone form-control">
                            <span id="saveForm_errList_phone" style="color:#FF0000;"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Course</label>
                            <input type="text" id="course" name="course"  class="course form-control">
                            <span id="saveForm_errList_course" style="color:#FF0000;"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Image</label>
                            <input type="file" id="image" name="image"  class="image form-control">
                            <span id="saveForm_errList_image" style="color:#FF0000;"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--End-AddStudentModal -->

    <!--Edit-StudentModal -->
    @extends('student.edit')
    <!--End-EditStudentModal -->
    <!--Delete-StudentModal -->
    @extends('student.delete')
    <!--End-DeleteStudentModal -->

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" id="success_message" style="display:none"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Students Data
                            <a href="" data-bs-toggle="modal" data-bs-target="#AddStudentModal" class="btn btn-primary float-end">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead style="color: #f6993f">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Image</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('/main.js') }}"></script>
@endsection
