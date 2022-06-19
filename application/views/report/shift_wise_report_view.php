<?php $this->load->view('header', array('title' => 'Shift Wise Report')); ?>
<?php $this->load->view('leftnav', array('active' => 'Shift_wise_report')); ?>
<style>
    #ShiftWiseReportTable tr td{
        font-size: 0.9em;

    }

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Shift Wise Report
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Shift Wise Report</a></li>

        </ol>
    </section>
    <!--add/edit form start-->
    <div class='col-md-12'>
        <div style="border:0px double gray; padding:5px; border-radius: 2px; background-color: #F5FFFA; margin-bottom: 10px">
            <form action="#" id="ShiftWiseReportform" class="form-horizontal" style="margin: 10px;">
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-4">Select Shift</label>
                            <div class="col-md-8">
                                <div class="col-md-9">
                                    <select name="shiftinfo" id='SelectShiftInfo' class="form-control empgrade">
                                        <option value="0">Select One</option>
                                        <option value="0">All Shift</option>
                                        <?php
                                        foreach ($shift as $s) {
                                            $shiftid = $s->id;
                                            $shiftname = $s->shiftname;
                                            ?>

                                            <option value="<?php echo $shiftid; ?>"><?php echo ucfirst($shiftname); ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                            </div>

                        <div class="row col-md-6">

                            <div class="form-group">
                                <label class="control-label col-md-4">Select Status</label>
                                <div class="col-md-8">
                                    <div class="col-md-9">
                                        <select name="emp_status" id='SelectEmpStatus' class="form-control empgrade">
                                            <?php
                                            foreach ($emp_status as $s) {
                                                ?>

                                                <option value="<?php echo $s; ?>"><?php echo ucfirst($s); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  


                            </div>
                        </div>
                    </div>   

                </div>

            </form>
        </div>
        <div class="col-md-12" style="background-color:#FFFFFF">

            <section class="content">

                <div class="formcontainer">

                    <div>
                        <div id="ShiftWiseReportTable">

                        </div>  

                    </div>
                </div>
                <!--close form-->





            </section>
        </div>

    </div>
</div>

<div class='clearfix'></div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>     
<script type="text/javascript">
    $("#SelectShiftInfo").on("change", function(e) {
        e.preventDefault();
        LoadShiftInfo()

    })

    $("#SelectEmpStatus").on("change", function(e) {
        e.preventDefault();
        LoadShiftInfo()

    })

    function LoadShiftInfo() {

        // var shiftinfo = $('[name="shiftinfo"]').val();
        // var emp_status = $('[name="shiftinfo"]').val();
        var data = $("#ShiftWiseReportform").serialize();


        $.ajax({
            url: "<?php echo site_url('Report_Shift_wise/LoadShiftInfo/') ?>/",
            data: data,
            success: function(data)
            {
                data = JSON.parse(data);
                var empinfo = data.shiftinfo;
                if (empinfo != "NoData") {
                    var html = '<table class="table sar-table table-striped">';
                    html += '<tr><th>#</th><th>Card</th><th>Name</th><th>Department</th><th>Section</th><th>Designation</th><th>Join Date</th><th>Basic Salary</th><th>Status</th></tr>';
                    var i = 1;
                    empinfo.forEach(function(value, index) {
                        html += '<tr>';
                        html += "<td>" + i++ + "</td>";
                        html += "<td>" + value.empid + "</td>";
                        html += "<td>" + value.fname + " " + value.mname + " " + value.lname + "</td>";
                        html += "<td>" + value.deptname + "</td>";
                        html += "<td>" + value.secname + "</td>";
                        html += "<td>" + value.designame + "</td>";
                        html += "<td>" + value.startdate + "</td>";
                        html += "<td style='text-align:right'>" + value.basic_salary + "</td>";
                        html += "<td>" + value.status + "</td>";
                        html += '</tr>';
                    });
                    html += '</table>';
                    $(".sidebar-mini").addClass("sidebar-collapse");
                    $("#ShiftWiseReportTable").html(html);
                } else {
                    html += '<tr>';
                    html += "<td>No employee details found</td>";
                    html += '</tr>';

                    $("#ShiftWiseReportTable").html(html);
                    $(".sidebar-mini").removeClass("sidebar-collapse");

                }

            }
        });

    }
</script>

</body>
</html>