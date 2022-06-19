<!-- 
######################################################################################################

Developed by          : Muhammad Anwar Hossen, WPSI, R-26, IDB-BISEW
View Name             : Employee_view (Profile in real view)
Mobile No             : ++01923-020000
Email Address         : anwardote@gmail.com

#######################################################################################################

-->

<div class="col-md-5">
    <div style="width: 200px">
        <?php
        $empimage = "assets/upload/emp_photo/" . $this->session->userdata('emp_selected_card_no') . ".jpg";

        if (is_file($empimage)) {
            $userphoto = site_url() . "assets/upload/emp_photo/" . $this->session->userdata('emp_selected_card_no') . ".jpg";
            ;
        } else {
            $userphoto = site_url() . "assets/upload/emp_photo/default.png";
        }
        ?>
		<?php
		$randomnum=rand(200,500);
		?>
        <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $userphoto."?".$randomnum; ?>">
    </div>
</div> 

<div class="col-md-7"> 
    <div class="row">
        <?php echo form_open_multipart('employee/do_upload'); ?>
        <div class="form-group">
            <div class="col-md-12">   
                <label class="control-label">Upload an Employee's Photograph</label>
            </div>

            <div class="col-md-12">
                <input type="file" class="btn btn-default" name="ProfileImage"/>
                <span class="help-block"></span>
                <input class="btn btn-default btn-info" type="submit" name="submit" value="Upload"/>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div> 




