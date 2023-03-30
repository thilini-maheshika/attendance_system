function addStudent(form) {

    let fd = new FormData(form);

    if (fd.get('name').trim() != '') {
        if (fd.get('address').trim() != '') {
            if (fd.get('phone').trim() != '') {
                if (fd.get('phone').trim().length <= 10) {
                        if (fd.get('uname').trim() != '') {
                            if (fd.get('pass').trim() != '') {
                                if (fd.get('pass').trim().length <= 8) {
                                    if (fd.get('confpass').trim() != '') {
                                        if (fd.get('pass').trim() == fd.get('confpass').trim()) {

                                            $.ajax({

                                                method: "POST",
                                                url: "../server/api.php?function_code=addStudent",
                                                data: fd,
                                                success: function ($data) {
                                                    console.log($data);

                                                    if ($data > 0) {
                                                        errorMessage("This Student already Registered..");
                                                    } else {
                                                        successToast("Student Added Successfully");
                                                    }
                                                },

                                                contentType: false,
                                                processData: false,
                                                error: function (error) {
                                                    console.log(`Error ${error}`);
                                                    sweetAlert2(warning, 'Something Wrong.Try again!!');
                                                }

                                            });

                                        } else { errorMessage("Password and Confirm Password does not match");}
                                    } else { errorMessage("Please Confirm Password"); }
                                } else { errorMessage("Password should be less than 8 characters"); }
                            } else { errorMessage("Please Enter Password"); }
                        } else { errorMessage("Please Enter UserName"); }
                } else { errorMessage("Please Enter Valid phone number"); }
            } else { errorMessage("Please Enter Phone Number"); }
        } else { errorMessage("Please Enter Address"); }
    } else { errorMessage("Please Enter Student Name"); }
}

function StdEdit(ele, std_id, field){


    var value = document.getElementById(ele.id).value;

    const data = {
        std_id: std_id,
        field: field,
        value: value
    }

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=stdEdit",
        data: data,
        success: function ($data) {
            console.log($data);
            location.reload(this);
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}

function deleteStd(id,table,field){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            var data = {
                id: id,
                table: table,
                field: field,
            }

            callDeleteRequest(data);

        }
    })
}

function callDeleteRequest(data){
    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=delData",
        data: data,
        success: function ($data) {
            console.log($data);
            location.reload(this);

            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}


