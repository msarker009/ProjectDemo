//JQuery---------------
$(document).ready(function (){


    <!-- fetch Data -->
    fetchStudent();
    function fetchStudent(){
        $.ajax({
            type:"GET",
            url:"fetch_data",
            dataType: "json",
            success: function (response){
               // console.log(response);
                $('tbody').html("");
                $.each(response.students  ,function (key,item){
                    $('tbody').append('<tr>\
                               <td>'+item.id+'</td>\
                               <td>'+item.name+'</td>\
                               <td>'+item.email+'</td>\
                               <td>'+item.phone+'</td>\
                               <td>'+item.course+'</td>\
                               <td><img src="student_files/'+item.profile_image+'" alt="image" width="70"></td>\
                                <td><button type="button"  value="'+item.id+'" class="edit_student btn btn-primary"><i class="fas fa-pen-square"></i></button> ' +
                                '<button type="button"  value="'+item.id+'" class="delete_student btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>\
                            </tr>');



                });

            }

        });



    };


    <!-- Insert Data -->
    $(document).on('submit','#AddStudentForm',function(e) {
        e.preventDefault();
        let formData= new FormData($('#AddStudentForm')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //console.log(data)
        $.ajax({
            type:"POST",
            url:"students",
            data:formData,
            dataType:"json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                // setting a timeout
                $('#saveForm_errList_name').html("");
                $('#saveForm_errList_email').html("");
                $('#saveForm_errList_phone').html("");
                $('#saveForm_errList_course').html("");
                $('#saveForm_errList_image').html("");
            },
            success:function (response){
                //console.log(response);
                if(response.status== 400){
                    $('#saveForm_errList').html("");
                    $('#saveForm_errList').addClass('alert alert-danger');
                    $.each(response.errors.name, function (key,err_values){
                        $('#saveForm_errList_name').append(err_values);
                    });
                    $.each(response.errors.email, function (key,err_values){
                        $('#saveForm_errList_email').append(err_values);
                    });
                    $.each(response.errors.phone, function (key,err_values){
                        $('#saveForm_errList_phone').append(err_values);
                    });
                    $.each(response.errors.course, function (key,err_values){
                        $('#saveForm_errList_course').append(err_values);
                    });
                    $.each(response.errors.image, function (key,err_values){
                        $('#saveForm_errList_image').append(err_values);
                    });



                }
                else {
                    $('#saveForm_errList').html("");
                    $('#success_message').show();
                    $('#success_message').text(response.message);
                    $('#AddStudentModal').modal('hide');
                    $('#AddStudentModal').find('input').val("");
                    window.location.reload('students');

                }
            }

        });
    });



     <!-- edit Data -->
    $(document).on('click','.edit_student',function (e){
        e.preventDefault();
        let stud_id=$(this).val();
        //console.log(stud_id);
        $('#EditStudentModel').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"edit_student/"+stud_id,
            success:function(response){
                if(response.status== 400){
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                }
                else {
                    $('#edit_name').val(response.students.name);
                    $('#edit_email').val(response.students.email);
                    $('#edit_phone').val(response.students.phone);
                    $('#edit_course').val(response.students.course);
                    $('#set_img').html(`<img class="img-fluid" src="student_files/${response.students.profile_image}" alt="photo">`);
                    $('#edit_stud_id').val(stud_id);


                }
            }

        });



    });

     <!-- Update Data -->
    $(document).on('submit','#UpdateStudentForm',function (e)
    {
        e.preventDefault();
        let stud_id=$('#edit_stud_id').val();
        let EditFormData=new FormData($('#UpdateStudentForm')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"POST",
            url:"update_student/"+stud_id,
            data:EditFormData,
            dataType:"json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                // setting a timeout
                $('#updateForm_errList_name').html("");
                $('#updateForm_errList_email').html("");
                $('#updateForm_errList_phone').html("");
                $('#updateForm_errList_course').html("");
                $('#updateForm_errList_image').html("");
            },

            success:function (response){
                //console.log(response);
                if(response.status==400){
                    $('#updateForm_errList').html("");
                    $('#updateForm_errList').addClass('alert alert-danger');
                    $.each(response.errors.name, function (key,err_values){
                        //console.log(err_values)
                        $('#updateForm_errList_name').append(err_values);
                    });
                    $.each(response.errors.email, function (key,err_values){
                        //console.log(err_values)
                        $('#updateForm_errList_email').append(err_values);
                    });
                    $.each(response.errors.phone, function (key,err_values){
                        //console.log(err_values)
                        $('#updateForm_errList_phone').append(err_values);
                    });
                    $.each(response.errors.course, function (key,err_values){
                        //console.log(err_values)
                        $('#updateForm_errList_course').append(err_values);
                    });
                    $.each(response.errors.image, function (key,err_values){
                        //console.log(err_values)
                        $('#updateForm_errList_image').append(err_values);
                    });

                }else if(response.status==400){
                    $('#updateForm_errList').html("");
                    $('#success_message').show();
                    $('#success_message').text(response.message);

                }else{
                    $('#updateForm_errList').html("");
                    $('#success_message').html("");
                    $('#success_message').show();
                    $('#success_message').text(response.message);

                    $('#EditStudentModel').modal('hide');
                    fetchStudent();
                    setTimeout(function(){
                        $('#success_message').remove();
                    }, 2000);




                }
            }

        });


    });

    <!-- Delete Data -->
     $(document).on('click','.delete_student',function (e){
        e.preventDefault();
        let stud_id=$(this).val();
       //alert(stud_id);
        $('#delete_stud_id').val(stud_id);
        $('#DeleteStudentModel').modal("show");
     });

     $(document).on('click','.delete_student_btn',function (e){
         e.preventDefault();
         let stud_id=$('#delete_stud_id').val();

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
             type:"Delete",
             url:"delete_student/"+stud_id,
             success:function (response){
                 $('#success_message').show();
                 $('#success_message').text(response.message);
                 $('#DeleteStudentModel').modal('hide');
                 fetchStudent();
                 setTimeout(function(){
                     $('#success_message').remove();
                 }, 2000);

             }

         });


     });



});