<div class="formcontainer"  >
    <form action="#" id="update_emp_form" class="form-horizontal">
        <input type="hidden" value="" name="empidentityid"/> 
        <div class="form-body">


            <div class="pull-right" style="padding-right:20px;">
                <button type="button" style="display:none" onclick="employee_save_btn()" class="btn btn-primary submitbtnwidth btnSave">Update</button>
                <button type="button" style="display:block"  class="btn btn-success submitbtnwidth empbtnedit" >Edit</button>
            </div>  

            <!-- Basic Info START -->                        

            <div class="row">
                <legend>Basic Information</legend> 
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">Card No.</label>
                <div class="col-md-9">
                    <div class="col-md-12">


                        <!--div class="input-group">
                            <input name="empid" id="empid" placeholder="Employee Card No here." class="form-control empid_input_text" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-default empid_input_btn" type="button">
                                    Edit!
                                </button>
                            </span>
                            <span class="help-block"></span>            
                        </div><!-- /input-group -->
                        <input name="empid" id="empid" placeholder="Employee Card No here." class="form-control" type="text">
                        <span class="help-block"></span>            
                        
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3">Department</label>
                <div class="col-md-9">
                    <div class="col-md-12">

                        <select name="deptid" id="depttoloadsec2" class="form-control deptmentid">

                            <option value=" " >Select one</option>
                            <?php
                            foreach ($dept as $r) {
                                echo $dept_code = $r->deptid;
                                echo $dept_name = $r->deptname;
                                ?>
                                <option value="<?php echo $dept_code; ?>" <?php echo set_select('gen_deptid', $dept_code); ?>>
                                    <?php echo $dept_name ?></option>
                            <?php } ?>


                        </select>                                
                        <span class="help-block"></span>

                    </div>
                </div>
            </div>                              


            <div class="form-group">
                <label class="control-label col-md-3">Section</label>
                <div class="col-md-9">
                    <div class="col-md-12">

                        <select name="secid" class="form-control sectionid">

                        </select>

                        <span class="help-block"></span>

                    </div>
                </div>  
            </div>  


            <div class="form-group">
                <label class="control-label col-md-3">Designation</label>
                <div class="col-md-9">
                    <div class="col-md-12">

                        <select name="desigid" class="form-control designationid">

                            <option value=" " >Select one</option>
                            <?php
                            foreach ($desig as $r) {
                                echo $desig_code = $r->desigid;
                                echo $desig_name = $r->designame;
                                ?>
                                <option value="<?php echo $desig_code; ?>" <?php echo set_select('gen_desigid', $desig_code); ?>>
                                    <?php echo $desig_name ?></option>
                            <?php } ?>  

                        </select>

                        <span class="help-block"></span>

                    </div>
                </div>  
            </div>                             


            <legend>Employee Information</legend>
            <div class="form-group">
                <div class="col-md-12 ">

                    <label class="control-label col-md-3">Full Name</label>


                    <div class="col-md-3">
                        <input name="fname" placeholder="First Name." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <input name="mname" placeholder="Middle Name." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-md-3">                                

                        <input name="lname" placeholder="Last Name." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>


                </div>  
            </div> 						


            <div class="form-group form-inline">

                <label class="control-label col-md-3">Gender</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <label class="radio-inline">
                            <input name="gender" id="genmale" value="male" checked="checked" type="radio">Male</label>
                        <label class="radio-inline">
                            <input name="gender" id="genfemale" value="female" type="radio">Female</label>
                        <label class="radio-inline">
                            <input name="gender" id="genother" value="other" type="radio">Other</label>
                        <span class="help-block"></span> 
                    </div>

                </div>
            </div>                         


            <div class="form-group">
                <label class="control-label col-md-3">Date of Birth</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="dob" placeholder="Date of Birth here." class="form-control" type="date">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div> 


            <div class="form-group form-inline">
                <label class="control-label col-md-3">Marital Status</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <label class="radio-inline">
                            <input name="maritalstatus" id="msmarried" value="married" type="radio" checked="checked">Married</label>
                        <label class="radio-inline">
                            <input name="maritalstatus" id="msunmarried" value="unmarried" type="radio">Unmarried</label>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                         


            <div class="form-group">
                <label class="control-label col-md-3">Personal Phone</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="phone" placeholder="Personal Phone/Mobile No. here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div> 


            <div class="form-group">
                <label class="control-label col-md-3">Home Phone</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="homephone" placeholder="Home Phone/Mobile No. here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                         


            <div class="form-group">
                <label class="control-label col-md-3">Email Address</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="email" placeholder="Ex- example@gmai.com" class="form-control" type="email">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>   


            <div class="form-group">
                <label class="control-label col-md-3">Blood Group</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <select name="blood" class="form-control">
                            <option>Select one</option>
                            <option>NA</option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>AB-</option>
                            <option>AB-</option>
                            <option>O+</option>
                            <option>O-</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                          


            <div class="form-group">
                <label class="control-label col-md-3">TIN No</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="tin" placeholder="TIN No. here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3">National ID</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="nid" placeholder="National Identify No. here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div> 


            <div class="form-group">
                <label class="control-label col-md-3">Father's Name</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="fathersname" placeholder="Employee Father's Name here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div> 


            <div class="form-group">
                <label class="control-label col-md-3">Mother's Name</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="mothersname" placeholder="Employee Mother's Name here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div> 
            <!-- Driving Info START -->                        
            <legend>Driving Information</legend>
            <div class="form-group">


                <label class="control-label col-md-3">License No.</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="dln" placeholder="Driving License No here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                        


            <div class="form-group">
                <label class="control-label col-md-3">Expiration Date.</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="dl_expdate" placeholder="License Expiration Date" class="form-control" type="date">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                         


            <!-- Bank Info START --> 
            <legend>Bank Information</legend>                        
            <div class="form-group">
                <label class="control-label col-md-3">Bank Name</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="bankname" placeholder="Bank Account Name here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>  


            <div class="form-group">
                <label class="control-label col-md-3">Account No</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <input name="bankaccno" placeholder="Bank Account No. here." class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>  


            <div class="form-group">
                <label class="control-label col-md-3">Account Type</label>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <select name="bankacctype" class="form-control">
                            <option value="current">current</option>
                            <option value="savings">savings</option>
                            <option value="salary">salary</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>                           

        </div> <!-- form-body END -->

        <div class="pull-right" style="padding-right:20px;">
            <button type="button" style="display:none" onclick="employee_save_btn()" class="btn btn-primary submitbtnwidth btnSave">Update</button>
            <button type="button" style="display:block"  class="btn btn-success submitbtnwidth empbtnedit" >Edit</button>
        </div>  
    </form>
</div>


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
            edit_employee('<?php echo $default_emp ?>');

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
                edit_employee('<?php echo $default_emp ?>');

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
        $(".empid_input_text").attr('disabled', 'disabled');

        $(".btnSave").show();
        edit_employee('<?php echo $default_emp ?>');
    });
$(".empid_input_btn").click(function(){
    $(".empid_input_text").removeAttr('disabled');
    $(".empid_input_btn").attr('disabled', 'disabled');
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
                    
                     $(".empid_input_btn").removeAttr('disabled');
                    //reload_table();



// Set New Session of we update new card no.
                    var eid = $("#empid").val();
                    var url = "<?php echo site_url('employee/set_session_val_of_new_updated_empid') ?>/" + eid;
                    $.ajax({url, success: function(data) {
                            //alert(data);
                        $(".empid_input_btn").removeAttr('disabled');
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


//Desig Loading 

            desig = data.desig;
            desightml = "<option value=''> Select one </option>";
            desig.forEach(function(value, index) {
                desightml += "<option value='" + value.desigid + "'>" + value.designame + "</option>";
            });
            $(".designationid").html(desightml);
        });
    }



</script>
</body>
</html>