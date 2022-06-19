<?php $this->load->view('header', array('title' => 'Designation')); ?>
<?php $this->load->view('leftnav', array('active' => 'Designation')); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Designations
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Designations</a></li>

        </ol>
    </section>
    <!--add/edit form start-->
    <div class='col-md-12'>
        <div class="col-md-12" style="background-color:#FFFFFF">
            <section class="content">	
                <div class="formcontainer">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="desigid"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Designation Name</label>
                                <div class="col-md-9">
                                    <input name="designame" placeholder="Designation Name" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea name="desigdesc" placeholder="Description" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Grade</label>
                                <div class="col-md-9">
                                    <select name="grade" class="form-control empgrade">
                                        
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="pull-right" style="padding-right:20px;">  
                                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                                <button type="button"  onclick="hideForm()" class="btn btn-danger" >Cancel</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <!--close form-->

                </br>
                <button class="btn btn-success" onclick="add_designations()"><i class="glyphicon glyphicon-plus"></i> Add Designations</button>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <br/>
                <br/>
                <br/>
                <table id="table" class="table sar-table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Grade</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Grade</th>

                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

        </div>
        </section>
    </div>
</div>

<div class='clearfix'></div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>     
<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
		emp_grade_default_load();
        $("#form").hide();
        //datatables
        table = $('#table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('designations/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
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

    });



    function add_designations()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $("#form").slideDown(1000)
        //$('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Designations'); // Set Title to Bootstrap modal title
    }

    function edit_designations(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('designations/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="desigid"]').val(data.desigid);
                $('[name="designame"]').val(data.designame);
                $('[name="desigdesc"]').val(data.desigdesc);
                $('[name="grade"]').val(data.grade);
                $('[name="deleted"]').val(data.deleted);
                
                $("#form").slideDown(1000);
                //$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                //$('.modal-title').text('Edit Designations'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
    function hideForm() {
        $("#form").hide(1000)

    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('designations/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('designations/ajax_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    //$('#modal_form').modal('hide');
                    hideForm();
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
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }



    function delete_designations(id)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('designations/ajax_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

function emp_grade_default_load() {
        var urls = "<?php echo site_url('designations/emp_grade_loading') ?>";
        $.post(urls, function(data) {
            data = JSON.parse(data);
            grade = data.emp_grade;
			//alert(grade);
            gradethtml = "<option value=''> Select grade </option>";
            grade.forEach(function(value, index) {
            gradethtml += "<option value='" + value.gradeid + "'>" + value.gradename +" [basic="+ value.basic + "] </option>";
            });
            $(".empgrade").html(gradethtml);
        });
    } 	
	
</script>

</body>
</html>