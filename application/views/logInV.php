<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  if(isset($_SESSION['usersID'])){
    redirect(base_url()."ADMS/homePageV");    
  }
?>
<!DOCTYPE html>
<html lang="en">

  <head>
	<style>
    .bdy{
      background-color: whitesmoke;
    }
  </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/lte/pandangan-logo.3.png">
    
    <title>Log In</title>

    <!-- Bootstrap core CSS-->
    <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
 
    <!-- Custom styles for this template-->
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/theme.css" rel="stylesheet">

  </head>

  <body class="bdy">

  <div class="container" >
                <div class="login-wrap " >
                    <div class="login-content elevation-5 round " style="border-radius:10px" >
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?=base_url()?>/msu-header.png">
                            </a>
                        </div>
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?=base_url()?>/pandangan-logo4.png">
                            </a>

                        </div>
                        <?php 
                          if(isset($_SESSION['logInError'])){
                            $message = $_SESSION['logInError'];
                            echo $message;
                          };
                          
                       ?>
                        <form method="post" action="<?=base_url()?>/ADMS/logInM">   
                
                <div>
                    <div class="input-group mb-2">
                        <label class="sr-only" for="">Username</label>
                        <div class="input-group mb-2" >
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-user"></i></div>
                          </div>
                            <input name="username" type="text" class="form-control" id="" placeholder="Username" autofocus required>
                        </div>
                     </div>
                    <div>
                        <label class="sr-only" for="">Password</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                          </div>
                            <input name="password" type="password" class="form-control" id="" placeholder="••••••••••••" autofocus required>
                        </div>
                     </div>

                </div>
                <br>
                 <button type="submit" name="logIn" style="text-align: center;" role="button" class="btn cstm-btn-navy btn-block"><strong>SIGN IN</strong></button>
                 <br>
              </form>
                           
                    </div>
                </div>
            </div>
    




  </body>

</html>


