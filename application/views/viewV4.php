<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV");

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
     <!-- myStyle CSS-->
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/css/sb-admin.css" rel="stylesheet">
      <!-- Bootstrap core JavaScript-->
      <script src="<?=base_url()?>/vendor/jquery/jquery.min.js"></script>
      <script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                  
                      <!-- Core plugin JavaScript-->
     <script src="<?=base_url()?>/vendor/jquery-easing/jquery.easing.min.js"></script>
                  
                      <!-- Custom scripts for all pages-->
      <script src="<?=base_url()?>/js/sb-admin.min.js"></script>
      <script src="<?=base_url()?>/vendor/jquery/jquery.js"></script>
 
     
 
  
</head>

<body class="" style="background-color:rgb(12, 12, 63)">


    <span class="float-right mt-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/archivePageV" class="btn btn-danger " style="border-radius:20px;text-align:center;background-color:red"><strong>X</strong></a></span>
 
      
                          <?php
                            if(substr($var, -3) == 'pdf' || substr($var, -3) == 'PDF'){
                          ?>
                              <div align="center">
                                      
                                        <iframe src="<?=$var?>" style="margin:20px auto 0" width="95%" height="95%"></iframe>
                                      

                                  </div>
                          <?php
                              }elseif(substr($var, -3) == 'mp4' || substr($var, -3) == 'mkv' || substr($var, -3) == 'MP4' || substr($var, -3) == 'MKV'){
                          ?>
                                  <div class="" align="center">
                                      <video class="frame color8" style="margin:20px auto 0" width="100%" height="82%" controls autoplay >
                                          <source src="<?=$var?>" type="video/mp4" >
                                    </video>
                                  </div>
                          <?php          
                          }else{?>
                                  <div align="center" >
                                      <img src="<?=$var?>" alt="" class="frame color8" style="margin:20px auto 0">
                                  </div>
                              <?php
                            
                          }
                          ?>
              

                            

                              </div>
                          
                          <br>

        
</body>
  </html>
