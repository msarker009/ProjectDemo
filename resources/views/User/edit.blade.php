<!-- EditStudentModal -->
<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit & Update Student</h5>

            </div>
            <form id="UpdateStudentForm" method="POST" enctype="multipart/form-data" >
                <div class="modal-body">
                    <input type="hidden"  id="edit_user_id">

                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" id="edit_name" name="name"  class=" name form-control">
                        <span id="updateForm_errList_name" style="color:#FF0000;"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" id="edit_email" name="email" class="email form-control">
                        <span id="updateForm_errList_email" style="color:#FF0000;"></span>

                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="edit_phone" name="phone" class=" phone form-control">
                        <span id="updateForm_errList_phone" style="color:#FF0000;"></span>
                    </div>
                    <div class="row">
                        <div class="form-group mt-5 col-md-8">
                            <label for="">Image</label>
                            <input type="file" id="edit_image" name="image"  class=" image form-control">
                            <span id="updateForm_errList_image" style="color:#FF0000;"></span>
                        </div>
                        <div class="form-group col-4" id="set_img">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_student">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End-EditStudentModal -->
