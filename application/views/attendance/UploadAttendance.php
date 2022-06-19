<?php $this->load->view('header', array('title' => 'Upload Attendence')); ?>
<?php $this->load->view('leftnav', array('active' => 'Attend_Upload')); ?>


<div class="content-wrapper">

    <!-- /.content -->
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Attendance Upload 
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Attendance Configuration</a></li>

        </ol>
    </section>
    <div class='col-md-12'>
        <div class="col-md-12" style="background-color:#FFFFFF">
            <section class="content">
                <script></script>
                <div class="formcontainer">
                    <form action="<?php echo site_url("Attend_upload/Upload") ?>" id="form-attend-upload" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Valid File</label>
                                <div class="col-md-9">

                                    <input type="file" id="uploadAttendFile" name="file"/>
                                    <span class="help-block" id="uploadAttendFileMessage"></span>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <div class="form-group" id="uloadIntoDatabaseArea" style="display: none">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">

                            <button type="submit" id="uloadIntoDatabase" class="btn btn-primary">Update Database</button>

                            <span class="help-block"></span>

                        </div>
                    </div>
                </div>


                <form action="#" id="Uploaded_attend_data" class="form-horizontal" style="display:none">
                    <h3>Uploading Error Report</h3>
                    <table id="table" class="table sar-table table-bordered sortableTable responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL</th> 
                                <th>Employee ID</th>
                                <th>Punch Details</th>
                                <th>Advice</th>
                            </tr>
                        </thead>
                        <tbody id="Error-report-table">





                        </tbody>

                        <tfoot>
                        <thead>
                            <tr>
                                <th>SL</th> 
                                <th>Employee_ID</th>
                                <th>Punch Details</th>
                                <th style="width:200px;">Advice</th>
                            </tr>
                            </tfoot>
                    </table>


                </form>
            </section>
        </div>

    </div>
    <div class='clearfix'></div>
</div><!-- /.content-wrapper -->

<?php
$this->load->view('footer');
?>


</body>
</html>

<script type="text/javascript">

    $(document).ready(function() {

        $("#uploadAttendFile").change(function() {

            $("#uploadAttendFileMessage").html("<img width='40px' src='<?php echo site_url(); ?>assets/upload/attendence/loading.gif'>")

            var inputFile = $('input[name=file]');
            var uploadURI = $('#form-attend-upload').attr('action');

            var fileToUpload = inputFile[0].files[0];

            var formData = new FormData();
            formData.append("file", fileToUpload);

            $.ajax({
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data);
                    data = JSON.parse(data)
                    if (data.message == "ok") {
                        $("#uploadAttendFileMessage").html("<span class='text-success'>Ready to upload into database now!!</span>")
                        $("#form-attend-upload").trigger('reset');
                        $("#uloadIntoDatabaseArea").show(100);

                        var i = 1;
                        // alert(data)
                        var datas = data.attend_error_info;
                        if(data.attend_error_info==null){
                           $("#Uploaded_attend_data").hide()
                        } else {
                        $("#Uploaded_attend_data").show(100);
                       // alert(datas.attend_error_info['attend_error_info']);
                       var html="";
                        datas.forEach(function(value, index) {
                              html += '<tr>';
                            html += "<td>" + i++ + "</td>";
                            html += "<td>" + value.eid + "</td>";
                            html += "<td>" + value.punchdata + "</td>";
                            html += "<td>NA</td>";
                            html += '</tr>';
                        });
                        $("#Error-report-table").html(html);
                        }
                    } else {

                        $("#uploadAttendFileMessage").html("<?php echo $this->session->flashdata('uploadError') ?>");
                        $("#uloadIntoDatabaseArea").hide(100);
                        //                          loadTableData()
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#uploadAttendFileMessage").html("<?php echo $this->session->flashdata('uploadError') ?>");
                    $("#uloadIntoDatabaseArea").hide(100);
                }
            });
        })


        $("#uloadIntoDatabase").click(function(e) {
            e.preventDefault();
            $("#Uploaded_attend_data").hide(100)
            $("#uploadAttendFileMessage").html("<img width='40px' src='<?php echo site_url(); ?>assets/upload/attendence/loading.gif'>")
            $.ajax({
                url: "<?php echo site_url('Attend_upload/Uploaddb') ?>/",
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data = "ok") {
                        $("#uploadAttendFileMessage").html("Database updated successfully.");
                        // ShowActionMessage('Record inserted successfully!!!')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    ShowActionMessage('Record uploading failed ', false)
                    loadTableData()
                }
            });

        })


    })
</script>