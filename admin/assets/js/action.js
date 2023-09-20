
function addStudent(form) {
    let fd = new FormData(form);

    if (fd.get('name').trim() != '') {
        if (fd.get('address').trim() != '') {
            if (fd.get('phone').trim() != '') {
                // Validate phone number using regex
                let phoneRegex = /^(?:\+94|0)?(7[0-9]{8})$/;
                if (phoneRegex.test(fd.get('phone').trim())) {
                    if (fd.get('uname').trim() != '') {
                        if (fd.get('sect') && fd.get('sect').trim() !== '' && fd.get('sect').trim() != '--Select Section--') {
                            if (fd.get('pass').trim() != '') {
                                if (fd.get('pass').trim().length <= 8) {
                                    if (fd.get('confpass').trim() != '') {
                                        if (fd.get('pass').trim() == fd.get('confpass').trim()) {
                                            // Send form data using AJAX
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
                                        } else {
                                            errorMessage("Password and Confirm Password do not match");
                                        }
                                    } else {
                                        errorMessage("Please Confirm Password");
                                    }
                                } else {
                                    errorMessage("Password should be less than 8 characters");
                                }
                            } else {
                                errorMessage("Please Enter Password");
                            }
                        } else {
                            errorMessage("Please Select Class Section");
                        }
                    } else {
                        errorMessage("Please Enter UserName");
                    }
                } else {
                    errorMessage("Please Enter a Valid Phone Number");
                }
            } else {
                errorMessage("Please Enter Phone Number");
            }
        } else {
            errorMessage("Please Enter Address");
        }
    } else {
        errorMessage("Please Enter Student Name");
    }
}




function EditData(ele, id, field, table, tbl_id) {


    var value = document.getElementById(ele.id).value;

    const data = {
        tbl_id: tbl_id,
        id: id,
        field: field,
        table: table,
        value: value
    }

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=Editdata",
        data: data,
        success: function ($data) {
            console.log($data);
            successToast("Updated Data");
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}

function deleteSection(id, table, field) {

    var data = {
        id: id,
    }

    $.ajax({
        method: "GET",
        url: "../server/api.php?function_code=getSectionHasStudentORTeacher",
        data: data,
        success: function ($data) {
            console.log($data);
            if ($data <= 0) {
                deleteData(id, table, field);
            } else {
                sweetAlert2(warning, 'This Section has Teacher or Student. Please change them to anothe section befoure Delete! Please try again!');
            }

        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}



function deleteData(id, table, field) {

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

function callDeleteRequest(data) {
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

function updateCred(form, id, field, table, tbl_id) {

    let fd = new FormData(form);

    fd.append('id', id);


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
                            successToast("Password Updated");

                        },
                        error: function (error) {
                            console.log(`Error ${error}`);
                            sweetAlert2(warning, 'Something Wrong.Try again!!');
                        }
                    });

                } else { errorMessage("Password and Confirm Password does not match"); }
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


function loadclass(ele, id, field, table, tbl_id, sec_id) {
    var value = document.getElementById(ele.id).value;
    // Check if section is already assigned to another teacher
    if (table === 'teacher') {
        isSectionAssigned(value)
            .then(function (isAssigned) {
                if (isAssigned) {
                    sweetAlert2(warning, 'This section is already assigned to another teacher. Please select another section.');
                    // Reset the dropdown to the previously selected value
                    document.getElementById(ele.id).value = sec_id;
                    return;
                }
                // Update the is_assigned field for the previously selected section
                return EditDatawithValue("0", sec_id, "is_assigned", "section", "sec_id");
            })
            .then(function () {
                // Update the selected section for the teacher
                return EditData(ele, id, field, table, tbl_id);
            })
            .then(function () {
                // Update the is_assigned field for the newly selected section
                return EditDatawithValue("1", value, "is_assigned", "section", "sec_id");
            })
            .catch(function (error) {
                console.log(`Error ${error}`);
                sweetAlert2(warning, 'Something went wrong. Please try again!');
            });
    } else {
        // Update the selected section for the student
        EditData(ele, id, field, table, tbl_id);
    }
}

function isSectionAssigned(sec_id) {
    const data = {
        sec_id: sec_id
    };
    return $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=IsSectionAssigned",
        data: data
    })
        .then(function (data) {
            return data === 'true';
        })
        .catch(function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something went wrong. Please try again!');
            return false;
        });
}



function EditDatawithValue(value, id, field, table, tbl_id) {

    const data = {
        tbl_id: tbl_id,
        id: id,
        field: field,
        table: table,
        value: value
    }


    return $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=Editdata",
        data: data,
        success: function (data) {
            console.log(data);
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something went wrong. Please try again!');
        }
    });
}



