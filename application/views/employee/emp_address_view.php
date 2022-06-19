
                <div class="formcontainer"  >
                    <form action="#" id="update_emp_address_form" class="form-horizontal">
                        <input type="hidden" value="" name="empidentityid"/> 
                        <div class="form-body">

                            <div class="pull-right" style="padding-right:20px;">
                                <button type="button" style="display:none" onclick="emp_address_update_btn()" class="btn btn-primary  submitbtnwidth EmpAddressBtnSave">Update</button>
                                <button type="button" style="display:block"  class="btn btn-success  submitbtnwidth EmpAddressBtnEdit" >Edit</button>
                            </div> 
                            <legend>Present Address Information</legend>


                            <!--div class="form-group">
                                <label class="control-label col-md-3">Card No.</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input placeholder="Employee Address 1 here." value="<?php echo $this->session->userdata('emp_selected_card_no') ?>" class="form-control disabled" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div-->							


                            <div class="form-group">
                                <label class="control-label col-md-3">Address (1)</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_address1" placeholder="Employee Address 1 here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Address (2)</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_address2" placeholder="Employee Address 1 here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Village </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_village" placeholder="Employee Village Name here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Post Office </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_post_name" placeholder="Employee Post Name here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Post Code </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_post_code" placeholder="Post Code here. Ex- 1216" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Upazila </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_upazila" placeholder="Employee Upozila Name here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">District</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="c_dist" placeholder="Employee District Name here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Country </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="c_country" class="form-control emp_country">

                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div> 





                            <div class="form-group">
                                <label class="control-label col-md-4" style="color:green; font-size: 1.2em">Both Address are -</label>
                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input name="sameornot" id="sameornotno" value="no" type="radio" checked="checked">Not Same</label>
                                        <label class="radio-inline">
                                            <input name="sameornot" id="sameornotyes" value="yes"  type="radio">Same</label>
                                    </div>
                                </div>
                            </div>




                            <div id="permaform">

                                <legend>Employee Permanent Address</legend>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Address (1)</label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_address1" placeholder="Employee Address 1 here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Address (2)</label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_address2" placeholder="Employee Address 1 here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Village </label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_village" placeholder="Employee Village Name here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Post Office </label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_post_name" placeholder="Employee Post Name here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Post Code </label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_post_code" placeholder="Post Code here. Ex- 1216" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Upazila </label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_upazila" placeholder="Employee Upozila Name here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">District</label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <input name="p_dist" placeholder="Employee District Name here." class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Country </label>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <select name="p_country" class="form-control emp_country">

                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>   




                            </div> <!-- permaform closing -->
                        </div> <!-- form-body END --> 

                        <div class="pull-right" style="padding-right:20px;">
                            <button type="button" style="display:none"  onclick="emp_address_update_btn()" class="btn btn-primary submitbtnwidth EmpAddressBtnSave">Update</button>
                            <button type="button" style="display:block"   class="btn btn-success submitbtnwidth EmpAddressBtnEdit" >Edit</button>
                        </div>  
                    </form>
                </div>

    <div class='clearfix'></div>




