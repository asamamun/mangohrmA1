<?php
$default_emp_card = $this->session->userdata('emp_selected_card_no');
$default_emp_id = $this->session->userdata('emp_selected_id_no');
if (empty($default_emp_card)) {
    redirect(site_url());
}
?>


<?php $this->load->view('header', array('title' => 'Employee')); ?>
<?php $this->load->view('leftnav', array('active' => 'Employee')); ?>
<?php $this->load->view('footer'); ?>



<div class="content-wrapper">


    <!-- /.content -->
    <section class="content-header" style="margin: 0">
        <h3 style="padding:10px; height:45px; font-size: 18px; color:gray; margin: 0" class='headtitlebackgroudgradient'>
            Employee Management 
            <small class="pull-right" style="padding: 7px">Admin Panel</small>
        </h3>
    </section>
    <div class="col-md-12">
        <div class="col-md-12" style="background-color:#FFFFFF">
            <section class="content">

                
<!-- START TAB Display Name -->                  
                
<ul class="nav nav-tabs text-bold text-capitalize hover bg-info" style="font-size: 16px">
                    <li class="active"><a data-toggle="tab" href="#emp_profile">Profile</a></li>
                    <li><a data-toggle="tab" href="#emp_addresss">Address</a></li>
                    <li><a data-toggle="tab" href="#emjob">Job</a></li>
                    <li><a data-toggle="tab" href="#employee_experience">Experience</a></li>
                    <li><a data-toggle="tab" href="#emp_education">Education</a></li>
                    <li><a data-toggle="tab" href="#emp_leave_status_pvt">Leave</a></li>
					<li><a data-toggle="tab" href="#emp_attachment_nav">Attachment</a></li>
                </ul>
<!-- END TAB Display Name --> 

                
<!-- START For Displying Employee name and cardname in each tab -->                
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tr> <th colspan="3">Employee Details</th></tr>
                                <tr>
                                    <td width='200px'>Employee's Name</td>
                                    <td><?php echo $empname[0]['fname'] . " " . $empname[0]['mname'] . " " . $empname[0]['lname']; ?>
                                    </td>
                                </tr>
                                <tr><td>Employee's Card No</td>
                                    <td><?php echo $this->session->userdata('emp_selected_card_no'); ?></td>
                                </tr>
                            </table>
                        </div> 
                        <hr>
                    </div>
                </div>

<!-- END For Displying Employee name and cardname in each tab -->  
                
                
                
<!-- START TAB Anchor -->                 
                <div class="tab-content">
                    <div id="emp_profile" class="tab-pane fade in active">
                        <?php $this->load->view('employee/employee_view'); ?> 
                    </div>

                    <div id="emp_addresss" class="tab-pane fade">
                        <?php $this->load->view('employee/emp_address_view'); ?>
                    </div>

                    <div id="emjob" class="tab-pane fade">
                        <?php $this->load->view('employee/emp_job_view'); ?>
                    </div>

                    <div id="employee_experience" class="tab-pane fade">
                        <?php $this->load->view('employee/empexperience_view'); ?> 
                    </div>
					
                    <div id="emp_education" class="tab-pane fade">
						<?php  $this->load->view('employee/empeducation_view'); ?> 
                    </div>
                    <div id="emp_leave_status_pvt" class="tab-pane fade">
                        <?php $this->load->view('employee/emp_leave_status_view'); ?> 
                    </div>	
                    <div id="emp_attachment_nav" class="tab-pane fade">
                        <?php $this->load->view('employee/emp_attach_view'); ?> 
                    </div>						

                </div>

<!-- END TAB Anchor -->










                <br><br><hr>

            </section>
        </div>
    </div>
    <div class="clearfix"></div>

</div><!-- ./wrapper -->
<?php $this->load->view('footerinfo'); ?>


