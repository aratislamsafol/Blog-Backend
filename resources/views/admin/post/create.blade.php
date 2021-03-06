<form id='create' action="" enctype="multipart/form-data" method="post"
      accept-charset="utf-8">
      @csrf
    <div class="box-body">
        <div id="status"></div>
        <div class="form-group col-md-10 col-sm-12">
            <label for="tour_image">Post Title</label>
            <input type="text" class="form-control" id="post_title"  name="post_title" value=""
                   placeholder="" required>
            <span id="error_first_name" class="has-error"></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
            <label for="tour_image">Post Details</label>
            <input type="text" class="form-control" id="post_details"  name="post_details" value=""
                   placeholder="" required>
            <span id="error_first_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-10 col-sm-12">
            <label for="post_image">Post Image</label>
            <input type="file" class="form-control" id="post_img"  name="post_img" value=""
                   placeholder="" required>
            <span id="error_first_name" class="has-error"></span>
        </div>


        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.box-body -->
</form>


<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {


            },
            // Messages for form validation
            messages: {

            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);

                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')},
                    url: "{{ route('posts.store') }}",
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();

                        // $("#submit").prop('disabled', false); // disable button
                    },
                    success: function (data) {

                        $("#status").html(data.html);
                        reload_table();
                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $('#modalUser').modal('hide'); // hide bootstrap modal
                    },
                    error:function(error){

                        console.error(error)
                        // console.log(error.responseJSON.errors);
                    // Swal.fire({
                    //     text: 'Event Name already added Or file is not jpg,png,jpeg',
                    //     icon: 'error',
                    //     confirmButtonText: 'Ok'
                    //     })
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>
{{-- <script>
    $(function(){
      'use strict';

      // Inline editor
      var editor = new MediumEditor('.editable');

      // Summernote editor
      $('#summernote').summernote({
        height: 150,
        tooltip: false
      })
    });
  </script> --}}






