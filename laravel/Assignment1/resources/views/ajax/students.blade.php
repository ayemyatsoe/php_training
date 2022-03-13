<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax CRUD Example Tutorial with - CodingDriver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .alert-message {
        color: red;
    }

</style>

<body>

    <div class="container">
        <h2 style="margin-top: 12px;" class="alert alert-success">Laravel Ajax CRUD Application -
        </h2><br>
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2">name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name">
                                    <span id="nameError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Email</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="email" name="email" placeholder="Enter email">
                                    <span id="emailError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6">Choose Major</label>
                                <div class="col-sm-12">
                                    <select class="form-select selected" name="major_id" id="major_id">
                                    </select>
                                    <span id="majorsError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">DOB</label>
                                <div class="col-sm-12">
                                    <input type="date" name="dob" id="dob" class="form-control"
                                        placeholder="Enter Student Birth Date">
                                    <span id="emailError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Address</label>
                                <div class="col-sm-12">
                                    <input type="address" id="address" name="address" class="form-control"
                                        placeholder="Enter Student Address">
                                    <span id="emailError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Phone</label>
                                <div class="col-sm-12">
                                    <input type="integer" name="phone" id="phone" class="form-control"
                                        placeholder="Enter Student Phone">
                                    <span id="emailError" class="alert-message"></span>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12 text-right mb-3 float-right">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Student</a>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <table id="laravel_crud" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Major</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            init();

            function init() {
                getMajors();

            }

            function getMajors() {
                $.ajax({
                    url: "http://localhost:8000/ajax/majors",
                    type: "Get",
                    dataType: "json",
                    success: function(majors) {
                        majors = majors.data;
                        let select = $(".selected");
                        select.html("");
                        majors.forEach(major => {
                            let option = "<option value=" + major.id + ">" + major.name +
                                "</option>";
                            select.append(option);
                        })
                    }

                })
            }
            $('#createNewProduct').click(function() {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "http://localhost:8000/ajax/students",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        console.log(data.data.name);
                        var user = '<tr id="product_id' + data.data.id + '"><td>' + data.data
                            .id + '</td><td>' + data.data.name + '</td><td>' + data.data.email +
                            '</td><td>' + data.data.dob + '</td><td>' + data.data.major +
                            '</td><td>' + data.data.address + '</td><td>' + data.data.phone +
                            '</td>';
                        user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' +
                            data.data.id +
                            '" class="btn btn-info editStudent">Edit</a><a href="javascript:void(0)" id="delete-user" data-id=' +
                            data.data.id +
                            '" class="btn btn-danger deleteStudent">Delete</a></td></tr>';

                        $('#laravel_crud').prepend(user);
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');


                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });


            $.ajax({
                url: "http://localhost:8000/ajax/students",
                type: "Get",
                dataType: "json",
                success: function(items = []) {
                    if (items.items.length) {
                        items.items.forEach(student => {

                            $("#laravel_crud").append("<tbody><tr><td>" + student.id +
                                "</td><td>" +
                                student.name + "</td><td>" +
                                student.email + "</td><td>" +
                                student.dob + "</td><td>" +
                                student.major.name + "</td><td>" +
                                student.address + "</td><td>" +
                                student.phone +
                                "</td><td><a href='javascript:void(0)' id='edit-post' data-id=" +
                                student.id +
                                " class='btn btn-info mr-2 editStudent'>Edit</a><a href='javascript:void(0)' id='delete-post' data-id=" +
                                student.id +
                                " class='btn btn-danger deleteStudent'>Delete</a></td></tr></tbody>"
                            );
                        });
                    } else {
                        console.log("no length");
                    }
                }
            });

            $('body').on('click', '.deleteStudent', function() {
                var student_id = $(this).data("id");
                confirm("Are You sure want to delete !");
                $.ajax({
                    type: "DELETE",
                    url: "http://localhost:8000/ajax/students" + '/' + student_id,
                    success: function(data) {
                        $("#product_id" + student_id).remove();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.editStudent', function() {
                $('#ajaxModel').modal('show');
                var student_id = $(this).data('id');

                $.get("http://localhost:8000/ajax/students/" + student_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Product");
                    $('#ajaxModel').modal('show');
                    $('#saveBtn').val("edit-user");
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#dob').val(data.dob);
                    $('#major_id').val(data.major_id);
                    $('#address').val(data.address);
                    $('#phone').val(data.phone);


                })
            });


        });
    </script>

</body>

</html>
