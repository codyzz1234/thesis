<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('assets/login/css/loginStyle.css') ?>" type="text/css" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <link rel = "stylesheet" href="<?php echo base_url('assets/toastr/toastr.css') ?>" type="text/css" />

        
    </head>
    <body>
        <div class="container-fluid">   
        <div class="row justify-content-center">
            <div class="col col-12 col-sm-9 col-md-8 col-lg-4">
                <form method = "post" id = "loginForm"?>
                    <div class="form-container">
                    <div class="form-group">
                        <img class="img-fluid" src="<?php echo base_url('assets\images\EmployeeSide\employee-login-img.jpg') ?>" alt="">
                        <label>Employee Number</label>
                        <input class="form-control" id="EmployeeNumber" aria-describedby="userNameHelp" placeholder="Enter Employee Number">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="PasswordField" placeholder="Enter Password">
                        </div>
                        <br>
                        <button type="submit"  class="btn btn-primary btn-lg btn-block loginButton" id = "loginButton">Login</button>
                    </div>
                  </form>
                  </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>var baseurl = '<?php echo base_url() ?>';</script>

        <script src="<?php echo base_url('assets\js\EmployeeSide\ELogin.js') ?>"></script>

    </body>
</html>