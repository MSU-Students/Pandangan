<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Account Setting</title>
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
            
            <li class="breadcrumb-item activated">Account Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
    
     <!-- <div align="right" style="margin-bottom: 5px; margin-right: 15px;">
            <button type="button" data-toggle="modal" data-target="#uploadFile" id="<?=$folder?>" class="upload btn cstm-btn-navy">Upload File</button>
   </div> -->
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
      <div class="card-body" >
                    
                    <div class="card" style="border-color:transparent" >
                        <div class="card-header text-light color13" style="font-size: 20px;text-align:center"><strong>EDIT ACCOUNT</strong></div>
                        <div class="card-body "  >
                        <div class="container">
                        
                          
                            <form  method="POST" action="<?=base_url()?>/ADMS/editAccountM">
                          
                                  <div class="form-group">
                                    <label><strong>First Name:</strong></label>
                                    <div >
                                        <input style="width:85%" name="Fname"  type="text" value="<?= $user->Fname ?>"  class="form-control" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label ><strong>Middle Name:</strong></label>
                                    <div >
                                        <input style="width:85%" name="Mname" type="text" value="<?= $user->Mname ?>" class="form-control"  required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label><strong>Last Name:</strong></label>
                                    <div>
                                        <input style="width:85%" name="Lname" type="text"  value="<?= $user->Lname ?>" class="form-control"  required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label><strong>Username:</strong></label>
                                    <div>
                                        <input style="width:85%" name="username" value="<?= $user->username ?>" type="text" class="form-control"  required>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label><strong>Password:</strong></label>
                                    <div>
                                        <input style="width:85%" name="password" type="password"  class="form-control"  required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label><strong>Confrim Password:</strong></label>
                                    <div>
                                        <input style="width:85%" name="confirmPassword" type="password"  class="form-control"  required>
                                    </div>
                                  </div>
                                  
                                  <br>
                                <div>
                                   <button name="submit" type="submit" class="btn btn-md  cstm-btn-navy  btn-block">Save Changes</button>
                                </div>
                                
                            </form>
                            
                            
                            <br><br>
                             
                            
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
  $('.view').click(function(){ 
  
           var fileName = $(this).attr("name");  
           var fileID = $(this).attr("id");  
           var folder = $(this).data("folder_name");  
           $.ajax({  
                url:'<?=base_url().'ADMS/viewM'?>',  
                method:"post",  
                data:{fileName:fileName,folder:folder,fileID,fileID},  
                success:function(data){  
                     $('#viewInfo').html(data);  
                  
                }  
           });  
      });  
      
  
  
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
  
});

</script>

