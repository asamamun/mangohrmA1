<!-- 
######################################################################################################

# Developed by          : Muhammad Anwar Hossen, WPSI, R-26, IDB-BISEW
# View Name             : view/employee/Emp_leave_status_view.php
# Short Description		: Per Employee leave Status.
# Mobile No             : ++01923-020000
# Email Address         : anwardote@gmail.com

#######################################################################################################

-->



<?php
//$this->output->clear_all_cache();
?>
<div class="Formcontainer" >

    <div class="box-header">
        <h3 class="box-title">Leave Summary</h3>  


    </div><!-- /.box-header -->


    <div class="box-body no-padding" id="emp_leave_status_5464fd">
        <p class="tab blink" style="padding-left: 12px">No leave Summary history found!!</p>
    </div><!-- /.box-body -->



    <div class="box-header">
        <hr>
        <h3 class="box-title" >Leave Details</h3>  


    </div><!-- /.box-header -->


    <div class="box-body no-padding" id="empl_leave_status_details_pvt">
        <p class="tab blink" style="padding-left: 12px">No leave details history found!!</p>
    </div><!-- /.box-body -->

</div><!-- /Formcontainer -->

<script type="text/javascript">

    emp_load_leave_status();
    // Function of Loading default value like dropdown value
    function emp_load_leave_status() {
        var urls = "<?php echo site_url('emp_leave_status/show_leave_status') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);
            //  alert(data);



            var datas = data.leave_status_pvt;
            if (datas != "") {
                var html = '<table class="table sar-table table-striped">'
                html += '<tr><th style = "width: 10px">#</th><th>Leave Type</th><th>Leave Enjoy</th><th>Leave Balance</th><th width="150px">Status</th><th>(%)</th></tr>';
                var i = 1;
                // alert(data)
                datas.forEach(function(value, index) {
                    html += '<tr>';
                    html += "<td>" + i++ + "</td>";
                    html += "<td>" + value.leavetype + "</td>";
                    var totalenjoyleavedayspvt = value.leave_days;
                    var totalbalanceleavedayspvt = 20 - totalenjoyleavedayspvt;
                    var prgressbarvalpvt = totalbalanceleavedayspvt / 20 * 100;
                    html += "<td>" + totalenjoyleavedayspvt + "</td>";
                    html += "<td>" + totalbalanceleavedayspvt + "</td>";

                    html += '<td><div class="progress progress-xs progress-striped active"><div class="progress-bar progress-bar-success"  style="width:' + prgressbarvalpvt + '%"></div></div></td>';
                    html += "<td><span class='badge bg-green'>" + prgressbarvalpvt + "%</span></td>";
                    html += '</tr>';
                });
                html += '</table>';

                $("#emp_leave_status_5464fd").html(html);



                var datass = data.leave_status_details_pvt;

                var htmls = '<table class="table sar-table table-striped">'
                htmls += '<tr><th style = "width: 10px" rowspan="2">#</th><th colspan="2">Leave Enjoy</th><th rowspan="2">Days</th><th rowspan="2">Leave Type</th><th rowspan="2">Approved By</th></tr>';
                htmls += '<tr><th>From</th><th>To</th></tr>'
                var i = 1;
                // alert(datass); 
                datass.forEach(function(value, index) {
                    htmls += '<tr>';
                    htmls += "<td>" + i++ + "</td>";
                    htmls += "<td>" + value.leave_from + "</td>";
                    htmls += "<td>" + value.leave_to + "</td>";
                    htmls += "<td>" + value.leave_days + "</td>";
                    htmls += "<td>" + value.leavetype + "</td>";
                    htmls += '<td>' + value.fname + " " + value.mname + " " + value.lname + " <br>(" + value.empid + ")</td>";
                    htmls += '</tr>';
                });
                htmls += '</table>';

                $("#empl_leave_status_details_pvt").html(htmls);
            } // If Condtion END
        });
    }

</script>
</body>
</html>