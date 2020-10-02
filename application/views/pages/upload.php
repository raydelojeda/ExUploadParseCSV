<div class="form-row mt-4" style="">

    <div class="col-lg-6 col-md-6">
        <div class="card1">
            <div class="card-body">
                <h4 class="card-title">File Upload</h4>
                <label for="input-file-now">Label</label>
                <form enctype="multipart/form-data">
                    <input type="file" id="inputFile" name="inputFile" class="dropify" data-url="Main/uploadFile" data-height="500"/>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Basic
        $('#inputFile').dropify().on('change', function ()
        {
            const formData = new FormData();
            const fileField = document.querySelector('input[type="file"]');

            formData.append('inputFile', 'inputFile');
            formData.append('file', fileField.files[0]);

            fetch("<?php echo base_url('Main/uploadFile')?>", {
                method: 'POST',
                body: formData
            })
            .then((response) => response.json())
            .then((result) => {
                toastr.success(result.msg);
                //console.log(result.msg);
            })
            .catch((error) => {
                toastr.error(error.msg);
            });
        }).on('dropify.afterClear', function(event, element) {
            toastr.success('File deleted');
        });
    });
</script>