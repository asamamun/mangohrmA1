<?php $this->load->view('header', array('title' => 'Company Info')); ?>
<?php $this->load->view('leftnav', array('active' => 'Company_Info')); ?>
<div class="content-wrapper">
 <?php echo form_open('Company_Setup/update', 'role="form"'); ?> 
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
           Company
            <small>Admin Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Company Address Info</a></li>

        </ol>
    </section>
<div class='col-md-12'>
 <div class="col-md-12" style="background-color:#FFFFFF">
 <section class="content">
                
<div class="formcontainer"  >
    <h3>Company details</h3>
 <form action="#" id="update_emp_address_form" class="form-horizontal">
  <div class="form-group">
    <label for="cn">Company Name</label>
    <input type="text" class="form-control" id="cn" name="cn" value="<?php echo $cn ?>">
  </div>
  <div class="form-group">
    <label for="dsc">Description</label>
    <input type="text" class="form-control" id="dsc" name="dsc" value="<?php echo $dsc ?>">
  </div>
  <div class="form-group">
    <label for="ad1">Company Address 1</label>
    <input type="text" class="form-control" id="ad1" name="ad1" value="<?php echo $ad1 ?>">
  </div>
  <div class="form-group">
    <label for="ad2">Company Address 2</label>
    <input type="text" class="form-control" id="ad2" name="ad2" value="<?php echo $ad2 ?>">
  </div>
 
<div class="form-group">
    <label for="teln">Telephone Number</label>
    <input type="text" class="form-control" id="teln" name="teln" value="<?php echo $teln ?>">
  </div>
<div class="form-group">
    <label for="fxn">Fax Number</label>
    <input type="text" class="form-control" id="fxn" name="fxn" value="<?php echo $fxn ?>">
  </div>
<div class="form-group">
    <label for="eman">Email Address</label>
    <input type="email" class="form-control" id="eman" name="eman" value="<?php echo $eman ?>">
  </div>
<div class="form-group">
    <label for="webadd">Web Address</label>
    <input type="text" class="form-control" id="webadd" name="webadd" value="<?php echo $webadd ?>">
  </div>
<div class="form-group">
    <label for="tradelice">Trade License</label>
    <input type="text" class="form-control" id="tradelice" name="tradelice" value="<?php echo $tradelice?>">
  </div>
<div class="form-group">
    <label for="owna">Owner Name</label>
    <input type="text" class="form-control" id="owna" name="owna" value="<?php echo $owna ?>">
  </div>
<div class="form-group">
    <label for="tnum">Telephone Number</label>
    <input type="text" class="form-control" id="tnum" name="tnum" value="<?php echo $tnum ?>">
  </div>
<div class="form-group">
    <label for="edate">Establishment date</label>
    <input type="date" class="form-control" id="edate" name="edate" value="<?php echo $edate ?>">
  </div>
<div class="form-group">
    <label for="alia">Alias</label>
    <input type="text" class="form-control" id="alia" name="alia" value="<?php echo $alia ?>">
  </div>
<div class="form-group">
    <label for="ctype">Company Type</label>
    <input type="text" class="form-control" id="ctype" name="ctype" value="<?php echo $ctype ?>">
  </div>

  <input type="hidden" name="id" value="<?php echo $id ?>" />
  <input type="submit" name="mit" class="btn btn-primary" value="Update">
  <button type="button" onclick="location.href='<?php echo site_url('Company_Setup') ?>'" class="btn btn-success">Back</button>
</form>
<?php echo form_close(); ?>
</div>
 </div>
    </section>
</div>
</div>
</body>
</html>
