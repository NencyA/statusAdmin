@extends('layout.master')

@section('content')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class=" header-sticky mb-4">
       <div class="header-divider"></div>
       <div class="container-fluid ">
          <nav aria-label="breadcrumb">
             <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                   <span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Reported-Video</span></li>
             </ol>
          </nav>
       </div>
    </header>
    <div class="body flex-grow-1 px-3 card-body">
       <div class="">
          <h2>Reported-Video List</h2>
          <div class="row">
             {!! $dataTable->table() !!}
          </div>
       </div>
    </div>
    <footer class="footer">
       <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
       <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
    </footer>
</div>

<div class="modal fade bd-example-modal-lg" id="videoDetails" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
              <div class="card mt-4 mb-4">
                <div class="modal-header"><h5 class="modal-title" id="exampleModalLiveLabel">Video Details</h5><button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button></div>
                <div class="card-body">
                  <div class="bd-example">
                    <dl class="row">
                      <dt class="col-sm-3">Name:</dt>
                      <dd class="col-sm-9" id="name"></dd>
                      <dt class="col-sm-3">Hashtag:</dt>
                      <dd class="col-sm-9" id="hashtag"></dd>
                      <dt class="col-sm-3">Language:</dt>
                      <dd class="col-sm-9"id="language"></dd>
                      <dt class="col-sm-3">Like:</dt>
                      <dd class="col-sm-9" id="video_like"></dd>
                      <dt class="col-sm-3">Share:</dt>
                      <dd class="col-sm-9" id="share"></dd>
                      <dt class="col-sm-3">Download:</dt>
                      <dd class="col-sm-9" id="download"></dd>
                      <dt class="col-sm-3">Video:</dt>
                      <dd class="col-sm-9"id="video">
                      </dd>
                      <dt class="col-sm-3">Description:</dt>
                      <dd class="col-sm-9" id="description"></dd>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
        </div>
       </div>
    </div>
</div>

@endsection
@section('js')
{!! $dataTable->scripts() !!}
<script>
$(document).ready(function() {
        $('#reportedvideo-table thead').addClass('table-light');
        $('#reportedvideo-table').addClass('table border mb-0');
    });
    $(document).on("click",".videobtn",function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $("#video").html('');
        $.ajax({
            url: "{{route('reported-video-data')}}",
            type:"POST",
            dataType:'json',
            data: {
            "_token": "{{ csrf_token() }}",
            id: id
            },
            success:function(response)
            {
                if(response.status == 1){
                    $('#videoDetails').modal('show');
                    $(".data-table").DataTable().ajax.reload();
                    $('#name').html(response.data.name);
                    $('#hashtag').html(response.data.hashtag);
                    $('#description').html(response.data.description);
                    $('#video_file_name').html(response.data.video_file_name);
                    $('#language').html(response.data.language);
                    $('#video_like').html(response.data.video_like);
                    $('#share').html(response.data.share);
                    $('#download').html(response.data.download);
                    $("#video").html('<video width="320" height="240" id="video" controls><source src="{{ asset("/video/") }}' + '/' + response.data.video_file_name + '" type="video/mp4"></video>');
                }else{
                    alert(response.message);
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
@endsection
