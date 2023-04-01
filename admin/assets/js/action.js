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
                                                        errorMessage_R("This Student already Registered..");
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

function EditData(ele, id, field,table,tbl_id){


    var value = document.getElementById(ele.id).value;

    const data = {
        tbl_id: tbl_id,
        id: id,
        field: field,
        table:table,
        value: value
    }

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=Editdata",
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

function deleteData(id,table,field){

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

function updateCred(form,id,field,table,tbl_id){

    let fd = new FormData(form);

    fd.append('id',id);


    if (fd.get('cpass').trim() != '') {
        if (fd.get('cpass').trim().length <= 8) {
            if (fd.get('crepass').trim() != '') {
                if (fd.get('cpass').trim() == fd.get('crepass').trim()) {

                    const data = {
                        tbl_id: tbl_id,
                        id: id,
                        field: field,
                        table: table,
                        value: fd.get('crepass').trim()
                    }

                    $.ajax({
                        method: "POST",
                        url: "../server/api.php?function_code=Editdata",
                        data: data,
                        success: function ($data) {
                            console.log($data);
                            successToast("Password Updated Successfully");
                        },
                        error: function (error) {
                            console.log(`Error ${error}`);
                            sweetAlert2(warning, 'Something Wrong.Try again!!');
                        }
                    });

                } else { errorMessage("Password and Confirm Password does not match");}
            } else { errorMessage("Please Confirm Password"); }
        } else { errorMessage("Password should be less than 8 characters"); }
    } else { errorMessage("Please Enter Password"); }
                        
}

//class

function addClass(form) {

    let fd = new FormData(form);

    if (fd.get('class').trim() != '') {

        $.ajax({

            method: "POST",
            url: "../server/api.php?function_code=addcls",
            data: fd,
            success: function ($data) {
                console.log($data);

                if ($data > 0) {
                    errorMessage_R("This Class already Added..");
                } else {
                    successToast("Class Added Successfully");
                }
            },

            contentType: false,
            processData: false,
            error: function (error) {
                console.log(`Error ${error}`);
                sweetAlert2(warning, 'Something Wrong.Try again!!');
            }

        });                                     

                                        
    } else { errorMessage("Please Enter Class Name"); }
}

//class section

function addSec(form) {

    let fd = new FormData(form);

    if (fd.get('class').trim() != '') {
        if (fd.get('section').trim() != '') {

        $.ajax({

            method: "POST",
            url: "../server/api.php?function_code=addsec",
            data: fd,
            success: function ($data) {
                console.log($data);

                if ($data > 0) {
                    errorMessage_R("This Section already Exists..");
                } else {
                    successToast("Section Added Successfully");
                }
            },

            contentType: false,
            processData: false,
            error: function (error) {
                console.log(`Error ${error}`);
                sweetAlert2(warning, 'Something Wrong.Try again!!');
            }

        });                                     

        } else { errorMessage("Please Enter Section Name"); }                                
    } else { errorMessage("Please Select Class "); }
}

//Teachers
function addTeacher(form) {

    let fd = new FormData(form);

    if (fd.get('name').trim() != '') {
        if (fd.get('email').trim() != '') {
            if (fd.get('address').trim() != '') {
                if (fd.get('phone').trim() != '') {
                    if (fd.get('phone').trim().length <= 10) {
                        if (fd.get('class').trim() != '') {
                            if (fd.get('sect').trim() != '') {
                                if (fd.get('pass').trim() != '') {
                                    if (fd.get('pass').trim().length <= 8) {
                                        if (fd.get('confpass').trim() != '') {
                                            if (fd.get('pass').trim() == fd.get('confpass').trim()) {

                                                $.ajax({

                                                    method: "POST",
                                                    url: "../server/api.php?function_code=addTeacher",
                                                    data: fd,
                                                    success: function ($data) {
                                                        console.log($data);

                                                        if ($data > 0) {
                                                            errorMessage_R("This Teacher already Registered..");
                                                        } else {
                                                            successToast("Teacher Added Successfully");
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
                            } else { errorMessage("Please Select Class Section"); } 
                        } else { errorMessage("Please Select Class"); }
                    } else { errorMessage("Please Enter Valid phone number"); }
                } else { errorMessage("Please Enter Phone Number"); }
            } else { errorMessage("Please Enter Address"); }
        } else { errorMessage("Please Enter Email"); }
    } else { errorMessage("Please Enter Student Name"); }
}