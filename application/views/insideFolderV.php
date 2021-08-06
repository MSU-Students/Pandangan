<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html> 

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Inside Folder</title>
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
            <li class="breadcrumb-item ">
                  <a href="<?=base_url()?>/ADMS/foldersV">Folders</a>
            </li>
            <li class="breadcrumb-item activated"><?=$folder?></li>
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
     <div align="right" style="margin-bottom: 5px; margin-right: 15px;">
            <button type="button" data-toggle="modal" data-target="#uploadFile" id="<?=$folder?>" class="upload btn cstm-btn-navy">Upload File</button>
   </div>
      <div class="card mb-3">
        <div class="card-header color13" >
             <strong><?=$folder?></strong>
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
                                    <td><a href="<?=base_url()?>/ADMS/viewV/<?=$row->id?>?folder=<?= $folder?>"title="View File"> <?= $row->fileName;?></a></td> 
                                    <td align="center">
                                    <div class="btn-group" align="center">
                                        <button  type="button"  name="update" data-folder_name="<?= $folder?>" data-file_name="<?= $row->fileName?>" data-toggle="modal" data-target="#renameFile" class="update btn cstm-btn-navy btn-sm" title="Rename File">Rename</button>
                                       
                                        <button  type="button" name="delete"  id="<?=$row->id?>" data-toggle="modal" data-target="#deleteFile" class="delete btn cstm-btn-navy btn-sm" title="Delete File">Delete</button>
                                      
                                        <a href="<?=base_url()?>/ADMS/download?folder=<?=$folder?>&file=<?=$row->fileName?>"  class="btn cstm-btn-navy btn-sm"  title="Download File" >Download</a>
                                       
                                        <button  type="button" name="tag" id="<?=$row->id?>" data-folder_name="<?= $folder?>"  data-toggle="modal" 
                                        <?php
                                          if($checkLevel == 0)
                                              echo ' data-target="#empty"';
                                          elseif($checkTask == 0 )
                                            echo ' data-target="#empty2"';
                                          else
                                            echo ' data-target="#tagFile"'; 
                                        
                                        ?>
                                        
                                         
                                          class="tag btn cstm-btn-navy btn-sm" title="Tag File">Tag</button>
                                       
                                        <button  type="button" id="<?= $row->id?>" name="details"   data-toggle="modal" data-target="#details" class="details btn cstm-btn-navy btn-sm" title="Details" >Details</button>
                                       <?php
                                            
                                            if($user->userType === 'Admin'){
                                            ?>
                                                  <button  type="button" data-folder_name="<?= $folder?>"  data-file_name="<?= $row->fileName?>" data-toggle="modal" data-target="#archive" class="archive btn cstm-btn-navy btn-sm" title="Archive">Archive</button>
                                             <?php
                                            }
                                    ?>
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

<?php require 'modalsV/insideFolder.php';?>



<script>
$(document).ready(function(){
  $('table').DataTable({
   bPaginate: false,
   bInfo: false,
   bSort: false
   
  });
  
  $(document).on('click','.archive', function(){
        var name = $(this).data("file_name");
        var folder = $(this).data("folder_name");
        $('#fileName').val(name);
        $('#folderName').val(folder);
      
    });
  // $('.view').click(function(){ 
  
  //          var fileName = $(this).attr("name");  
  //          var fileID = $(this).attr("id");  
  //          var folder = $(this).data("folder_name");  
  //          $.ajax({  
  //               url:'<?=base_url().'ADMS/viewM'?>',  
  //               method:"post",  
  //               data:{fileName:fileName,folder:folder,fileID,fileID},  
  //               success:function(data){  
  //                    $('#viewInfo').html(data);  
                  
  //               }  
  //          });  
  //     });  
      
  
  
    $(document).on('click','.update',function(){

        var folder_name = $(this).data("folder_name"); 
        var old_file_name = $(this).data("file_name");
        $('#folder_name').val(folder_name);
        $('#old_name').val(old_file_name); 
        $('#file_name').val(old_file_name);
        $('#action').val("change");
    });
    $(document).on('click','.delete', function(){
        var fileID = $(this).attr("id");

        $('#fileID').val(fileID);
      

    });
    $(document).on('click','.upload', function(){
     

        var folder = $(this).attr("id");
        $('#hidden_folder_name').val(folder);
        $('#check').val("true");
      

    });

    
    $(document).on('click','.tag', function(){
        var folder = $(this).data("folder_name");
        var id = $(this).attr("id");
        $('#folder-name').val(folder);
        $('#sourcePath').val(id);
    
      });
    
    $('.details').click(function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:'<?=base_url().'ADMS/detailsM'?>',  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                     $('#detailsInfo').html(data);  
                  
                }  
           });  
      });  

      $('#click').click(function(){
       if(!$('#input').val()){
            return;
        } else{
          $('#loader-icon').show();
        }
     
      
  });

  $('#click2').click(function(){
       if(!$('#file_name').val()){
            return;
        } else{
          $('#loader-icon2').show();
        }
     
      
  });
  $('#click3').click(function(){
      
          $('#loader-icon3').show();
     
  });
  
});

</script>

