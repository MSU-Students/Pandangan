<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Home Page</title>
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.min.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/myStyle.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <script src="<?=base_url()?>/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/lte/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed " >
<div class="wrapper" >

  <!-- Navbar -->
  <?php $this->load->view('headerLTE'); ?>
  

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <?php $this->load->view('sidebarLTE'); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          <div class="col colorCrumb elevation-1">
            <ol class="breadcrumb float-sm-left mb-2 mt-2 ml-2 ">
              <li class="breadcrumb-item activated">Home</li>
             
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

          <div class="col">
            <div class="card elevation-3 footer">
             
              <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                  <?php
                  $i = 0;
                  foreach($slider as $img){
                    $active = '';
                    if($i == 0)
                        $active = 'active';

                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i++.'" class="'.$active.'"></li>';
                  }
                    ?>
                  </ol>
                  <div class="carousel-inner ">
                  <?php
                  $i = 0;
                      foreach($slider as $img){
                        $active = '';
                        if($i == 0)
                            $active = 'active';
                      
                          echo '<div class="carousel-item '.$active.'">
                                  <img class="d-block w-100" style="height:400px" src="'.base_url().'/uploads/slider/'.$img->fileName.'" ">
                                </div>';
                                $i++;    
                   } ?>
                  </div>
                  <a class="carousel-control-prev hov" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next hov" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
             
            </div>
          
          </div>
          
         
        </div>
       
      
      </div>
    </div>
    
 

  
  <?php $this->load->view('aboutLTE'); ?>
  

  <?php $this->load->view('footerLTE'); ?>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

</body>
</html>
