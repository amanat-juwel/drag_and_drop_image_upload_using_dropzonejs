@extends('layouts.template')

@section('template')
<!-- Content Header -->
<section class="content-header">
    <h1>ITEM - ADD NEW</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('/item') }}">Item</a></li>
        <li class="active">Create Item</li>
    </ol>
</section>
<!-- End Content Header -->
<!-- Main content -->
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form class="form" action="{{ url('/item') }}" method="post" enctype="multipart/form-data">
                              {!! csrf_field() !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="">Item Name <span class="required">*</span></label>
                                    <input type="text" autocomplete="OFF" name="item_name" placeholder="Item Name" class="form-control input-sm" required />
                                    @if($errors->has('item_name'))
                                        <span class="text-danger">{{ $errors->first('item_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Item Code <span class="required">*</span></label>
                                    <input type="text" autocomplete="OFF" name="item_code" placeholder="Item Code" class="form-control input-sm" required />
                                    @if($errors->has('item_code'))
                                        <span class="text-danger">{{ $errors->first('item_code')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">MRP <span class="required">*</span></label>
                                    <input type="text" autocomplete="OFF" name="mrp" placeholder="MRP" class="form-control input-sm" required />
                                    @if($errors->has('mrp'))
                                        <span class="text-danger">{{ $errors->first('mrp')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Images <span class="required">*</span></label>
                                    <br>
                                    <input type="hidden" autocomplete="OFF" name="item_images" id="item_images" placeholder="" class="form-control input-sm" required />
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"> <i class="fa fa-image"></i> Upload Images</button>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success pull-right" value="Save"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- MODAL START -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Images</h4>
        </div>
        <div class="modal-body">
          <form action="" class="dropzone" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<!-- MODAL END -->

@endsection

@section('script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>


<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

Dropzone.autoDiscover = false;
var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
// imageDataArray variable to set value in crud form
var imageDataArray = new Array;
// fileList variable to store current files index and name
var fileList = new Array;
var i = 0;

$(function(){

    uploader = new Dropzone(".dropzone",{
        url: "{{url('item/image/upload')}}",
        paramName : "file",
        uploadMultiple :false,
        acceptedFiles : "image/*,video/*,audio/*",
        addRemoveLinks: true,
        forceFallback: false,
        maxFilesize: 256, // Set the maximum file size to 256 MB
        parallelUploads: 100,

    });//end drop zone

    uploader.on("success", function(file,response) {

        imageDataArray.push(response)

        fileList[i] = {
            "serverFileName": response,
            "fileName": file.name,
            "fileId": i
        };
   
        i += 1;

        $('#item_images').val(imageDataArray);

    });

    uploader.on("removedfile", function(file) {
        var rmvFile = "";
        for (var f = 0; f < fileList.length; f++) {

            if (fileList[f].fileName == file.name) {

                // remove file from original array by database image name
                imageDataArray.splice(imageDataArray.indexOf(fileList[f].serverFileName), 1);
                $('#item_images').val(imageDataArray);

                // get removed database file name
                rmvFile = fileList[f].serverFileName;

                // get request to remove the uploaded file from server
                $.get( "{{url('item/image/delete')}}", { file: rmvFile } )
                  .done(function( data ) {
                    //console.log(data)
                  });

                // reset imageDataArray variable to set value in crud form
                
                console.log(imageDataArray)
            }
        }
        
    });


});
</script>

@endsection