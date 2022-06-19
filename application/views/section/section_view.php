<?php $this->load->view('header', array('title' => 'Section')); ?>
<?php $this->load->view('leftnav', array('active' => 'Section')); ?>


<div class="content-wrapper">

    <!-- /.content -->
    <Section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Section 
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Section Configuration</a></li>

        </ol>
    </Section>
    <div class='col-md-12'>
        <div class="col-md-12" style="background-color:#FFFFFF">
            <Section class="content">




                <div class="formcontainer">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="secid"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Section Title</label>
                                <div class="col-md-9">
                                    <input name="secname" placeholder="Section Title here." class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9">
                                    <input name="secdesc" placeholder="Short Description here." class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Department</label>
                                <div class="col-md-9">
                                    <select name="deptid" id="deptdob" onFocus="loaddept()" class="form-control">

                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                        <div class="pull-right" style="padding-right:20px;">  
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                            <button type="button"  onclick="hideForm()" class="btn btn-danger" >Cancel</button>
                        </div>  
                    </form>
                </div>



                <br />
                <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Section</button>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <br />
                <br />


                <br />
                <table id="table" class="table sar-table table-bordered sortableTable responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SL</th>                    
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>SL</th> 
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>
                            
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
        </Section>
    </div>
    <div class='clearfix'></div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>



<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        loaddept() // For loading Department list on modal
        $("#form").hide()

        //datatables
        table = $('#table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Section/ajax_list') ?>",
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



    function add_person()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        // $('#modal_form').modal('show'); // show bootstrap modal
        $("#form").slideDown(1000)
        $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_person(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Section/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="secid"]').val(data.secid);
                $('[name="secname"]').val(data.secname);
                $('[name="secdesc"]').val(data.secdesc);
                $('[name="deptid"]').val(data.deptid);
                $('[name="createdate"]').val(data.createdate);
                //$('[name="deleted"]').datepicker('update',data.deleted);
                // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                //$("#adminmaster").on("click",".updatetb",function(){
                //$("#detailsviewform").hide(1000)
                //$("#form").hide(1000)
                $("#form").slideDown(1000)



                $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('Section/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('Section/ajax_update') ?>";
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
                    $("#form").hide(1000)
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

    function delete_person(id)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('Section/ajax_delete') ?>/" + id,
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

    function loaddept() {

        var urls = "<?php echo site_url('Section/load_dept') ?>"
        $.post(urls, function(data) {
            //if(data!=1){
            //var mdata=$.trim(data);
            //alert(mdata);
            //}
            //if(data>=1){
            //$("#regmsg").modal('show');
            //location.reload();
            //alert()

            //alert(data)
            //}
            $("#deptdob").html(data)
        });




    }


</script>

<!-- Bootstrap modal 
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Section Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="secid"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Section Title</label>
                            <div class="col-md-9">
                                <input name="secname" placeholder="Section Title here." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <input name="secdesc" placeholder="Short Description here." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Department</label>
                            <div class="col-md-9">
                                <select name="deptid" id="deptdob" onFocus="loaddept()" class="form-control">

                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content 
    </div><!-- /.modal-dialog 
    </div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>