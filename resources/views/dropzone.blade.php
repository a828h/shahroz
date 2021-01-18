<link rel="stylesheet" href="{{asset('assets/plugins/custom/dropzone/dropzone.css?v1')}}" />
<script src="{{asset('assets/plugins/custom/dropzone/dropzone.js')}}"></script>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="dropzone dropzone-multi" id="kt_dropzone_5">
                <div class="dropzone-panel mb-lg-0 mb-2">
                    <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">@lang('admin.global.attach')</a>
                </div>
                <div class="dropzone-items">
                    <div class="dropzone-item" style="display:none">
                        <div class="dropzone-file">
                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                <span style="position: relative" data-dz-name="">some_image_file_name.jpg</span>
                                <img class="dropzone-img" data-dz-thumbnail />
                                <strong>(
                                    <span data-dz-size="">340kb</span>)</strong>
                            </div>
                            <div class="dropzone-error" data-dz-errormessage=""></div>
                        </div>
                        <div class="dropzone-progress">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                            </div>
                        </div>
                        <div class="dropzone-toolbar">
                            <span class="dropzone-delete" data-dz-remove="">
                                <i class="flaticon2-cross"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <span class="form-text text-muted">حداکثر حجم آپلود فایل  ۲۰ مگابایت است</span>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var id = '#kt_dropzone_5';

         // set the preview element template
         var previewNode = $(id + " .dropzone-item");
         previewNode.id = "";
         var previewTemplate = previewNode.parent('.dropzone-items').html();
         previewNode.remove();

         var myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
            url: "{{ route('admin.dropzone.upload', [$type, $id]) }}",
            parallelUploads: 1,
            maxFilesize: 20, // Max filesize in MB
            previewTemplate: previewTemplate,
            //addRemoveLinks: true,
            acceptedFiles : ".mp4,.mkv,.avi, .jpeg, .jpg, .png, .gif",
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            clickable: id + " .dropzone-select", // Define the element that should be used as click trigger to select files.
            init:function(){
                myDropzone = this;
                $.ajax({
                    url: "{{ route('admin.dropzone.fetch',[$type, $id]) }}",
                    type: 'get',
                    data: {request: 2},
                    dataType: 'json',
                    success: function(response){
                        $.each(response, function(key,value) {
                            console.log(value);
                            var mockFile = { name: value.name, size: value.size  };
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, value.path);
                            myDropzone.emit("complete", mockFile);
                        });
                    },
                });
            },
            removedfile: function(file) {
                var name = file.name;
                if (file.xhr && file.xhr.response) {
                    name = JSON.parse(file.xhr.response).name;
                }
                $.ajax({
                    url:"{{ route('admin.dropzone.delete') }}",
                    data:{name : name},
                    success:function(data){
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                })
            },
         });

         myDropzone5.on("addedfile", function(file) {
             // Hookup the start button
             $(document).find( id + ' .dropzone-item').css('display', '');
         });

         // Update the total progress bar
         myDropzone5.on("totaluploadprogress", function(progress) {
             $( id + " .progress-bar").css('width', progress + "%");
         });

         myDropzone5.on("sending", function(file) {
             // Show the total progress bar when upload starts
             $( id + " .progress-bar").css('opacity', "1");
         });

         // Hide the total progress bar when nothing's uploading anymore
         myDropzone5.on("complete", function(progress) {
             var thisProgressBar = id + " .dz-complete";
             setTimeout(function(){
                 $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
             }, 300)
         });
    })

</script>
