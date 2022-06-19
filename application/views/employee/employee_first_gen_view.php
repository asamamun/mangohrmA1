<!-- 
######################################################################################################

Developed by          : Muhammad Anwar Hossen, WPSI, R-26, IDB-BISEW
View Name             : Employee_first_gen_view (Add Employee)
Mobile No             : ++01923-020000
Email Address         : anwardote@gmail.com

#######################################################################################################

-->

<?php $this->load->view('header', array('title' => 'Employee')); ?>
<?php $this->load->view('leftnav', array('active' => 'Employee_gen_first')); ?>


<div class="content-wrapper">

    <!-- /.content -->
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Employee 
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Add New Employee</a></li>

        </ol>
    </section>
    <div class='col-md-12'>
        <div class="col-md-12" style="background-color:#FFFFFF">
            <section class="content">


                <div class="formcontainer"  >
                    <form action="#" id="emp_first_gen_form" class="form-horizontal">
                        <div class="form-body">

                            <!-- Basic Info START -->                        
                            <legend>Basic Information</legend>

                            <div class="form-group">
                                <label class="control-label col-md-3">Card No.</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="gen_empid" placeholder="Employee Card No here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 ">

                                    <label class="control-label col-md-3">Full Name</label>
                                    <div class="col-md-3">
                                        <input name="gen_fname" placeholder="First Name." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input name="gen_mname" placeholder="Middle Name." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-md-3">                                

                                        <input name="gen_lname" placeholder="Last Name." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>  
                            </div> 



                            <div class="form-group">
                                <label class="control-label col-md-3">Department</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="gen_deptid" id="depttoloadsec" class="form-control deptmentid">

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
                                        <select name="gen_secid"  class="form-control sectionid">
                                            <option value=" " >Select one</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>  


                            <div class="form-group">
                                <label class="control-label col-md-3">Designation</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="gen_desigid" class="form-control designationid">

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


                        </div> <!-- form-body END -->


                        <div class="pull-right" style="padding-right:20px;"> 

                            <button type="button"  onclick="employee_gen_save_btn()" class="btn btn-info submitbtnwidth">Submit</button>

                        </div>                         
                    </form>
                    <br><br><hr>
                </div>            
            </section>
        </div>
    </div>
</div>

</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>

<script type="text/javascript">

    $(document).ready(function(e) {


//Load Section value on change Department 
        $("#depttoloadsec").change(function(e) {
            var id = $("#depttoloadsec").val();

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
                    //alert('Error get data from ajax');
                }
            });

        });

    }); // End of Document.ready fucntion       



// Saving General basic info
    function employee_gen_save_btn()
    {
        var url;
        url = "<?php echo site_url('employee/employee_gen_first_form_save') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#emp_first_gen_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data.status) //if success close modal and reload ajax table
                {

                    $.ajax({
                        url: "<?php echo site_url('employee/employee_get_emp_section') ?>/" + data.status,
                    });
                    document.location = '<?php echo site_url() . "Emp_Manage/index"; ?>'
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Registraion error!!!');
            }
        });
    }


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
</script>
</body>
</html>