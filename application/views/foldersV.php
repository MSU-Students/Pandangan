<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Folders</title>
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
    td{
        text-align: center; 
        
    }
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
              <li class="breadcrumb-item activated">Folders</li>
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
            <button type="button" name="create_folder" id="create_folder" data-toggle="modal" data-target="#folderModal" class="btn cstm-btn-navy">Create Folder</button>
        </div>
      <div class="card mb-3">
        <div class="card-header color13"  >
             <strong>List Of Folders</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive" >
        
        <?php
            chdir("uploads");
            $folder = array_filter(glob('*'),'is_dir');
        ?>
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            
                                <th>Folder Name</th>
                                <th >Total Files</th>
                                <th >Actions</th>
                                
                            
                    </thead>
                    <tbody>
                    <?php
                    if(count($folder) > 0){
                        foreach($folder as $name){
                            
                            if($name === 'Archive' || $name == 'errors' || $name == 'modalsV' || $name == 'slider' )
                                continue;
                            else{
                            
                    ?>       
                                <tr>
                                    <td> <a href="<?=base_url()?>/ADMS/insideFolderV?folder=<?=$name?>" title="Open Folder"><?= $name ?></a></td>
                                    <td width="12%"><?=(count(scandir($name))-2)?></td>
                                    <td class=" clearfix" >
                                        <div class="btn-group" align="center">
                                        <button  type="button"  name="update" data-name="<?= $name ?>" data-toggle="modal" data-target="#renameFolder" class="update btn cstm-btn-navy btn-sm" title="Rename">Rename</button>
                                        <button  type="button" name="delete" data-name="<?= $name ?>" data-toggle="modal" data-target="#deleteFolder" class="delete btn cstm-btn-navy btn-sm" title="Delete">Delete</button>
                                        <button  type="button" name="upload" data-name="<?= $name ?>" data-toggle="modal" data-target="#uploadFile" class="upload btn cstm-btn-navy btn-sm" title="Upload">Upload</button>
                                        <!-- <a href="insideFolder.php?name=<?= $name?>" class="btn cstm-btn-navy btn-sm" title="Open Folder">Open</a> -->
                                        <?php
                                          
                                            if($user->userType === 'Admin'){
                                            ?>
                                                <button  type="button"  name="archive" data-file_name="<?= $name ?>" data-toggle="modal" data-target="#archiveFolder" class="archive btn cstm-btn-navy  btn-sm" title="Archive">Archive</button>
                                        <?php
                                            } 
                                        ?>
                                        </div>
                                    </td>
                                    
                                </tr>

                    <?php
                         
                        }
                      
                      } 
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
<?php require 'modalsV/folders.php';?>

<script>
$(document).ready(function(){
  
    $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false
  
   
  });
    $(document).on('click','.update',function(){
        var folder_name = $(this).data("name"); 
        $('#old_name').val(folder_name);
        $('#folder_name').val(folder_name);
        $('#action').val("change");
    });
    $(document).on('click','.upload',function(){
        var folder_name = $(this).data("name");
        $('#hidden_folder_name').val(folder_name);
        $('#check').val("false");


    });
    $(document).on('click','.delete', function(){
        var name = $(this).data("name");
        $('#name').val(name);
      

    });
    $(document).on('click','.archive', function(){
        var file_name = $(this).data("file_name");
        $('#file_name').val(file_name);
      

    });
    $('#click').click(function(){
    if(!$('#input').val()){
            return;
        } else{
          $('#loader-icon').show();
        }
  
  });
  $('#click2').click(function(){
    
          $('#loader-icon2').show();
      
  
  });
  $('#click3').click(function(){
    if(!$('#folder_name').val()){
            return;
        } else{
          $('#loader-icon3').show();
        }
  


});
$('#click4').click(function(){
    
  if(!$('#folderName').val()){
            return;
        } else{
          $('#loader-icon4').show();
        }
  


});
$('#click5').click(function(){
    
    $('#loader-icon5').show();


});
  
});

</script>
