<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo base_url();?>/assets/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <title>home page</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                        <h3><strong>Welcome to MangoHRMS Home Page</strong></h3>
						<?php echo $this->session->userdata('username')?> 
                   
                     
                    <a href="<?php echo base_url();?>Login/logout" class="btn btn-info btn-lg pull-right">Logout</a>
                </div>
            </div>
        </div>
    </body>
</html>