<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html> 

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Upload Final Evaluation</title>
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
           
           <li class="breadcrumb-item "> <a  href="<?=base_url()?>ADMS/manageProgramsV">Programs</a></li>
                  <!-- <a href="<?=base_url()?>ADMS/ProgramsV/<?= $levelID?>/<?=$programID?>">Programs</a> -->
                  <li class="breadcrumb-item "> <a  href="<?=base_url()?>ADMS/programsV/<?=$levelID?>/<?=$programID?>"><?=$programName->programName?></a></li>
        
            <li class="breadcrumb-item activated">Upload Final Evaluation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <?php 
                  if(isset($_GET['m'])){
                     $message = $_GET['m'];
                     echo $message;
                  } 
                  ?>    
    <?php  if($user->userType == 'Accreditor'){ ?> 
        <div align="right" style="margin-bottom: 5px; margin-right: 15px;">
                <button type="button" data-toggle="modal" data-target="#uploadFile" id="<?=$programName->programName?>"  class="upload btn cstm-btn-navy">Upload File</button>
    </div>
   <?php } ?>
      <div class="card mb-3">
        <div class="card-header color13" >
             <strong>Final Evaluation Files for <?=$programName->programName?> (<?=$selectedLevel->levelName?>) </strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
      

     
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th style="text-align:left">Files</th>
                                <th >Acions</th>
                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php 
                      foreach($filesList as $row){       
                          
                    ?>       
                        
                                <tr>
                                    <td><a href="<?=base_url()?>ADMS/viewV5/<?= $levelID?>/<?=$programID?>/<?= $row->fileID?>"> <?= $row->fileName;?></a></td> 
                                    <td align="center">
                                    <div class="btn-group" align="center">
                                    <?php  if($user->userType == 'Accreditor'){ ?>

                                        <button  type="button"  name="<?=$programName->programName?>" data-file_name="<?= $row->fileName;?>" id="<?=$row->fileID?>"  data-toggle="modal" data-target="#renameFile" class="update btn cstm-btn-navy btn-sm" title="Rename File">Rename</button>
                                        <button  type="button" name="<?=$programName->programName?>" data-file_name="<?= $row->fileName;?>" id="<?=$row->fileID?>" data-toggle="modal" data-target="#deleteFile" class="delete btn cstm-btn-navy btn-sm" title="Delete File">Delete</button>
                                    <?php } ?>
                                        <a href="<?=base_url()?>/ADMS/download2?folder=<?=$programName->programName?>&file=<?=$row->fileName?>"  class="btn cstm-btn-navy btn-sm"  title="Download File" >Download</a>
                                       
                                       
                                       
                                       
                                    </div>
                                    </td>
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

<?php require 'modalsV/finalEvaluate.php';?>



<script>
$(document).ready(function(){
  $('table').DataTable({
   bPaginate: false,
   bInfo: false,
   bSort: false,
   bFilter: false
   
  });
 
  
  
    $(document).on('click','.update',function(){

        var fileID = $(this).attr("id");
        var folder = $(this).attr("name");
        var oldFileName = $(this).data("file_name");
        $('#folder_name').val(folder);
        $('#file_name').val(oldFileName);
        $('#old_name').val(oldFileName); 
        $('#file_id').val(fileID); 
    });
    $(document).on('click','.delete', function(){
        var fileID = $(this).attr("id");
        var folder = $(this).attr("name");

        $('#fileID').val(fileID);
        $('#folder').val(folder);
      

    });
    $(document).on('click','.upload', function(){
     

        var folder = $(this).attr("id");
        $('#hidden_folder_name').val(folder);
     

    });

    
    
    
    // // $('.details').click(function(){  
    // //        var id = $(this).attr("id");  
    // //        $.ajax({  
    // //             url:'<?=base_url().'ADMS/detailsM'?>',  
    // //             method:"post",  
    // //             data:{id:id},  
    // //             success:function(data){  
    // //                  $('#detailsInfo').html(data);  
                  
    // //             }  
    // //        });  
    //   });  

  //     $('#click').click(function(){
  //      if(!$('#input').val()){
  //           return;
  //       } else{
  //         $('#loader-icon').show();
  //       }
     
      
  // });
  
});

</script>