function viewSections() {
    var cls_id = document.getElementById('class').value;
    const data = { value: cls_id };

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=fetchsec",
        data: data,
        success: function (data) {
            // Parse the JSON data
            var sections = JSON.parse(data);

            // Get the section select element
            var sect_select = document.getElementById('sect');

            // Clear the options in the section select element
            sect_select.innerHTML = '';

            // Add the default option
            var default_option = document.createElement('option');
            default_option.text = '--Select Section--';
            default_option.selected = true;
            sect_select.add(default_option);

            // Add the fetched sections to the section select element
            for (var i = 0; i < sections.length; i++) {
                var section_option = document.createElement('option');
                section_option.value = sections[i].sec_id;
                section_option.text = sections[i].sec_name;
                sect_select.add(section_option);
            }
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}

function viewSectionsTe() {
    var cls_id = document.getElementById('class').value;
    const data = { value: cls_id };

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=fetchsecTe",
        data: data,
        success: function (data) {
            // Parse the JSON data
            var sections = JSON.parse(data);

            // Get the section select element
            var sect_select = document.getElementById('sect');

            // Clear the options in the section select element
            sect_select.innerHTML = '';

            // Add the default option
            var default_option = document.createElement('option');
            default_option.text = '--Select Section--';
            default_option.selected = true;
            sect_select.add(default_option);

            // Add the fetched sections to the section select element
            for (var i = 0; i < sections.length; i++) {
                var section_option = document.createElement('option');
                section_option.value = sections[i].sec_id;
                section_option.text = sections[i].sec_name;
                sect_select.add(section_option);
            }
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}

function viewSectionsEdit(selectId, classId, sectionId) {
    var cls_id = document.getElementById(selectId).value;
    const data = { value: cls_id };

    $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=fetchSecs",
        data: data,
        success: function (data) {
            // Parse the JSON data
            var sections = JSON.parse(data);

            // Get the section select element
            var sect_select = document.getElementById('sect');

            // Clear the options in the section select element
            sect_select.innerHTML = '';

            // Add the default option
            var default_option = document.createElement('option');
            default_option.text = '--Select Section--';
            default_option.value = '';
            sect_select.add(default_option);

            // Add the fetched sections to the section select element
            for (var i = 0; i < sections.length; i++) {
                var section_option = document.createElement('option');
                section_option.value = sections[i].sec_id;
                section_option.text = sections[i].sec_name;
                if (section_option.value == sectionId) {
                    section_option.selected = true;
                }
                sect_select.add(section_option);
            }

            // Set the selected class option
            var class_select = document.getElementById(selectId);
            class_select.value = classId;
        },
        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}


//Teachers
function addTeacher(form) {

    let fd = new FormData(form);

    if (fd.get('name').trim() !== '') {
        if (fd.get('email').trim() !== '') {
            // Validate email using regex
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (emailRegex.test(fd.get('email').trim())) {
                if (fd.get('address').trim() !== '') {
                    if (fd.get('phone').trim() !== '') {
                        // Validate phone number using regex
                        let phoneRegex = /^(?:\+94|0)?(7[0-9]{8})$/;
                        if (phoneRegex.test(fd.get('phone').trim())) {
                            if (fd.get('sect') && fd.get('sect').trim() !== '' && fd.get('sect').trim() !== '--Select Section--') {
                                if (fd.get('pass').trim() !== '') {
                                    if (fd.get('pass').trim().length <= 8) {
                                        if (fd.get('confpass').trim() !== '') {
                                            if (fd.get('pass').trim() === fd.get('confpass').trim()) {

                                                $.ajax({

                                                    method: "POST",
                                                    url: "../server/api.php?function_code=addTeacher",
                                                    data: fd,
                                                    success: function ($data) {
                                                        console.log($data);

                                                        if ($data == "0") {
                                                            errorMessage_R("This Teacher is already assigned to this section.");
                                                        } else if ($data == "1") {
                                                            errorMessage_R("This Teacher already exists.");
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

                                            } else { errorMessage("Password and Confirm Password does not match"); }
                                        } else { errorMessage("Please Confirm Password"); }
                                    } else { errorMessage("Password should be less than 8 characters"); }
                                } else { errorMessage("Please Enter Password"); }
                            } else { errorMessage("Please Select Class Section"); }
                        } else { errorMessage("Please Enter Valid phone number"); }
                    } else { errorMessage("Please Enter Phone Number"); }
                } else { errorMessage("Please Enter Address"); }
            } else { errorMessage("Please enter a valid email address."); }
        } else { errorMessage("Please Enter Email"); }
    } else { errorMessage("Please Enter Student Name"); }
}


function userLogin(myForm) {

    var fd = new FormData(myForm);

    if (fd.get('userType').trim() != '') {
        if (fd.get('userName').trim() != '') {
            if (fd.get('password').trim() != '') {

                $.ajax({
                    method: "POST",
                    url: "../server/api.php?function_code=login",
                    data: fd,

                    success: function (data) {

                        if (data > 0) {

                            if (fd.get('userType') == 'admin') {

                                window.location.href = 'index.php';

                            } else if (fd.get('userType') == 'teacher') {

                                window.location.href = 'index.php';

                            } else if (fd.get('userType') == 'student') {

                                window.location.href = 'index.php';
                            }

                        } else {
                            iziToast.error({
                                timeout: 2000,
                                title: 'Error',
                                message: "Username or Password is Wrong",
                            });
                        }

                    },

                    contentType: false,
                    processData: false,
                    error: function (error) {
                        console.log(`Error ${error}`);
                        sweetAlert2(warning, 'Something Wrong.Try again!!');
                    }


                });


            } else { errorMessage("Please Enter Password"); }
        } else { errorMessage("Please Enter Username or Email"); }
    } else { errorMessage("Please Select User Role"); }
}

// function handleCheckboxChange(myForm, t_id) {

//     var checkboxes = myForm.querySelectorAll('input[type="checkbox"]');
//     var selectedIds = [];

//     checkboxes.forEach(function (checkbox) {
//         var id = checkbox.value;
//         var sec_id = checkbox.dataset.secid;
//         var checked = checkbox.checked ? 1 : 0; // Set checked to 1 if checkbox is checked, otherwise set it to 0
//         // Add the selected id and its checked status to the array
//         selectedIds.push({ id: id, sec_id: sec_id, checked: checked });
//     });

//     // Perform batch insert
//     if (selectedIds.length > 0) {
//         var data = 'ids=' + JSON.stringify(selectedIds) + '&t_id=' + t_id;
//         var ajaxRequest = $.ajax({
//             method: "POST",
//             url: "../server/api.php?function_code=checkAttendance",
//             data: data,
//             success: function ($data) {
//                 console.log($data);

//                 if ($data == 0) {
//                     successToast("Attendance taken Successfully");
//                 }else{
//                     successToast("Attendance taken for Today");
//                 }

//             },
//             error: function (error) {
//                 console.log(`Error ${error}`);
//                 sweetAlert2(warning, 'Something Wrong.Try again!!');
//             }
//         });
//     } else {
//         errorMessage_R("No students selected!");
//     }
// }

function handleCheckboxChange(myForm, t_id) {

    var checkboxes = myForm.querySelectorAll('input[type="checkbox"]');
    var selectedIds = [];

    checkboxes.forEach(function (checkbox) {
        var id = checkbox.value;
        var sec_id = checkbox.dataset.secid;
        var checked = checkbox.checked ? 1 : 0; // Set checked to 1 if checkbox is checked, otherwise set it to 0
        // Add the selected id and its checked status to the array
        selectedIds.push({ id: id, sec_id: sec_id, checked: checked });
    });

    var duplicateIds = findDuplicateIds(selectedIds);
    var emptyIds = findEmptyIds(selectedIds);

    if (duplicateIds.length > 0) {
        // Show Swal.fire error message for duplicate attendance
        Swal.fire({
            title: 'Error!',
            text: 'Duplicate attendance detected. Please select unique values.',
            icon: 'error'
        });
    } else if (emptyIds.length > 0) {
        // Show Swal.fire confirmation prompt for empty attendance
        Swal.fire({
            title: 'Confirmation',
            text: 'Some students have empty attendance. Do you want to continue?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform batch insert
                performBatchInsert(selectedIds, t_id);
            }
        });
    } else {
        // Perform batch insert
        performBatchInsert(selectedIds, t_id);
    }
}

function findDuplicateIds(selectedIds) {
    var duplicateIds = [];
    var idCounts = {};
    for (var i = 0; i < selectedIds.length; i++) {
        var id = selectedIds[i].id;
        if (idCounts[id] === undefined) {
            idCounts[id] = 1;
        } else {
            duplicateIds.push(id);
        }
    }
    return duplicateIds;
}

function findEmptyIds(selectedIds) {
    var emptyIds = [];
    for (var i = 0; i < selectedIds.length; i++) {
        var checked = selectedIds[i].checked;
        if (checked === 0) {
            emptyIds.push(selectedIds[i].id);
        }
    }
    return emptyIds;
}

function performBatchInsert(selectedIds, t_id) {

    var data = 'ids=' + JSON.stringify(selectedIds) + '&t_id=' + t_id;
    var ajaxRequest = $.ajax({
        method: "POST",
        url: "../server/api.php?function_code=checkAttendance",
        data: data,
        success: function (data) {
            var count = JSON.parse(data);

            if(count <= 0) {
                successToast("Attendance taken Successfully");
            } else {
                errorMessage_R("Attendance taken for Today");
            }
        },

        error: function (error) {
            console.log(`Error ${error}`);
            sweetAlert2(warning, 'Something Wrong.Try again!!');
        }
    });
}


function classAttendance(myForm) {

    var fd = new FormData(myForm);
    var value = fd.get('dateTaken');
    window.location.href = "viewattendance.php?key=" + value;
}

function getreport(myForm, t_id) {

    var fd = new FormData(myForm);
    var value = fd.get('dateTaken');
    window.location.href = "get_report.php?date=" + value;
}


function studentAttendance(myForm) {

    var fd = new FormData(myForm);
    var std_id = fd.get('std_id');
    window.location.href = "stdattendance.php?std_id=" + std_id;

}

