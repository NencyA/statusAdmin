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
          <a href="#" class="btn btn-dark position-absolute mb-auto" data-toggle="modal" data-target="#addCategoryModal" style="right: 30px; ">Add Category</a>
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

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="form-container">
        <form id=AddCategory method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="category">Category:</label>
              <input type="text" id="category" class="form-control" name="category" placeholder="Enter Category">
            </div><br>
            <div class="form-group">
              <label for="hashTag">Select Hashtag:</label>
              <select id="hashTag" name="hashTag[]" class="form-control select2" style="width: 100%;" multiple>
                @foreach ($uniqueHashtags as $uniqueHashtag)
                <option value="{{ $uniqueHashtag }}">{{ $uniqueHashtag }}</option>
                @endforeach
                <option value="__custom__">Other (please specify)</option>
              </select>
              <input type="text" id="customHashTagInput" class="form-control" style="display: none;" placeholder="Enter custom hashtag">
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

<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="form-container">
        <form id=editCategory method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Video</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="categoryU">Category:</label>
              <input type="text" id="categoryU" class="form-control" name="categoryU" placeholder="Enter Category">
            </div><br>
            <div class="form-group">
              <label for="hashTagU">Select Hashtag:</label>
              <select id="hashTagU" name="hashTagU[]" class="form-control select2" style="width: 100%;" multiple>
                @foreach ($uniqueHashtags as $uniqueHashtag)
                <option value="{{ $uniqueHashtag }}">{{ $uniqueHashtag }}</option>
                @endforeach
                <option value="__custom__">Other (please specify)</option>
              </select>
              <input type="text" id="customHashTagInput" class="form-control" style="display: none;" placeholder="Enter custom hashtag">
            </div>
            <input type="hidden" id="categoryId" class="form-control" name="categoryId">
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


@endsection
@section('js')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
  $(document).ready(function() {
    $('#hashTag').select2({
      dropdownParent: $('#addCategoryModal'), // Use the correct modal ID here
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

    $("#AddCategory").submit(function(e) {
      e.preventDefault();
      let formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{route('category.store')}}",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
          if (response.status) {
            toastr.success(response.message);
            $('.modal-backdrop').hide();
            $('#addCategoryModal').hide();
            $(".datatable").DataTable().ajax.reload()
          } else {
            toastr.error(response.message);
          }
        }
      });
    });
  });

  $("#editCategory").submit(function(e) {
    e.preventDefault();
    let formData = new FormData($(this)[0]);
    $.ajax({
      url: "{{route('category-update')}}",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      success: function(response) {
        if (response.status) {
          toastr.success(response.message);
          $('.modal-backdrop').hide();
          $('#editCategoryModal').hide();
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

  $(document).on("click", ".categoryEdit", function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
      url: "{{route('category-edit')}}",
      type: "POST",
      dataType: 'json',
      data: {
        "_token": "{{ csrf_token() }}",
        id: id
      },
      success: function(response) {
        if (response.status) {
          $('#editCategoryModal').modal('show');
          $('#categoryU').val(response.data.name);
          $('#categoryId').val(response.data.id);
          var hashtags = response.hashTags;
          var selectedHashtag = response.selectedhashTags || []; // Assuming response.language is an array
          $("#hashTagU").select2({
            dropdownParent: $('#editCategoryModal'),
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
          alert(response.message);
          toastr.error(response.message);
        }
      }
    });
  });
</script>
@endsection