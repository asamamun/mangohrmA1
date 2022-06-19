<?php $this->load->view('header', array('title' => 'Department')); ?>
<?php $this->load->view('leftnav', array('active' => 'Department')); ?>


<div class="content-wrapper">

        <!-- /.content -->
		<section class="content-header">
          <h1 style="padding:7px; height:45px;" class="headtitlebackgroudgradient">
            Department
            <small>Admin Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Department Configuration</a></li>
            
          </ol>
		  
        </section>
		
		<div class="col-md-12">
		<div class="col-md-12" style="background-color:#FFFFFF">
		<div class="col-md-12">
                <br>
        <form action="#" id="departmentform" class="form-horizontal">
                    <input type="hidden" value="" name="deptid"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Name:</label>
                            <div class="col-md-10">
                                <input name="deptname" placeholder="Department Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Description:</label>
                            <div class="col-md-10">
                                <textarea name="deptdesc" placeholder="Department Description" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Plant ID:</label>
                            <div class="col-md-10">
                                <select name="plantid" class="form-control">
								<?php 
								foreach($plants as $plant){
									echo '<option value="'.$plant['plantid'].'">'.$plant['plantid'].'</option>';
								}
								?>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Established:</label>
                            <div class="col-md-10">
                                <input name="createdate" placeholder="yyyy-mm-dd" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-2"></label>
                        <div class="col-md-10">
					<button type="button" id="btnSave" onclick="save_department()" class="btn btn-primary">Save</button>
					<button type="button" id="btnCancel" class="btn btn-danger">Cancel</button>
							<br>
							<br>
						</div>
                    </div>
                </form>
		</div>
        <section class="content">
		<br />
		<br />
		<br />		
		<button class="btn btn-success" onclick="add_department()"><i class="glyphicon glyphicon-plus"></i> Add Department</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
		<div class="row">
		<div class="col-md-12">
        <table id="table" class="table sar-table table-bordered sortableTable responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Plant ID</th>
              
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Plant ID</th>
                 
                    <th>Action</th>
            </tr>
            </tfoot>
        </table>
		</div>
		</section>
		</div>
		</div>
		</div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer');?>
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
	$('#btnCancel').click(function(){
		
	$('#departmentform').hide(1000);
	});
	$('#departmentform').hide();
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('department/ajax_departmentlist')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });


    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_department()
{
    save_method = 'add';
    $('#departmentform')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	$('#departmentform').show(1000);
    //$('.modal-title').text('Add Department'); // Set Title to Bootstrap modal title
}

function edit_department(deptid)
{
    save_method = 'update';
    $('#departmentform')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('department/ajax_editdepartment/')?>/" + deptid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="deptid"]').val(data.deptid);
            $('[name="deptname"]').val(data.deptname);
            $('[name="deptdesc"]').val(data.deptdesc);
            $('[name="plantid"]').val(data.plantid);
            $('[name="createdate"]').datepicker('update',data.createdate);
            $('#departmentform').show(1000); // show bootstrap modal when complete loaded
            //$('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save_department()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('department/ajax_adddepartment')?>";
    } else {
        url = "<?php echo site_url('department/ajax_updatedepartment')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#departmentform').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#departmentform')[0].reset();
                $('#departmentform').hide(1000);
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_department(deptid)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('department/ajax_deletedepartment')?>/"+ deptid,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
				$('#departmentform')[0].reset();
                $('#departmentform').hide(1000);
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

  </body>
</html>     
	  

    


