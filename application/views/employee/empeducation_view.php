
<div class="Formcontainer" >
    <div class="col-md-12">

        <button type="button" class="btn btn-success" id="addempeeducation">Add Education</button>
        <button type="button" class="btn btn-info" id="showempeeducation">Show</button>
    </div>
    <br>
    <br>
    <div id="message" class="text-danger"></div>
    <div class="col-md-12">
        <br>
        <form action="#" id="edu_form" class="form-horizontal">
            <input type="hidden" value="" name="id"/> 
            <div class="form-body">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Employee ID</label>
                        <div class="col-md-9">
                            <input value="<?php echo $this->session->userdata('emp_selected_card_no'); ?>" class="form-control" disabled type="text" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Level</label>
                        <div class="col-md-9">
                            <!--input name="level" placeholder="" class="form-control" type="text"-->
                            <select class="form-control" name="level" id="level_option">
                                <option disabled selected value>Select One</option>
                                <option>SSC</option>
                                <option>HSC</option>
                                <option>Diploma</option>
                                <option>BBA</option>
                                <option>BSC</option>
                                <option>BBS(pass)</option>
                                <option>BBS(honur's)</option>
                                <option>Masters</option>
                                <option>MBA</option>
                                <option>MSC</option>
                                <option>MBBS</option>
                                <option>PHD</option>
                            </select>

                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Institue</label>
                        <div class="col-md-9">
                            <input type="text" name="institute" id="institute" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Education Board</label>
                        <div class="col-md-9">
                            <input type="text" name="board" id="board" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Major</label>
                        <div class="col-md-9">
                            <input type="text" name="major" id="major" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Passing Year</label>
                        <div class="col-md-9">
                            <input type="text" name="year" id="year" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Score</label>
                        <div class="col-md-9">
                            <input type="text" name="score" id="score" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-md-3">Session Year</label>
                        <div class="col-md-9">
						<div class="row">
						<div class='col-md-6'>
						                            <div class="form-group">
                                <label class="control-label col-md-3 ">From</label>
                                <div class="col-md-9">
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
							</div>
							
							
							                        <div class="col-md-6">    
                            <div class="form-group">
                                <label class="control-label col-md-3">To</label>
                                <div class="col-md-9">
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
						 </div>
							
							

                        </div>
                    </div>

                    
            </div>
            <div class="row">
                <label class="control-label col-md-3"></label>
                <div class="col-md-9">
                    <button type="button" id="btnSaveedu" onclick="save_empeeducation()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="empedudiv">
        <?php //echo $this->load->view('employee/_emexperienceInTable',array('empexperience'=>$empexperience), TRUE); ?>
    </div>
</div>
</div>


<script type="text/javascript">

    var save_method;
    var table;
    var td;
    function loadEducation() {
        var url = "<?php echo site_url('Empeducation/showEmployeeEducation/') ?>";
        $.get(url, function(data) {
            $("#empedudiv").html(data);
            //alert(data);
        });
    }

    $(document).ready(function(e) {
        $("#level_option").removeAttr("disabled");
        $('#edu_form').hide();
        //$("#edu_form").hide(1000)
        //$('#tableempeducation').hide();

        loadEducation();

        $('#addempeeducation').click(function(e) {
            $('#tableempeducation').hide();
            add_empeducation();
        });

        $('#showempeeducation').click(function(e) {
            loadEducation();
            $('#edu_form').hide();
            $('#tableempeducation').show(1000);
        });


        $('input').change(function(e) {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        /*$('textarea').change(function(e) {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        
        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "0000-00-00",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });*/

    });

    function add_empeducation() {
        save_method = 'add';
        $('#edu_form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        //$('#edu_form').show();
        $("#edu_form").slideDown(1000);
    }

    function edit_empeeducation(id) {
        save_method = 'update';
        $('#edu_form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('empeducation/ajax_editempeeducation/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                //$('[name="eid"]').val(data.empid);
                $('[name="level"]').val(data.level);
                $('[name="institute"]').val(data.institute);
                $('[name="board"]').val(data.board);
                $('[name="major"]').val(data.major);
                $('[name="year"]').val(data.year);
                $('[name="score"]').val(data.score);
                $('[name="start_date"]').val(data.start_date);
                $('[name="end_date"]').val(data.end_date);
                //$('[name="created"]').val(data.created);
                loadEducation();
                $('#edu_form').show(1000);

            },
            error: function(jqXHR, textStatus, errorThrown) {

                //alert('Error get data from ajax ?');
                ShowActionMessage('Error get data from ajax!!!')
            }
        });
    }

    function save_empeeducation() {
        $('#btnSaveedu').text('saving...');
        $('#btnSaveedu').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('empeducation/ajax_addempeeducation') ?>";
        }
        else {
            url = "<?php echo site_url('empeducation/ajax_updateempeducation') ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#edu_form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status)
                {
                    $('#edu_form').hide(1000);
                    ShowActionMessage('Employee Education record saved !!')
                    loadEducation();
                }
                else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSaveedu').text('save');
                $('#btnSaveedu').attr('disabled', false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                ShowActionMessage('Employee Education record saving failed ?!!', false)
                $('#btnSaveedu').text('save');
                $('#btnSaveedu').attr('disabled', false);
            }
        });
    }

    function delete_empeducation(id) {
        if (confirm('Are you sure delete this data ?')) {
            $.ajax({
                url: "<?php echo site_url('empexperience/ajax_deleteempeducation') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    ShowActionMessage('Record deleted successfully!!!')
                    loadEducation();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    ShowActionMessage('Record deletion failed ', false);
                }
            });
        }
    }


</script>
</body>

</html>