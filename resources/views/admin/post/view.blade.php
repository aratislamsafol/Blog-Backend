<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
                <thead>
                    <th scope="col">Post Title</th>
                    <th scope="col">Post Details</th>
                    <th scope="col">Post Image</th>

                </thead>
                <tr >
                    <td> {{($tougallery->post_title) }}</td>
                    <td>{{($tougallery->post_details) }}</td>
                    <td> <img src="{{ asset($tougallery->post_img) }}" frameborder="0" width="100%" height="70%"> </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
