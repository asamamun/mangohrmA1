<div class="Formcontainer" >
    <div class="col-md-12">

        <button type="button" class="btn btn-success" id="addempattach">Attachment</button>
        <button type="button" class="btn btn-info" id="showempeeducation">Show</button>
    </div>
    <br>
    <br>
    <div id="message" class="text-danger"></div>
    <div class="col-md-12">
        <br>
        <form action="<?php echo site_url("Emp_attachment/upload") ?>" id="form-upload" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" value="" name="id"/> 
            <div class="form-body">

                <div class="form-group">
                    <label class="control-label col-md-3">File Title :</label>
                    <div class="col-md-9">
                        <input type="text" name="attachmenttitle" id="attachmenttitle" class="form-control" required="required">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">File Description :</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="5" id="attachmentdesc" name="attachmentdesc"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Attachment File :</label>
                    <div class="col-md-9">
                        <input type="file" name="file" id="file" class="form-control" required="required">
                        <span class="help-block"></span>
                    </div>
                </div>

                <?php if($this->session->flashdata('AttachmentUploadError')!=NULL){
                    echo $this->session->flashdata('AttachmentUploadError');} ?>

            <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
                <div class="progress" style="display:none;">
                    <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                        20%
                    </div>
                </div>

                <ul class="list-group"></ul>

            </div>
            <div class="row">
                <label class="control-label col-md-3"></label>
                <div class="col-md-9">
                    <button type="button" id="upload-btn"  class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="empedudivs">
        <?php //echo $this->load->view('employee/_emexperienceInTable',array('empexperience'=>$empexperience), TRUE); ?>
    </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->	
<script src="<?php echo site_url(); ?>assets/jquery/emp_Attachment_upload.js"></script>  
<script>
    loadTableData();
    function loadTableData() {
        var urls = "<?php echo site_url('Emp_attachment/LoadTableData') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);
            // alert(data);


            if (data != "") {
                var html = '<table class="table sar-table table-striped">'
                html += '<tr><th style = "width: 10px">#</th><th>Title</th><th>Description</th><th>Created</th><th width="150px">Action</th></tr>';
                var i = 1;

                data.forEach(function(value, index) {
                    //alert(data)
                    html += '<tr>';
                    html += "<td>" + i++ + "</td>";
                    html += "<td>" + value.title + "</td>";
                    html += "<td>" + value.filedesc + "</td>";
                    html += "<td>" + value.created + "</td>";
                    //html += '<td><a class="btn btn-sm btn-warning" href="#" title="Edit" onClick="edit_empexperience(' . $emp_experience['id'] . ')"><i class="glyphicon glyphicon-pencil"></i> </a>' . ' ' . '<a class="btn btn-sm btn-danger" href="#" title="Hapus" onClick="delete_empexperience(' . $emp_experience['id'] . ')"><i class="glyphicon glyphicon-trash"></i> </a></td>';
                    html += '<td><a class="btn btn-sm btn-warning" title="Edit" onClick="Delete_attachment(' + value.id + ')"><i class="glyphicon glyphicon-trash"></i> </a> </td>';
                    html += '</tr>';
                });
                html += '</table>';
                $("#empedudivs").html(html);

            } // If Condtion END

        });
    }

    function Delete_attachment(id) {
        if (confirm('Are you sure delete this data ?')) {
            $.ajax({
                url: "<?php echo site_url('Emp_attachment/deleteAttachment') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    ShowActionMessage('Record deleted successfully!!!')
                    loadTableData();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    ShowActionMessage('Record deletion failed ', false)
                    loadTableData()
                }
            });
        }
    }
</script>