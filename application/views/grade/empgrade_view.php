<?php $this->load->view('header', array('title' => 'Empgrade')); ?>
<?php $this->load->view('leftnav', array('active' => 'Empgrade')); ?>
<div class="content-wrapper">

    <!-- /.content -->
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Grade 
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Employee Grade Configuration</a></li>

        </ol>
    </section>
<div class='col-md-12'>
    <div class="col-md-12" style="background-color:#FFFFFF">
        <section class="content">
		
			<div class="Formcontainer">
                <form action="#" id="grform" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
					
                        <div class="form-group">
                            <label class="control-label col-md-3">Grade ID</label>
                            <div class="col-md-9">
                                <input name="gradeid" placeholder="Grade ID here." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
                        <div class="form-group">
                            <label class="control-label col-md-3">Grade Name</label>
                            <div class="col-md-9">
                                <input name="gradename" placeholder="Grade Name here." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label class="control-label col-md-3">Basic</label>
                            <div class="col-md-9">
                                <input name="basic" id="basicnm" placeholder="Basic here." class="form-control" type="text">
                                <span class="help-block"></span>
								<span id="name1"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">House Rent</label>
                            <div class="col-md-9">
                                <input name="houserent" id="housnum" placeholder="House Rent here." class="form-control" type="text">
                                <span class="help-block"></span>
								<span id="name2"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Medical Allowance</label>
                            <div class="col-md-9">
                                <input name="medical" id="mnum" placeholder="Medical Allowance here." class="form-control" type="text">
                                <span class="help-block"></span>
								<span id="name3"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Other</label>
                            <div class="col-md-9">
                                <input name="other" id="othnum"  placeholder="OTHER here." class="form-control" type="text">
                                <span class="help-block"></span>
								<span id="name4"></span>
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
        <button class="btn btn-success" onclick="add_grade()"><i class="glyphicon glyphicon-plus"></i> Add Grade</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br/>
        <br/>
		<br/>


                <br />
        <table id="grad" class="table sar-table table-bordered sortableTable responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Basic</th>
                    <th>House Rent</th>
					<th>Medical Allowance</th>
					<th>Other</th>
					
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Basic</th>
                    <th>House Rent</th>
					<th>Medical Allowance</th>
					<th>Other</th>
				
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
            </div>
        </section>
    </div>
	<div class='clearfix'></div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>

<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
	$("#grform").hide();
    //datatables
    table = $('#grad').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('empgrade/ajax_list')?>",
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

    //datepicker
    /*$('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });*/

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



function add_grade()
{
    save_method = 'add';
    $('#grform')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $("#grform").slideDown(1000)
	
}

function grade_edit(id)
{
    save_method = 'update';
    $('#grform')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('empgrade/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="gradeid"]').val(data.gradeid);
            $('[name="gradename"]').val(data.gradename);
            $('[name="basic"]').val(data.basic);
			$('[name="houserent"]').val(data.houserent);
            $('[name="medical"]').val(data.medical);
			$('[name="other"]').val(data.other);
            $("#grform").slideDown(1000);
			

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
function hideForm(){
	$("#grform").hide(1000)
	
	}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('empgrade/ajax_add')?>";
    } else {
        url = "<?php echo site_url('empgrade/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#grform').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                //$('#modal_form').modal('hide');
				hideForm();
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



function grade_delete(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('empgrade/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
				ShowActionMessage("The Grade is deleted!!");
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
 
 $(document).ready(function(){
      
  $('#basicnm').keyup(function(e) {
        if(this.value!='-')
          while(isNaN(this.value))
            this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                                   .split('').reverse().join('');
	$('#name1').html('Number only');	
    })
    .on("cut copy paste",function(e){
    	e.preventDefault();
    });
$('#housnum').keyup(function(e) {
        if(this.value!='-')
          while(isNaN(this.value))
            this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                                   .split('').reverse().join('');
	$('#name2').html('Number only');	
    })
    .on("cut copy paste",function(e){
    	e.preventDefault();
    });
$('#mnum').keyup(function(e) {
        if(this.value!='-')
          while(isNaN(this.value))
            this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                                   .split('').reverse().join('');
	$('#name3').html('Number only');	
    })
    .on("cut copy paste",function(e){
    	e.preventDefault();
    });
$('#othnum').keyup(function(e) {
        if(this.value!='-')
          while(isNaN(this.value))
            this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                                   .split('').reverse().join('');
	$('#name4').html('Number only');	
    })
    .on("cut copy paste",function(e){
    	e.preventDefault();
    });
});
</script>
</body>
</html>











