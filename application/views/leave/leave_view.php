<?php $this->load->view('header', array('title' => 'Leave Manage')); ?>
<?php $this->load->view('leftnav', array('active' => 'Leave_manage')); ?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'> 
                Leave Management
                <small>Admin Panel</small>
                
            </h1><br>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Leave</a></li>
            </ol>
        </section>
            <div class="clearfix"> </div><br>
        <section class="col-md-8" >

            <div class="row" id="frm_checkleaveid" style=" padding: 15px; box-shadow: 10px 10px 5px 5px grey; border-radius: 20px; margin-left: 15%">
                <div class="col-sm-12">
                    <div class="clearfix"> </div><br><br>
                    <span class="h3">Enter A Valid ID</span><br><br><br>
                    <form action="" method="post" name="checkleaveid" id="checkleaveid" class="form-horizontal">

                        <div class="form-group row">
                            <label class="control-label col-md-4"> Employee ID :</label>
                            <div class="col-md-8">
                                <input type="text" name="employee_id" id="employee_id" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        
                        
                        <a href="javascript:void()" class="btn btn-success" onclick="get_emp_detail_for_leave()" style="margin-left: 130px"><i class="glyphicon glyphicon-user">Submit</i> </a>
                    </form>
                </div>
            </div>


        </section>

        <div class="clearfix"> </div><br><br><br>

        <section>
           
                <!--add/edit form start-->
                <div style="display: none" id="secondformofleaveform" class="formcontainer row">
                    <div  id="frm_show_details" >
                        <div class="col-md-4" style="height:180px;box-shadow: 10px 5px 5px grey; border-radius:10px;margin-left: 15%; background-color: #e7f7f7;">
                            <h3>Name of Employee: <span id="empnameofleve"></span></h3>
                            <h4>Department : <span id="empdeptofleave"></span></h4>
                            <h4>Section : <span id="empsectionofleave"></span></h4>
                            <h4>Designation : <span id="empdesigofleave"></span></h4>
                        </div>
                    </div>
                    <div class="clearfix"><br><br> </div><br><br>
                    <form id="leave_form" method="post" name="leave_form" class="form-horizontal">

                        <div class="form-body">

                            <input type="hidden" name="emprealid" value=""/>
                            <input type="hidden" name="emp_leaveid" value=""/>

                            <div class="form-group">
                                <label class="control-label col-md-2">Leave Type:</label>
                                <div class="col-md-5">

                                    <select name="leavetype" id="leavetype" class="form-control">
                                        <option value="">Select One</option>
                                        <?php foreach ($leavetype as $row) { ?> 
                                            <option value='<?php echo $row["id"]; ?>'><?php echo $row["leavetype"]; ?> </option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="clearfix"> </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Start Date:</label>
                                <div class="col-md-5">
                                    <input type="date" name="stdate" id="stdate" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">End Date:</label>
                                <div class="col-md-5">
                                    <input type="date" name="endate" id="endate" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Approved by:</label>
                                <div class="col-md-5">
                                    <input class="form-control" onkeyup="get_approver_info()" name="approvedby" id="approvedby" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <h3 id="empnameofapprover"></h3>
                            </div>
                            <div class="clearfix"> </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Approved:</label>
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input name="approved" id="aprvlv_yes" value="1" type="radio" checked="checked">Yes</label>
                                        <label class="radio-inline">
                                            <input name="approved" id="aprvlv_no" value="0" type="radio">No</label>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Comments:</label>
                                <div class="col-md-5">
                                    <textarea name="comments" id="comments" class="form-control" rows="5"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="clearfix"> </div>

                        </div>
                       
                            
                            <input type="button" style="margin-left: 40%" value="Submit" onclick="post_emp_leave_values()" class="btn btn-success" id="add" name="add" >
                         
                            <input type="button" style="" value="Update" onclick="update_leave_values()" class="btn btn-primary " id="update" name="update" >
                        

                    </form>

                </div>
          
        </section>
        <div class="clearfix"><br></div><br><br>



        <div class="col-md-12 ">

            <table class="table table-bordered " id="tableInformation">
                <thead>
                    <tr>

                        <th>Leave Type</th>
                        <th>Description</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Days</th>
                        <th>Comments</th>                    
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody id="leave_table_data">

                </tbody>
            </table> 


        </div>

        <div class="clearfix"></div><br>

    </div><!-- content-wrapper -->
 

  
<?php $this->load->view('footer'); ?>  

<script>

    $(document).ready(function (e) {



        LoadDefaultLaveTable();



    });
    /* Table  LoadDefaultLaveTable in the leave view */
    function LoadDefaultLaveTable() {

        var urls = "<?php echo site_url('leave/LoadDefaultLaveTable'); ?>";
        $.ajax({
            url: urls,
            type: "POST",
            // dataType: "JSON",
            success: function (data) {
                data = JSON.parse(data);
                // ShowActionMessage('Inserted');
                //alert(data.emp_leave.id);
                var emp_leave = data.emp_leave;
                //alert(emp_leave);
                var html = "";
                emp_leave.forEach(function (item) {
                    html += '<tr>';
                    html += '<td>' + item.leavetype + '</td>';
                    html += '<td>' + item.desc + '</td>';
                    html += '<td>' + item.leave_from + '</td>';
                    html += '<td>' + item.leave_to + '</td>';
                    html += '<td>' + item.leave_days + '</td>';
                    html += '<td>' + item.comments + '</td>';
                    html += '<td>'
                    + '<a href="javascript:void()" class="btn btn-success" id="edit_leave" name="edit_leave" onclick="edit_leave_info(' + item.id + ')"> \n\
                    <span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:void()" class="btn btn-danger" id="delete_leave" name="delete_leave" onclick="delete_leave_info(' + item.id + ')">\n\
                    <span class="glyphicon glyphicon-trash"></span></a>'
                            + '</td>';

                    html += '</tr>';
                    //  alert(item.leave_from);
                })
                $("#leave_table_data").html(html);
                //$("#tableInformation").DataTable();
                //$("#leave_table_data").DataTable(html);

            }


        });

    }




    /* ADD Employee Leave*/
    function post_emp_leave_values()
    {

        // alert('Helllo');
        var url;

        url = "<?php echo site_url('leave/add_leave'); ?>";

        tdata = $("#leave_form").serialize();
        //alert(tdata);
        //alert(tdata);
        $.ajax({
            url: url,
            type: "POST",
            data: tdata,
            dataType: "JSON",
            success: function (data) {
                // ShowActionMessage('Inserted');
                // alert("record is inserted");
                if (data) {
                    alert("Data Inserted");
                    LoadDefaultLaveTable();

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Data submission failed');
            }


        });
    }

    /*Edit Employee Leave information */
    function edit_leave_info(id)
    {
        //alert(id);

        $.ajax({
            url: "<?php echo site_url('leave/leave_edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                if (data) {
                    //alert(data.leave_from);
                    $("#update").removeClass('hidden');
                    $("#add").addClass('hidden')
                    $("#frm_checkleaveid").find('input, textarea, button, select').attr('disabled', 'disabled');
                    $("#frm_show_details").addClass('hidden');
                    $("#secondformofleaveform").removeAttr('style');

                    $('[name="emp_leaveid"]').val(data.leave_id);
                    $('[name="emprealid"]').val(data.eid);
                    $('[name="leavetype"]').val(data.leave_id);
                    $('[name="stdate"]').val(data.leave_from);
                    $('[name="endate"]').val(data.leave_to);
                    $('[name="approvedby"]').val(data.approved_by);
                    $('[name="approved"]').val(data.approved);
                    $('[name="comments"]').val(data.comments);
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    /* -- Update values for Leave management--*/
    function update_leave_values()
    {
        // alert('Helllo');
        var url;

        url = "<?php echo site_url('leave/update_leave'); ?>";

        form_data = $("#leave_form").serialize();
        alert(form_data);

        $.ajax({
            url: url,
            type: "POST",
            data: form_data,
            dataType: "JSON",
            success: function (data) {
                //alert('Helllo');
                if (data) {
                    alert('Data Updated successfull');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Data submission failed');
            }

        });
    }
    /* -- Delete values for Leave management--*/
    function delete_leave_info(id)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // alert(id);
            //var id = id;
            $.ajax({
                url: "<?php echo site_url('leave/delete_leave') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    LoadDefaultLaveTable()
                    alert('deleted succesfuuly')

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }

    }




    /* Employee ID check for input */
    function get_emp_detail_for_leave()
    {
        var employeeid = $('#employee_id').val();
        if (employeeid == '') {
            alert('Should not empty This Feild');
            return;
        }

        $.ajax({
            url: "<?php echo site_url('leave/empid_check') ?>/" + employeeid,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //  alert(data.secname);
                $("#update").addClass('hidden');
                $("#secondformofleaveform").removeAttr('style');
                $('[name="emprealid"]').val(data.id);
                var fullname = data.fname + " " + data.mname + " " + data.lname;
                $('#empnameofleve').html(fullname);
                $('#empdeptofleave').html(data.deptname);
                $('#empsectionofleave').html(data.secname);
                $('#empdesigofleave').html(data.designame);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $("#secondformofleaveform").css('display', 'none');
                alert('Please submit Valid Data !!!');
            }
        });
    }


    /* Approved  Employee Id the show In a DIV */
    function get_approver_info()
    {
//alert('hello')
        var employeeid = $('#approvedby').val();
        $.ajax({
            url: "<?php echo site_url('leave/approver_check') ?>/" + employeeid,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                var fullname = data.fname + " " + data.mname + " " + data.lname;
                $('#empnameofapprover').html(fullname);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#empnameofapprover').html("No match found!!")
            }
        });
    }







</script>


