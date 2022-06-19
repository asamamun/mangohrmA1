<!-- 
######################################################################################################

Developed by          : Muhammad Anwar Hossen, WPSI, R-26, IDB-BISEW
View Name             : Employee_List_view (Employee List with session)
Mobile No             : ++01923-020000
Email Address         : anwardote@gmail.com

#######################################################################################################

-->

<?php $this->load->view('header', array('title' => 'Employee')); ?>
<?php $this->load->view('leftnav', array('active' => 'Employee_List')); ?>


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
		
            <div class="row">


                <br />
                <table id="emp_table_details_grid" class="table sar-table table-bordered sortableTable table-condensed table-striped table-hover table-responsive " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width:30px">ID</th>
                            <th>Employee Name</th>
                            <th>Desig.</th>
                            <th>Dept.</th>
                            <th style="max-width:100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Desig.</th>
                            <th>Dept.</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </div>
</div>
</div><!-- /.content-wrapper -->

<?php $this->load->view('footer'); ?>
<?php $this->load->view('footerinfo'); ?>

<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        table = $('#emp_table_details_grid').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Employee/emp_show_ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false //set not orderable
                }
            ]
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


        /* 
         function edit_employees(id)
         {
         
         alert("hello");
         
         
         
         
         * @param {type} data
         * @returns {undefined}      
         save_method = 'update';
         $('#form')[0].reset(); // reset form on modals
         $('.form-group').removeClass('has-error'); // clear error class
         $('.help-block').empty(); // clear error string
         
         //Ajax Load data from ajax
         $.ajax({
         url: "<?php //echo site_url('employee/employee_ajax_edit/') ?>/" + id,
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
         
         //Gender Check Start
         
         
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
         
         //$('[name="deleted"]').datepicker('update',data.deleted);
         // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
         //$("#adminmaster").on("click",".updatetb",function(){
         //$("#detailsviewform").hide(1000)
         //$("#form").hide(1000)
         $("#form").slideDown(1000);
         
         
         
         $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
         
         },
         error: function(jqXHR, textStatus, errorThrown)
         {
         alert('Error get data from ajax');
         }
         }); 
    }*/


    });

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }


    function delete_person(id)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('Employee/employee_ajax_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    //$('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }

    }

    function edit_employee(id)
    {

            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('Employee/set_emp_session_click_edit_btn_tbl') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                   // alert("Sesion is set");
                    //if success reload ajax table
                    //$('#modal_form').modal('hide');
                  //  reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                   // alert('Error deleting data');
                }
            });
    }
</script>
</body>
</html>