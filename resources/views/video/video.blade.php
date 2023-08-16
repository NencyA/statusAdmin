@extends('layout.master')
@section('styles')
<style>
    /* Style for the form container */
    .form-container {
        padding: 20px;
    }

    /* Style for the Select2 dropdown */
    .select2-container--default .select2-selection--single {
        height: 40px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 8px;
    }

    /* Style for the file input */
    .custom-file-input {
        cursor: pointer;
    }

    /* Additional styling as needed */
</style>
@endsection
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
                    <a href="#" class="btn btn-dark position-absolute mb-auto" data-toggle="modal" data-target="#addVideoModal" style="right: 30px; bottom: 5px ">Add Video</a>
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


<div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="form-container">
                <!-- <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data"> -->
                <form id=AddVideoModal method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="emailId">Select Email:</label>
                            <select id="emailId" name="emailId" class="form-control select2" style="width: 100%;">
                                <option value="" selected disabled>Select Email</option>
                                @foreach ($emailIds as $email)
                                <option value="{{ $email }}">{{ $email }}</option>
                                @endforeach
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="language" class="col-form-label">Language:</label><br>
                            <select class="form-control" id="language" name="language" style="width: 100%;">
                                <option value="Hindi">Hindi</option>
                                <option value="English">English</option>
                                <option value="Gujrati">Gujrati</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="hashTag">Select Hashtag:</label>
                            <select id="hashTag" name="hashTag[]" class="form-control select2" style="width: 100%;" multiple>
                                @foreach ($hashTags as $hashTag)
                                <option value="{{ $hashTag }}">{{ $hashTag }}</option>
                                @endforeach
                                <option value="__custom__">Other (please specify)</option>
                            </select>
                            <input type="text" id="customHashTagInput" class="form-control" style="display: none;" placeholder="Enter custom hashtag">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" id="description" class="form-control" name="description" placeholder="Enter description">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="videos" class="d-block">Select Videos:</label>
                            <input type="file" name="videos[]" accept="video/*" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="videodataedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id=videodataEdit method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="emailIdU">Select Email:</label>
                        <select id="emailIdU" name="emailIdU" class="form-control select2" style="width: 100%;">
                            <option value="" selected disabled>Select Email</option>
                            @foreach ($emailIds as $email)
                            <option value="{{ $email }}">{{ $email }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="languageU" class="col-form-label">Language:</label><br>
                        <select class="form-control" id="languageU" name="languageU" style="width: 100%;" multiple>
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            <option value="Gujrati">Gujrati</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="hashTagU">Select Hashtag:</label>
                        <select id="hashTagU" name="hashTagU[]" class="form-control select2" style="width: 100%;" multiple>
                            @foreach ($hashTags as $hashTag)
                            <option value="{{ $hashTag }}">{{ $hashTag }}</option>
                            @endforeach
                            <option value="__custom__">Other (please specify)</option>
                        </select>
                        <input type="text" id="customHashTagInput" class="form-control" style="display: none;" placeholder="Enter custom hashtag">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="descriptionU">Description:</label>
                        <input type="text" id="descriptionU" class="form-control" name="descriptionU" placeholder="Enter description">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="videos" class="d-block">Select Videos:</label>
                        <input type="file" name="videos[]" accept="video/*" multiple>
                        <div id="videosU"></div>
                    </div>
                    <input type="hidden" id="videoId" class="form-control" name="videoId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $(document).ready(function() {

        $('#emailId, #language').select2({
            dropdownParent: $('#addVideoModal')
        });

        $('#hashTag').select2({
            dropdownParent: $('#addVideoModal'),
            tags: true,
            createTag: function(params) {
                var term = $.trim(params.term.replace(/\s+/g, ''));
                if (term === '') {
                    return null;
                }
                var formattedTerm = '#' + term.replace(/^#/, '');
                return {
                    id: formattedTerm,
                    text: formattedTerm,
                    newTag: true
                };
            }
        }).on('select2:select', function(e) {
            if (e.params.data.newTag) {
                if ($(this).find("option[value='" + e.params.data.id + "']").length === 0) {
                    $(this).append(new Option(e.params.data.text, e.params.data.id, true, true));
                    $(this).trigger('change');
                }
            }
        });

        $("#AddVideoModal").submit(function(e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('videos.store')}}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('.modal-backdrop').hide();
                        $('#addVideoModal').hide();
                        $(".datatable").DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });

        $("#videodataEdit").submit(function(e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('user-video-edit')}}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('#videodataedit').modal('hide');

                        $(".data-table").DataTable().ajax.reload()
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });

        $("#hashTagU").on('select2:select', function(e) {
            if (e.params.data.newTag) {
                if ($(this).find("option[value='" + e.params.data.id + "']").length === 0) {
                    $(this).append(new Option(e.params.data.text, e.params.data.id, true, true));
                    $(this).trigger('change');
                }
            }
        });

        $(document).on("click", ".videoEdit", function(e) {
            e.preventDefault();

            let id = $(this).attr('id');
            $.ajax({
                url: "{{route('video-edit')}}",
                type: "POST",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        var assetUrl = "{{ asset('storage/videos/') }}";
                        $('#videodataedit').modal('show');
                        $(".data-table").DataTable().ajax.reload();
                        $('#emailIdU').val(response.data.user_mailid);
                        $('#languageU').val(response.data.language);

                        $('#emailIdU, #languageU').select2({
                            dropdownParent: $('#videodataedit')
                        });

                        $('#descriptionU').val(response.data.description);
                        $('#videoId').val(response.data.id);
                        $('#videosU').html(`<br><video width="90" height="90" controls>
                            <source src="` + assetUrl + `/` + response.data.video_file_name + `" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>`);

                        var hashtags = response.hashTags;
                        var selectedHashtag = response.selectedhashTags || []; // Assuming response.language is an array

                        $("#hashTagU").select2({
                            dropdownParent: $('#videodataedit'),
                            tags: true,
                            createTag: function(params) {
                                var term = $.trim(params.term.replace(/\s+/g, ''));
                                if (term === '') {
                                    return null;
                                }
                                var formattedTerm = '#' + term.replace(/^#/, '');
                                return {
                                    id: formattedTerm,
                                    text: formattedTerm,
                                    newTag: true
                                };
                            }
                        });

                        $("#hashTagU").val(selectedHashtag).trigger('change');
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });
    });
</script>
@endsection