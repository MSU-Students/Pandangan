<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Programs</title>
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.min.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/myStyle.css" type="text/css">
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
    <!-- jQuery -->
<script src="<?=base_url()?>/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/lte/dist/js/adminlte.min.js"></script>

    <style>
    
    a{
        color:black;
    }
  a:hover{
      color: blue;
  }
  .b{
    color:white;
  }
  .b:hover{
    color:navy;
  }
  </style>
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
           <li class="breadcrumb-item "> <a  href="<?=base_url()?>ADMS/manageProgramsV">Programs</a></li>
           <li class="breadcrumb-item activated"><?=$programName->programName?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
    <?php 
                  if(isset($_GET['m'])){
                     $message = $_GET['m'];
                     echo $message;
                  }
                  ?>     
  
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        
        <div class="card mb-3">
        <div class="card-header color13" >
             <strong><?=$programName->programName?> (<?=$selectedLevel->levelName?>)</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
    
            
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13">
                            <tr>
                              <th></th>
                               <th style="text-align:center"></th>
                               <th style="text-align:left" >Areas</th>
                                <th style="text-align:center">Total Folders</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                  
                      foreach($rows as $row){ 
                        
                    ?>       
                        
                                <tr>
                                    <td width="2%">Area</td>
                                    <td align="center" width="2%"><?= $row['areaNum'] ?></td> 
                                    <td><a href="<?=base_url()?>ADMS/insideProgramsV/<?= $selectedLevel->levelID?>/<?= $row['id']?>/<?=$programID?>"  ><?= $row['areaName'] ?></a>
                                    </td> 
                                    <td align="center"><?=$overAllFolder[$i++]?></td>
                                   
                                </tr>
                    <?php
                        
                    
                  }   ?>

                  <?php  if($user->userType == 'Accreditor'){ ?>
                   <tr>
                      <td align="center">---</td>
                      <td align="center">--->></td>
                      <td ><a href="<?=base_url()?>ADMS/finalEvaluateV/<?= $levelID?>/<?=$programID?>">Go to Upload Final Evaluation</a></td>
                      <td></td>
                   </tr>
                        
                  
                  <?php }else { ?>

                    <tr>
                      <td align="center">---</td>
                      <td align="center">--->></td>
                      <td ><a href="<?=base_url()?>ADMS/finalEvaluateV/<?= $levelID?>/<?=$programID?>">See Accreditor's Evaluation Uploads</a></td>
                      <td></td>
                   </tr>
               <?php   } ?>
                   
                   
                  
            </tbody>
             </table>
            
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


<script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>

</body>
</html>
<script>
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false,
   bSort: false
   
   
  });
    
 
});
</script>