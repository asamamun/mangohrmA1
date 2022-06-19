<?php $this->load->view('header', array('title' => 'Company Info')); ?>
<?php $this->load->view('leftnav', array('active' => 'Company_Info')); ?>
<div class="content-wrapper">

    <!-- /.content -->
    <section class="content-header">
        <h1 style="padding:7px; height:45px;" class='headtitlebackgroudgradient'>
            Company
            <small>Admin Panel</small></h1>
  
<div class="table-responsive">
   <table class="table table-bordered table-hover table-striped">
      <tr>
	  <th><h4>Comapany Details:</h4></th>
      </tr>
   <?php
  if ($data_get == NULL) {
  ?>
  <div class="alert alert-info" role="alert">Missing data!</div>
  <?php
  } else {
  foreach ($data_get as $row) {
  ?>
          <tr class="success">
          <th>Company Name</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->companyname; ?></td>
		  </tr>
           <tr class="success">
          <th>Company address1</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->companyaddress1; ?></td>
		  </tr>
		   <tr class="success">
          <th>Company address2</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->companyaddress2; ?></td>
		  </tr>
		   <tr class="success">
          <th>Telephone Number</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->tel; ?></td>
		  </tr>
		   <tr class="success">
          <th>Email Address</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->email; ?></td>
		  </tr>
		   <tr class="success">
          <th>Web Address</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->web; ?></td>
		  </tr>
		   <tr class="success">
          <th>Trade License</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->tradeli; ?></td>
		  </tr>
		   <tr class="success">
          <th>Owner Name</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->ownername; ?></td>
		  </tr>
		   <tr class="success">
          <th>Tin Number</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->tin; ?></td>
		  </tr>
		   <tr class="success">
          <th>Establishment Date</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->establishmentdate; ?></td>
		  </tr>
		   <tr class="success">
          <th>Alias</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->alias; ?></td>
		  </tr>
		   <tr class="success">
          <th>Company Type</th>
		 </tr>
		  
		  <tr class="primary">
          <td><?php echo $row->companytype; ?></td>
		  
		  
		  
           
           
         
      <?php
      }
  }
      ?>
        </tr>
      </tbody>
   </table>
  <a href="<?php echo site_url('Company_Setup/edit/' . $row->id); ?>" class="btn btn-primary btn-lg">Edit</a> 
</div>
</div><!-- /.content-wrapper -->
</body>
</html>
