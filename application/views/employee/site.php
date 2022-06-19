    <link href="<?php echo site_url(); ?>assets/abc/css/bootstrap.min.css" rel="stylesheet">    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	

          <div class="col-md-8 col-md-offset-2">

            <form action="<?php echo site_url("site/upload") ?>" id="form-upload">            
                <input type="file" name="file">
                

            </form>
<a href="#" id="upload-btn" class="btn btn-success"/> Upload</a>
            <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
            <div class="progress" style="display:none;">
              <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                20%
              </div>
            </div>

            <ul class="list-group"></ul>
          </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->	
<script src="<?php echo site_url(); ?>assets/jquery/emp_Attachment_upload.js"></script>  
