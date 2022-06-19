<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>login page</title>
		<script src="<?php echo base_url();?>/assets/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <link href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
         
        <style>
            #response{display: none}
        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 10%">
            <div class="row clear_fix">
                <div class="col-md-6 col-md-offset-3">
                    <p class="alert alert-danger" id="response"><b>INVALID USER NAME OR PASSWORD</b></p>
                    <form id="frm_login" role="form" action="<?php echo base_url();?>Login/login" method="POST">
					<form id="frm_login" role="form" action="<?php echo base_url() ?>auth/login" method="POST">
                        <div class="form-group">
                          <label for="">User name</label>
                          <input type="text" class="form-control" name="username"  placeholder="User name">
                        </div>
                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" class="form-control" name="password"  placeholder="Password">
                        </div>
                        <input type="submit" class="btn btn-info btn-block" value="submit">
                      </form>
                     
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function (){
            $("#frm_login").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();
                 
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                   if(data !=='')
                    {
                        $("#response").show('fast');
                        $("#response").effect( "shake" );
                        $('#frm_login')[0].reset();
                    }
                    else
                    {
                    window.location.href='<?php echo base_url() ?>Admin/';
                    throw new Error('go');
                    } 
                });
            });
             
            $( "div" ).each(function( index ) {
            var cl = $(this).attr('class');
            if(cl =='')
                {
                    $(this).hide();
                }
            });
             
        });
        </script>
         
    </body>
</html>