<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
       

        // Function of Loading country;
        function load_emp_address_data(id)
        {
            $('#update_emp_address_form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('Emp_address/load_emp_address_data_ajax/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);

                    $('[name="empidentityid"]').val(data.id);
                    $('[name="p_address1"]').val(data.p_address1);
                    $('[name="p_address2"]').val(data.p_address2);
                    $('[name="p_village"]').val(data.p_village);
                    $('[name="p_post_name"]').val(data.p_post_name);
                    $('[name="p_post_code"]').val(data.p_post_code);
                    $('[name="p_upazila"]').val(data.p_upazila);
                    $('[name="p_dist"]').val(data.p_dist);
                    $('[name="p_country"]').val(data.p_country);
                    // $('[name="sameornot"]').val(data.sameornot);

                    //SameOrNot radio btn Start
                    if (data.sameornot === 'yes') {
                        $("#sameornotno").removeAttr('checked');
                        $("#sameornotyes").attr('checked', 'checked');
                        $("#permaform").hide();
                    } else {
                        $("#sameornotyes").removeAttr('checked');
                        $("#sameornotno").attr('checked', 'checked');
                        $("#permaform").show();
                    }


                    $('[name="empidentityid"]').val(data.id);
                    $('[name="c_address1"]').val(data.c_address1);
                    $('[name="c_address2"]').val(data.c_address2);
                    $('[name="c_village"]').val(data.c_village);
                    $('[name="c_post_name"]').val(data.c_post_name);
                    $('[name="c_post_code"]').val(data.c_post_code);
                    $('[name="c_upazila"]').val(data.c_upazila);
                    $('[name="c_dist"]').val(data.c_dist);
                    $('[name="c_country"]').val(data.c_country);

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

 emp_address_default_load();
//CAlling function of load_emp_address_data when form is loaded.
<?php
$default_emp = $this->session->userdata('emp_selected_card_no');
if ($default_emp) {
    ?>
            load_emp_address_data('<?php echo $default_emp ?>');

    <?php
}
?>
    });


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


// Edit and Update Btn Ctrl
    $("#update_emp_address_form input,select").attr('disabled', 'disabled');
    $(".EmpAddressBtnEdit").click(function(e) {
        $(".EmpAddressBtnEdit").hide();
        $("#update_emp_address_form input,select").removeAttr('disabled');
        $(".disabled").attr('disabled', 'disabled');
        $(".EmpAddressBtnSave").show();
        load_emp_address_data('<?php echo $default_emp ?>');
    });



//Function of Updating or Adding emp Address
    function emp_address_update_btn()
    {
        var url;
        url = "<?php echo site_url('Emp_address/emp_address_ajax_update') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#update_emp_address_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $("#update_emp_address_form input,select").attr('disabled', 'disabled');
                    $(".EmpAddressBtnSave").hide();
                    $(".EmpAddressBtnEdit").show();
                    $("#SubmitStatus").show();
                    if (data.status === true) {
                       // $("#SubmitReturnMessage").html("The Entry is updated successfully!!");
                       ShowActionMessage("The Entry is updated successfully!!", true);
                    } else {
                ShowActionMessage("The Entry is not updated!!", true, "Error");
                       
                // $("#SubmitReturnMessage").html(data.status);
                    }
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('.EmpAddressBtnSave').attr('disabled', false); //set button enable 

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $("#SubmitStatus").show();
                $("#SubmitReturnMessage").html("Sorry, The action is failed.");
                $("#SubmitStatus").show();
                alert(textStatus);
                $('.EmpAddressBtnSave').attr('disabled', false); //set button enable 
            }
        });
    }



// Function of loading default country dropdown 
    function emp_address_default_load() {

        var urls = "<?php echo site_url('emp_address/emp_default_loading') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);

            dept = data.country;
            depthtml = "<option value=''> Select one </option>";
            dept.forEach(function(value, index) {
                depthtml += "<option value='" + value.countrycode + "'>" + value.countryname + "</option>";
            });
            $(".emp_country").html(depthtml);
        });
    }

    //alert($("input[name='sameornot']").checked);
    //alert(document.getElementsByClassName('sameornot').valueOf().item.name)

    $("#sameornotyes").click(function(e) {
        $("#permaform").hide();
    });
    $("#sameornotno").click(function(e) {
        $("#permaform").show();
        $('[name="p_address1"]').val('');
        $('[name="p_address2"]').val('');
        $('[name="p_village"]').val('');
        $('[name="p_post_name"]').val('');
        $('[name="p_post_code"]').val('');
        $('[name="p_upazila"]').val('');
        $('[name="p_dist"]').val('');
        $('[name="p_country"]').val('');
    });



    var sameornot = $("input[name='sameornot']").prop('checked');

    if (sameornot == 'yes') {
        $("#permaform").hide();
        $("#sameornotyes").attr('checked', true)
        
    } else {
        $("#permaform").show();
        $("#sameornotno").attr('checked', true)
    }




</script>