<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Archive</title>
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
            
            <li class="breadcrumb-item activated">Archive</li>
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
      <div class="card mb-3">
        <div class="card-header color13">
             <strong>Archive List Of Files</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
      
            <table class="table table-striped table1" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th style="text-align:left">File Name</th>
                                <th >Acions</th>
                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                       
                      foreach($rows as $row){ 
                        $id = $row['id'];
                        
                  
                    ?>       
                        
                                <tr>
                                    <td> <a href="<?=base_url()?>/ADMS/viewV4/<?=$id?>" title="View File" ><?= $row['fileName'] ?></a></td> 
                                    <td align="center">
                                       
                                       <div class="btn-group">
                                        <button  type="button" name="restore"  id="<?=$id?>" data-toggle="modal" data-target="#restore" class="restore btn cstm-btn-navy btn-sm" title="Restore">Restore</button>
                                        <button  type="button" name="delete"  id="<?=$id?>" data-toggle="modal" data-target="#deleteFile" class="delete btn cstm-btn-navy btn-sm" title="Delete File">Delete</button>
                                        <a href="<?=base_url()?>/ADMS/download?folder=<?=$row['path']?>&file=<?=$row['fileName']?>"  class="btn cstm-btn-navy btn-sm"  title="Download File" >Download</a>
                                
                                       
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


<script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
</body>
</html>

<!--delete file Modal-->
<div id="deleteFile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this file?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>ADMS/deleteFileInArchiveM">
                 <input type="hidden" name="id" id="id">
                 
                <div class="control-group">
                 <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy ">Yes</button>
                      <button  type="button" class="btn cstm-btn-red " data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!--End of delete Modal-->

<!--restore file Modal-->
<div id="restore" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header">
            <h4 class="modal-title"><span>Select which folder you want to restore this file</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/restoreM">
            
            <div class="table-responsive">
            <?php
            chdir("uploads");
            $folder = array_filter(glob('*'),'is_dir');
        ?>
            <table class="table table-striped table2"   width="100%" cellspacing="0" >
                <thead class="cstm-modal-header">
                        <tr>
                            <th style="text-align:center">Folders</th>
                           
                        </tr>
                </thead>
                <tbody style="background-color:white">
              
                <?php
                    if(count($folder) > 0){
                        foreach($folder as $name){
                            
                            if($name === 'Archive' || $name == 'errors' || $name == 'modalsV' )
                                continue;
                            else{ 
                            
                    ?>       
                                <tr>
                                    <td><input type="radio"  name="folder" value="<?= $name ?>" required> <?= $name ?></td>
                                 
                                </tr>

                    <?php
                         
                        }
                      
                      } 
                    } 
                    
                   ?>
           </tbody>
           </table>
            </div>
             <input type="hidden" name="file" id="file">
            
            <div class="control-group">
            <br>
            <div align="center" class="controls">                    
                  <button name="submit" type="submit" class="btn cstm-btn-navy">Restore</button>
                  <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">Cancel</button>
              </div>
          </div>
        </form>
                  <br>

            
            </div>
            
            
                   
        </div>
    </div>
</div>
<!--End of restore Modal-->




<script>
$(document).ready(function(){
  $('.table1').DataTable({
  
   bPaginate: false,
   bInfo: false,
   bSort: false
   
  });
  $('.table2').DataTable({
  bFilter: false,
  bPaginate: false,
  bInfo: false,
  bSort: false
  
 });

    $(document).on('click','.delete', function(){
        var id = $(this).attr("id");
        $('#id').val(id);
    });
    $(document).on('click','.restore', function(){
        var id = $(this).attr("id");
        $('#file').val(id);
    });
    
});

</script>
