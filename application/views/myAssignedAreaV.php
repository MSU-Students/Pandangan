<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>My Assigned Task</title>
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.min.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/myStyle.css" type="text/css">
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
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
               <li class="breadcrumb-item activated">My Assigned Area</li>
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
     <!-- <div align="right" style="margin-bottom: 5px; margin-right: 15px;">
            <button type="button" data-toggle="modal" data-target="#uploadFile" id="<?=$folder?>" class="upload btn cstm-btn-navy">Upload File</button>
   </div> -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <div class="card mb-3">
        <div class="card-header color13" style="color: white">
             <strong>My Assigned Area </strong>
         </div>
        
         <div class="card-body" > 
        <div class="table-responsive">
       <br>
           
            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="text-align:left">Your Assigned Area(s)</th>
                                <th class="text-left">Program</th>
                                <th>Current Level</th>
                                
                               
                            </tr> 
                    </thead>
                    <tbody>
                    <?php 
                     
                     
                     foreach($showAssignedArea as $row2){
                      
                      $currentLevel = $this->ADMSM->programCurrLevelM($row2['levelID']);
                    
                     
                        ?>       
                                    <tr>
                                        <td width="5%">Area</td>
                                        <td width="3%"><?=$row2['areaNum']?></td>
                                        <td><a href="#" class="n" id="<?=$row2['levelID']?>" data-program_name="<?=$row2['programName']?>" data-level="<?=$currentLevel?>" data-area="<?=$row2['id']?>" data-program="<?=$row2['program']?>" data-name="<?=$row2['areaName']?>" data-toggle="modal" data-target="#myAssignedArea"><?=$row2['areaName'] ?></a></td>
                                        <!-- <td><a href="<?=base_url()?>ADMS/tagFolderV/<?=$levelID?>/<?=$row2['id']?>/<?=$row2['program']?>"><?=$row2['areaName'] ?></a></td>  -->
                                        <td><?=$row2['programName']?></td> 
                                        <td align="center"><?=$currentLevel?></td> 
                                        
                                    </tr>
                        <?php
                  
                  }
                   
                    ?>    
                        
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

<!-- jQuery -->

<script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
</body>
</html>
<?php require 'modalsV/myAssignedArea.php';?>

<script>
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false
    
   
  });

  $('.n').click(function(){  
   
           var levelID = $(this).attr("id");  
           var areaID = $(this).data("area");  
           var programID = $(this).data("program");  
           var areaName = $(this).data("name");  
           var levelName = $(this).data("level");  
           var program_name = $(this).data("program_name");
           $.ajax({  
                url:'<?=base_url().'ADMS/assignModalM'?>',  
                method:"post",  
                data:{levelID:levelID,areaID:areaID,programID:programID,areaName:areaName,levelName:levelName,program_name:program_name},  
                success:function(data){  
                     $('#assignModal').html(data);  
                  
                }  
           });  
      });  
  
});

</script>