<script type="text/javascript">

    var save_method; //for save method string
    var table;
    emp_default_load();
    $(document).ready(function() {

//set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });


// Function Loading employee data
        function edit_employee(id)
        {
            save_method = 'update';
            $('#update_emp_form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('employee/employee_ajax_edit/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="empidentityid"]').val(data.id);
                    $('[name="empid"]').val(data.empid);
                    $('[name="fname"]').val(data.fname);
                    $('[name="mname"]').val(data.mname);
                    $('[name="lname"]').val(data.lname);
                    $('[name="dln"]').val(data.dln);
                    $('[name="dob"]').val(data.dob);
                    $('[name="dl_expdate"]').val(data.dl_expdate);

                    if (data.gender === 'male') {
                        // $('input[name="gender"]').rmoveAttr('checked');
                        $("#genfemale").removeAttr('checked');
                        $("#genother").removeAttr('checked');
                        $("#genmale").attr('checked', 'checked');
                    } else if (data.gender === 'female') {
                        //  $('input[name="gender"]').removeAttr('checked');
                        $("#genmale").removeAttr('checked');
                        $("#genother").removeAttr('checked');
                        $("#genfemale").attr('checked', 'checked');
                    } else {
                        //  $('input[name="gender"]').removeAttr('checked');
                        $("#genfemale").removeAttr('checked');
                        $("#genmale").removeAttr('checked');
                        $("#genother").attr('checked', 'checked');
                    }

                    // Gender Checked END

                    //Marital Status Start
                    if (data.maritalstatus === 'married') {
                        $("#msunmarried").removeAttr('checked');
                        $("#msmarried").attr('checked', 'checked');
                    } else {
                        $("#msmarried").removeAttr('checked');
                        $("#msunmarried").attr('checked', 'checked');
                    }
                    //Marital Status END

                    $('[name="phone"]').val(data.phone);
                    $('[name="homephone"]').val(data.homephone);
                    $('[name="email"]').val(data.email);
                    $('[name="blood"]').val(data.blood);
                    $('[name="tin"]').val(data.tin);
                    $('[name="nid"]').val(data.nid);
                    $('[name="fathersname"]').val(data.fathersname);
                    $('[name="mothersname"]').val(data.mothersname);
                    $('[name="bankname"]').val(data.bankname);
                    $('[name="bankaccno"]').val(data.bankaccno);
                    $('[name="bankacctype"]').val(data.bankacctype);
                    $('[name="createdate"]').val(data.createdate);
                    $('[name="deptid"]').val(data.deptid);
                    $('[name="secid"]').val(data.secid);
                    $('[name="desigid"]').val(data.desigid);

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    ShowActionMessage("Error get data from server", false, "Error Message");

                }
            });
        }





//Load Section value on change Department 
        $("#depttoloadsec2").change(function(e) {
            var id = $("#depttoloadsec2").val();

            $.ajax({
                url: "<?php echo site_url('employee/get_section_by_dept_id') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    sec = data
                    sechtml = "<option value=''> Select one </option>";
                    sec.forEach(function(value, index) {
                        sechtml += "<option value='" + value.secid + "'>" + value.secname + "</option>";
                    });
                    $(".sectionid").html(sechtml)
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    ShowActionMessage("Error get data from server", false, "Error Message");
                }
            });

        });


// CAlling (edit_employee)  function for loading emplyee data as session empid after
// Will be call when load
<?php
$default_emp = $this->session->userdata('emp_selected_card_no');
if ($default_emp) {
    ?>
            edit_employee('<?php echo $default_emp ?>')

    <?php
}
?>

// Will be call after certain time
        var startTime = new Date().getTime();
        var interval = setInterval(function() {
            if (new Date().getTime() - startTime > 200) {
                clearInterval(interval);
                return;
            }

<?php
$default_emp = $this->session->userdata('emp_selected_card_no');
if ($default_emp) {
    ?>
                edit_employee('<?php echo $default_emp ?>')

    <?php
}
?>
            //do whatever here..
        }, 100);


    });


// Control of Update and Edit btn
    $("#update_emp_form input,select").attr('disabled', 'disabled');

    $(".empbtnedit").click(function(e) {
        $(".empbtnedit").hide();
        $("#update_emp_form input,select").removeAttr('disabled');
        // $("input[name='empid'],select[name='deptid'],select[name='secid'],select[name='desigid']").attr('disabled', 'disabled');

        $(".btnSave").show();
        edit_employee('<?php echo $default_emp ?>');
    });


// The function will be call when user click on EDIT BUTTON
    function employee_save_btn()
    {
        var url;
        url = "<?php echo site_url('employee/employee_ajax_update') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#update_emp_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data.status) //if success close modal and reload ajax table
                {
                    $("#update_emp_form input,select").attr('disabled', 'disabled');
                    $(".btnSave").hide();
                    $(".empbtnedit").show();
                    //reload_table();



// Set New Session of we update new card no.
                    var eid = $("#empid").val();
                    var url = "<?php echo site_url('employee/set_session_val_of_new_updated_empid') ?>/" + eid;
                    $.ajax({url, success: function(data) {
                            //alert(data);
                        }});
// END session                    



                    ShowActionMessage("The Employee data is updated successfully!", true, "Success Message");
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('.btnSave').text('save'); //change button text
                $('.btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                ShowActionMessage("Error in updating from the server", false, "Error Message");
                // alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

// Function of Loading default value like dropdown value
    function emp_default_load() {
        var urls = "<?php echo site_url('employee/emp_default_loading') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);

//Department Loading
            dept = data.dept;
            depthtml = "<option value=''> Select one </option>";
            dept.forEach(function(value, index) {
                depthtml += "<option value='" + value.deptid + "'>" + value.deptname + "</option>";
            });
            $(".deptmentid").html(depthtml);

//Section Loading 

            sec = data.sec;
            sechtml = "<option value=''> Select one </option>";
            sec.forEach(function(value, index) {
                sechtml += "<option value='" + value.secid + "'>" + value.secname + "</option>";
            });
            $(".sectionid").html(sechtml);
        });
    }



</script>




</body>
</html>

