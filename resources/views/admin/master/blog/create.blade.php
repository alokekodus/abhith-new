@extends('layout.admin.layoout.admin')

@section('title', 'Blog')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Blog</h4>
                <form class="forms-sample" id="blogForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="100" placeholder="Enter Blog Name">
                        <span class="text-muted" style="font-size:12px;margin-top:5px;">Allowed characters 100.</span>
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select name="blog_category" id="blog_category" class="form-control" required>
                            <option value="" selected disabled> -- Select -- </option>
                            <option value="Fashion">Fashion</option>
                            <option value="Food ">Food </option>
                            <option value="Travel">Travel</option>
                            <option value="Music">Music</option>
                            <option value="Lifestyle">Lifestyle</option>
                            <option value="Fitness">Fitness</option>
                            <option value="DIY">DIY</option>
                            <option value="Sports">Sports</option>
                            <option value="Movie">Movie</option>
                        </select>
                        <span class="text-danger" id="blog_category_error"></span>
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" class="filepond" name="pic" id="banner_pic" data-max-file-size="1MB"
                            data-max-files="1" />
                            <span class="text-danger" id="pic_error"></span>

                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" id="editor" name="description"></textarea>
                        <span class="text-danger" id="data_error"></span>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

   

    <script>

    window.onload = function() {
            CKEDITOR.replace( 'editor', {
                height: 200,
                filebrowserUploadMethod: 'form',
                filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
            });
	};

        FilePond.registerPlugin(

            FilePondPluginFileEncode,

            FilePondPluginFileValidateSize,

            FilePondPluginImageExifOrientation,

            FilePondPluginImagePreview,

            FilePondPluginFileValidateType
        );

        // Select the file input and use create() to turn it into a pond
        pond = FilePond.create(
            document.getElementById('banner_pic'), {
                allowMultiple: true,
                maxFiles: 5,
                instantUpload: false,
                imagePreviewHeight: 135,
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed:'Not a valid image.',
                labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
            }
        );

       

        $("#blogForm").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            $("#name_error").empty();
            $("#subject_id_error").empty();
            $("#pic_error").empty();



            var formdata = new FormData(this);

            var data = CKEDITOR.instances.editor.getData();

            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                // append the blob file
                formdata.append('pic', pondFiles[i].file);
            }


            formdata.append('data', data);
            if(pondFiles[0].status != 2){
                toastr.error('Not a valid image. Allowed image extensions png or jpg/jpeg');
            }else{
                $.ajax({

                    type: "POST",
                    url: "{{ route('admin.creating.blog') }}",
                    // data: form.serialize(), // serializes the form's elements.
                    data: formdata,
                    processData: false,
                    contentType: false,
                    statusCode: {
                        422: function(data) {
                            var errors = $.parseJSON(data.responseText);

                            $.each(errors.errors, function(key, val) {
                                $("#" + key + "_error").text(val[0]);
                            });

                        },
                        200: function(data) {
                            // $('#blogForm').trigger("reset");
                            toastr.success(data.message);
                            location.reload();

                            // alert('200 status code! success');
                        },
                        500: function() {
                            alert('500 someting went wrong');
                        }
                    }
                });
            }
        })
    </script>

@endsection
