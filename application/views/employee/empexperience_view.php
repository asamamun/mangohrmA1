
<div class="row">
    <div class="col-md-9">

        <button type="button" class="btn btn-success" id="addempexperience">Add</button>
        <button type="button" class="btn btn-info" id="showempexperience">Show</button>
    </div>
    <br>
    <br>
    <div id="message" class="text-danger"></div>
    <div class="col-md-10">
        <br>
        <form action="#" id="empexperienceform" class="form-horizontal">
            <input type="hidden" value="" name="id"/> 
            <div class="form-body">

                <div class="form-group">
                    <label class="control-label col-md-2 text-primary">Company</label>
                    <div class="col-md-10">
                        <input name="company" placeholder="Company" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 text-primary">Occupation</label>
                    <div class="col-md-10">
                        <input name="occupation" placeholder="Occupation" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 text-primary">Experience from</label>
                    <div class="col-md-10">
                        <input name="exp_from" placeholder="yyyy-mm-dd" class="form-control" type="date">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 text-primary">Experience to</label>
                    <div class="col-md-10">
                        <input name="exp_to" placeholder="yyyy-mm-dd" class="form-control" type="date">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 text-primary">Comment</label>
                    <div class="col-md-10">
                        <textarea name="comment" placeholder="Comment" class="form-control"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>


            </div>
            <div class="row">
                <label class="control-label col-md-2"></label>
                <div class="col-md-10">
                    <button type="button" id="btnSave" onclick="save_empexperience()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="empexpdiv">
        <?php //echo $this->load->view('employee/_emexperienceInTable',array('empexperience'=>$empexperience), TRUE); ?>
    </div>
</div>


<script type="text/javascript">

    var save_method;
    var table;
    var td;
    function loadExperience() {
        var url = "<?php echo site_url('Empexperience/showEmployeeExp/') ?>";
        $.get(url, function(data) {
            $("#empexpdiv").html(data);
            //alert(data);
        });
    }

    $(document).ready(function(e) {

        $('#empexperienceform').hide();
        //$('#tableempexperience').hide();

        loadExperience();

        $('#addempexperience').click(function(e) {
            $('#tableempexperience').hide();
            add_empexperience();
        });

        $('#showempexperience').click(function(e) {
            loadExperience();
            $('#empexperienceform').hide();
            $('#tableempexperience').show();
        });


        $('input').change(function(e) {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('textarea').change(function(e) {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    function add_empexperience() {
        save_method = 'add';
        $('#empexperienceform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#empexperienceform').show();
    }

    function edit_empexperience(id) {
        save_method = 'update';
        $('#empexperienceform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('empexperience/ajax_editempexperience/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                //$('[name="eid"]').val(data.empid);
                $('[name="company"]').val(data.company);
                $('[name="occupation"]').val(data.occupation);
                $('[name="exp_from"]').val(data.exp_from);
                $('[name="exp_to"]').val(data.exp_to);
                $('[name="comment"]').val(data.comment);
                //$('[name="created"]').val(data.created);
                loadExperience();
                $('#empexperienceform').show();

            },
            error: function(jqXHR, textStatus, errorThrown) {

                //alert('Error get data from ajax ?');
                ShowActionMessage('Error get data from ajax!!!')
            }
        });
    }

    function save_empexperience() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('empexperience/ajax_addempexperience') ?>";
        }
        else {
            url = "<?php echo site_url('empexperience/ajax_updateempexperience') ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#empexperienceform').serialize(),
            dataType: "JSON",
            success: function(data) {
                //alert("inserted id:" + data);	
                if (data.status)
                {
                    $('#empexperienceform').hide(1000);
                    //alert("Employee experience record saved !");
                    ShowActionMessage('Employee experience record saved !!')

                    loadExperience();
                }
                else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                ShowActionMessage('Employee experience record saving failed ?!!', false)

                //alert('Employee experience record saving failed ?');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function delete_empexperience(id) {
        if (confirm('Are you sure delete this data ?')) {
            $.ajax({
                url: "<?php echo site_url('empexperience/ajax_deleteempexperience') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //alert('Record deleted successfully ?');
                    ShowActionMessage('Record deleted successfully!!!')

                    //location.reload();
                    loadExperience();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    ShowActionMessage('Record deletion failed ', false)
                    //alert('Record deletion failed ?');
                }
            });
        }
    }


</script>
</body>

</html>