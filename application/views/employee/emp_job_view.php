                <div class="formcontainer">
                    <form action="#" id="update_emp_job_form" class="form-horizontal">
                        <input type="hidden" value="" name="empidentityid"/> 
                        <div class="form-body">

                            <div class="pull-right" style="padding-right:20px;">
                                <button type="button" style="display:none" onclick="emp_job_update_btn()" class="btn btn-primary  submitbtnwidth EmpJobBtnSave">Update</button>
                                <button type="button" style="display:block"  class="btn btn-success  submitbtnwidth EmpJobBtnEdit" >Edit</button>
                            </div> 
                            <legend>Employee Job Information</legend>
							<div class="form-group">
                                <label class="control-label col-md-3">Card No.</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input value="<?php echo $this->session->userdata('emp_selected_card_no') ?>" class="form-control disabled" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="control-label col-md-3">Job title</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="job_title" placeholder="Job title here." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Job Specification</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="job_spec" placeholder="Job specification." class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Employee Status </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="emp_status" class="form-control">
											<option value="">--Select Status--</option>
											<option value="active">Active</option>
											<option value="onleave">Onleave</option>
											<option value="dismissed">Dismissed</option>
											<option value="terminated">Terminated</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div> 
							<div class="form-group">
                                <label class="control-label col-md-3">Job Category </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="job_category" class="form-control emp_category">
										
										</select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">Shift </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <select name="shift" class="form-control emp_shift">
										
										</select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Join Date </label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="joindate" placeholder="" class="form-control" type="date">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">Job Location</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <label class="control-label">
                                            <input name="job_location" id="hq" value="1" type="radio" checked="checked">  Headquarter  </label>
                                        <label class="control-label">
                                            <input name="job_location" id="factory" value="2"  type="radio">  Factory  </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">start date</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="startdate" placeholder="" class="form-control" type="date">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
							<div class="form-group" id="edate">
                                <label class="control-label col-md-3">End date</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <input name="enddate" placeholder="" class="form-control" type="date">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="control-label col-md-3">Continue</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <label class="control-label">
                                            <input name="continue" id="continue" value="1" type="radio" checked="checked"> Yes </label>
                                        <label class="control-label">
                                            <input name="continue" id="nocontinue" value="0"  type="radio"> No </label>
                                    </div>
                                </div>
                            </div>
					</div> <!-- form-body END --> 
                        <div class="pull-right" style="padding-right:20px;">
                            <button type="button" style="display:none"  onclick="emp_job_update_btn()" class="btn btn-primary submitbtnwidth EmpJobBtnSave">Update</button>
                            <button type="button" style="display:block"   class="btn btn-success submitbtnwidth EmpJobBtnEdit" >Edit</button>
                        </div>  
                    </form>
                </div>
    <div class='clearfix'></div>
<script type="text/javascript">
    var save_method; //for save method string
    var table;
	emp_job_default_load();  
	emp__shift_default_load();
    $(document).ready(function() {
       
	    
        function load_emp_job_data(id)
        {
            $('#update_emp_job_form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('Emp_job/load_emp_job_data_ajax/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    $('[name="empidentityid"]').val(data.id);
                    $('[name="job_title"]').val(data.job_title);
                    $('[name="job_spec"]').val(data.job_spec);
                    $('[name="emp_status"]').val(data.emp_status);
                    $('[name="job_category"]').val(data.job_category);
					$('[name="shift"]').val(data.shift);
                    $('[name="joindate"]').val(data.joindate);
                    //$('[name="job_location"]').val(data.job_location);
					if (data.job_location == 1) {
                        $("#factory").removeAttr('checked');
                        $("#hq").attr('checked', 'checked');   
                    } else {
                        $("#hq").removeAttr('checked');
                        $("#factory").attr('checked', 'checked');   
                    }
                    $('[name="startdate"]').val(data.startdate);
                    $('[name="enddate"]').val(data.enddate);
					//$('[name="continue"]').val(data.continue);
					/*$(function(){
							$('input[name=continue]').on('click',function(){      
							  if($(this).val() == 1){
								  $('#edate').hide();
								}else{
								$('#edate').show();
								$('[name="enddate"]').attr('required', 'true');
								}
							});
							}); */
					if (data.continue == 1) {
					   $("#nocontinue").removeAttr('checked');
                        $("#continue").attr('checked', 'checked');
						$('#edate').hide();		
					}
					else{
						$("#continue").removeAttr('checked');
                        $("#nocontinue").attr('checked', 'checked');
						$('#edate').show();							
					}
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        }
//CAlling function of load_emp_job_data when form is loaded.
<?php
$default_emp = $this->session->userdata('emp_selected_id_no');
if ($default_emp) {
    ?>
            load_emp_job_data('<?php echo $default_emp ?>');

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
    $("#update_emp_job_form input,select").attr('disabled', 'disabled');
    $(".EmpJobBtnEdit").click(function(e) {
        $(".EmpJobBtnEdit").hide();
        $("#update_emp_job_form input,select").removeAttr('disabled');
        $(".disabled").attr('disabled', 'disabled');
        $(".EmpJobBtnSave").show();
       // edit_emp_job('<?php echo $default_emp ?>');
    });
//Function of Updating or Adding emp job
    function emp_job_update_btn()
    {
        var url;
        url = "<?php echo site_url('Emp_job/emp_job_ajax_update') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#update_emp_job_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data.status) //if success close modal and reload ajax table
                {
                    $("#update_emp_job_form input,select").attr('disabled', 'disabled');
                    $(".EmpJobBtnSave").hide();
                    $(".EmpJobBtnEdit").show();
                    $("#SubmitStatus").show();
                    if (data.status === true) {
                        
						ShowActionMessage("The Entry is updated successfully!!", true);
                    } else {
                       
						ShowActionMessage("The Entry is not updated!!", true, "Error");
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

                $('.EmpJobBtnSave').attr('disabled', false); //set button enable 

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $("#SubmitStatus").show();
                //$("#SubmitReturnMessage").html("Sorry, The action is failed.");
                $("#SubmitStatus").show();
                alert(textStatus);
                $('.EmpJobBtnSave').attr('disabled', false); //set button enable 
            }
        });
    }
// Function of loading default job category dropdown 
function emp_job_default_load() {
        var urls = "<?php echo site_url('emp_job/emp_default_loading') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);
            category = data.job_category;
            categorythtml = "<option value=''> Select one </option>";
            category.forEach(function(value, index) {
            categorythtml += "<option value='" + value.id + "'>" + value.title + "</option>";
            });
            $(".emp_category").html(categorythtml);
        });
    } 
function emp__shift_default_load() {
        var urls = "<?php echo site_url('emp_job/emp_shift_loading') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);
            shift = data.shift;
            html = "<option value=''> Select one </option>";
            shift.forEach(function(value, index) {
            html += "<option value='" + value.id + "'>" + value.shiftname + "</option>";
            });
            $(".emp_shift").html(html);
        });
    } 	
 
	$(function(){
							$('input[name=continue]').on('click',function(){      
							  if($(this).val() == 1){
								  $('#edate').hide();
								}else{
								$('#edate').show();
								$('[name="enddate"]').attr('required', 'true');
								}
							});
							});
	
</script>