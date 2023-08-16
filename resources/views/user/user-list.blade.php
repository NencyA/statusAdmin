@extends('layout.master')

@section('content')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button><a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg></a>
            <ul class="header-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                        </svg></a></li>
            </ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Account</div>
                        </div><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                            </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                            </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                            </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Settings</div>
                        </div><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                            </svg> Profile</a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                            </svg> Settings</a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                            </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                            </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                            </svg> Lock Account</a><a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                            </svg> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <span>Home</span>
                    </li>
                    <li class="breadcrumb-item active"><span>Dashboard</span></li>
                    <a href="#" class="btn btn-dark position-absolute "  data-toggle="modal" data-target="#exampleModal" style="right: 30px; ">Add User</a>
                </ol>
            </nav>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <h2>Video-List</h2>
        <div class="row">
            {{ $dataTable->table(['width' => '100%']) }}
        </div>
    </div>
    <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
    </footer>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id=userData method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="emailId" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="emailId" name="emailId">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="mobileNumber" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label">Gender : </label>
                        <input type="radio" id="male" name="gender" value="Male">Male
                        <input type="radio" id="female" name="gender" value="Female">Female
                    </div>
                    <div class="form-group">
                        <label for="language" class="col-form-label">Language:</label><br>
                        <select class="form-control language" id="language" name="language[]" style="width: 100%;" multiple>
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            <option value="Gujrati">Gujrati</option>
                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <div class="p-2">
                            <label for="message-text" class="col-form-label">Profile:</label>
                            <input name="photo" class="form-control" type="file" accept="image/*" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <img id="img" src="#" class="mt-3" height="100" width="100" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="userdataedit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id=userDataEdit method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="nameU" name="name">
                            <input type="hidden" class="form-control" id="userId" name="userId">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailId" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="emailIdU" name="emailId">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gender" class="col-form-label">Gender : </label><br>
                            <label><input type="radio" id="maleU" name="gender" value="Male">Male</label>
                            <label><input type="radio" id="femaleU" name="gender" value="Female">Female</label>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="language" class="col-form-label">Language:</label><br>
                            <div class="language"></div>
                            <select class="form-control language" id="languageU" name="language[]" style="width: 100%;" multiple>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mobileNumber" class="col-form-label">Mobile Number:</label>
                            <input type="text" class="form-control" id="mobileNumberU" name="mobileNumber">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="col-form-label">Followers:</label>
                            <input type="text" class="form-control" id="followersU" name="followers">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password" class="col-form-label">Following:</label>
                            <input type="text" class="form-control" id="flowingU" name="flowing">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="col-form-label">Post:</label>
                            <input type="text" class="form-control" id="postbyuserU" name="postbyuser">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Profile:</label>
                            <input name="photo" class="form-control" type="file" accept="image/*" onchange="document.getElementById('photo1').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="form-group col-md-6">
                            <img id="photo1" src="" class="mt-3" height="100" width="100" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-dark">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')

{!! $dataTable->scripts() !!}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#users-table thead').addClass('table-light');
        $('#users-table').addClass('table border mb-0');
    });
    $('#language').select2({
        dropdownParent: $('#exampleModal')
    });

    $("#userData").submit(function(e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{route('user-create')}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if (response.status == 1) {
                    toastr.success(response.message);
                    alert(response.message);
                    $('#exampleModal').modal('hide');
                    $(".data-table").DataTable().ajax.reload()
                } else {
                    alert(response.message);
                    toastr.error(response.message);
                }
            }
        });
    });

    $(document).on("click", ".userEdit", function(e) {
        $('#languageU').html('');
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: "{{route('user-edit')}}",
            type: "POST",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                if (response.status == 1) {
                    $('#userdataedit').modal('show');
                    $(".data-table").DataTable().ajax.reload();
                    $('#nameU').val(response.data.name);
                    $('#userId').val(response.data.userId);
                    $('#emailIdU').val(response.data.emailId);
                    $('#mobileNumberU').val(response.data.mobileNumber);
                    $('#flowingU').val(response.data.flowing);
                    $('#followersU').val(response.data.followers);
                    $('#postbyuserU').val(response.data.postbyuser);
                    $('input[name="gender"]').prop('checked', false); // Uncheck all radio buttons
                    $('input[name="gender"][value="' + response.data.gender + '"]').prop('checked', true);
                    $('#photo1').attr("src", response.data.profilePicLink);
                    var languages = ["Hindi", "English", "Gujrati"];
                    var selectedLanguages = response.language || []; // Assuming response.language is an array
                    $("#languageU").select2({
                        data: languages.map(function(language) {
                            return {
                                id: language,
                                text: language,
                                selected: selectedLanguages.includes(language)
                            };
                        })
                    });
                } else {
                    alert(response.message);
                    toastr.error(response.message);
                }
            }
        });
    });

    $("#userDataEdit").submit(function(e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{route('user-update')}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if (response.status == 1) {
                    toastr.success(response.message);
                    $('#userdataedit').modal('hide');
                    $("#users-table").DataTable().ajax.reload();
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    // $('.toggle-class').change(function() {
    $(document).on("click", ".toggle-class", function(e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'user-status',
            data: {
                'status': status,
                'user_id': user_id
            },
            success: function(data) {
                toastr.success(data.success);
            }
        });
    })

    $(document).on("click", ".deleteRecord", function(e) {
        var id = $(this).attr("id");
        var token = $("meta[name='csrf-token']").attr("content");
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: "user-delete",
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(data) {
                    toastr.success(data.success);
                    $("#users-table").DataTable().ajax.reload();
                }
            });
        } else {
            $("#users-table").DataTable().ajax.reload();
        }
    });
</script>
@endsection