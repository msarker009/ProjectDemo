$(document).ready(function (){

    <!-- fetch Data -->
    fetchData();
    function fetchData(){
        $.ajax({
            type: 'GET',
            url: 'fetch-users',
            dataType:'json',
            success:function (response){
                $('tbody').html("");
                $.each(response.users,function (key,item){
                    $('tbody').append(
                        '<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+item.email+'</td>\
                            <td>'+item.phone['phone']+'</td>\
                            <td><img src="User_image/'+item.image+'" alt="photo" width="70"></td>\
                            <td><button type="button" value="'+item.id+'" class="edit_user btn btn-primary"><i class="fas fa-pen-square"></i></button>' +
                            '<button type="button" value="'+item.id+'" class="delete_user btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>\
                        </tr>'

                    );
                });

            }
        });
    }

    <!-- Insert Data -->
    $(document).on('submit','#AddUserForm',function(e){
        e.preventDefault();
        let formData= new FormData($('#AddUserForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //console.log("hi")
        $.ajax({
            type:"POST",
            url:"users",
            data:formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                // setting a timeout
                $('#saveForm_errList_name').html("");
                $('#saveForm_errList_email').html("");
                $('#saveForm_errList_phone').html("");
                $('#saveForm_errList_image').html("");
            },
            success:function (response){
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




                }
                else {
                    $('#saveForm_errList').html("");
                    $('#success_message').show();
                    $('#success_message').text(response.message);
                    $('#AddStudentModal').modal('hide');
                    $('#AddStudentModal').find('input').val("");
                    window.location.reload('users');

                }
            }

        });
    });


    <!-- edit Data -->
    $(document).on('click','.edit_user',function (e){
        e.preventDefault();
        let user_id=$(this).val();
        //console.log(user_id);
        $('#EditUserModal').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"edit_user/"+user_id,
            success:function(response){
                if(response.status== 400){
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                }
                else {
                    $('#edit_name').val(response.users.name);
                    $('#edit_email').val(response.users.email);
                    $('#edit_phone').val(response.users.phone['phone']);
                    $('#set_img').html(`<img class="img-fluid" src="User_image/${response.users.image}" alt="photo">`);
                    $('#edit_user_id').val(user_id);


                }
            }

        });



    });

    <!-- Update Data -->
    $(document).on('submit','#UpdateUserForm',function (e)
    {
        e.preventDefault();
        let user_id=$('#edit_user_id').val();
        let EditFormData=new FormData($('#UpdateUserForm')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"POST",
            url:"update_user/"+user_id,
            data:EditFormData,
            dataType:"json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                // setting a timeout
                $('#updateForm_errList_name').html("");
                $('#updateForm_errList_email').html("");
                $('#updateForm_errList_phone').html("");
                //$('#updateForm_errList_image').html("");
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

                    $('#EditUserModal').modal('hide');
                    fetchData();
                    setTimeout(function(){
                        $('#success_message').remove();
                    }, 2000);




                }
            }

        });


    });

});
