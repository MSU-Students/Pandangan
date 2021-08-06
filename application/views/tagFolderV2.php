<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Area Subfolders</title>
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
            <li class="breadcrumb-item">
           <a href="<?=base_url()?>ADMS/myAssignedAreaV">My Assigned Area</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>ADMS/tagFolderV/<?=$levelID?>/<?=$areaID?>/<?=$programID?>"><?=$area?></a></li>
            <li class="breadcrumb-item activated"><?php  if($bread['letter'] == null) echo ''; else echo $bread['letter'].'.';?><?=$bread['name']?></li>
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
     <button type="button" name="create_folder" id="create_folder" data-toggle="modal" data-target="#folderModal" class="btn cstm-btn-navy ">Create Sub_Label</button>
   </div>
        <div class="card mb-3">
        <div class="card-header color13" style="color: white">
             <strong><?php  if($bread['letter'] == null) echo ''; else echo $bread['letter'].'.';?>  <?=$bread['name']?> (<?=$program->programName?> - <?=$selectedLevel->levelName?>)</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
        <br> 
            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th></th>
                                <th style="text-align:left">Sub_Label</th>
                                <th >Total Files</th>
                                <th >Actions</th>
                               
                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                   
                     foreach($subFolderList as $row2){
                      
                      ?>
                     
                     <tr data-index="<?=$row2['subID']?>" data-position="<?=$row2['folderNum']?>">
                                
                                    <td style="width:5%"><span 
                                        <?php
                                          if($row2['folderNum'] == 500) { ?>
                                            style="color:transparent"
                                            <?php
                                          }else{?>
                                              style="color:black"
                                           <?php   
                                          }

                                        ?>
                                    ><?=$bread['letter']?>.<?=$row2['folderNum']?></span></td>
                                    
                                    <td><a href="<?=base_url()?>ADMS/insideSubfolderV/<?=$levelID?>/<?=$row2['subID']?>/<?=$row2['folderNum']?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$programID?>"><?= $row2['subName'] ?></a></td> 
                                    <td align="center"><?= $totalFiles[$j++]?></td> 
                                    <td align="center">
                                    <div class="btn-group" >
                                    <button  type="button"  name="update" id="<?=$row2['subID']?>" data-name="<?= $row2['subName'] ?>" data-toggle="modal" data-target="#renameFolder" class="update btn cstm-btn-navy btn-sm" title="Rename">Rename</button>
                                    <button  type="button" name="delete" id="<?=$row2['subID']?>" data-toggle="modal" data-target="#deleteFolder" class="delete btn cstm-btn-navy btn-sm" title="Delete">Delete</button>
                                    
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
<script src="<?=base_url()?>/css/jquery-ui.min.js"></script>

</body>
</html>

<?php require 'modalsV/tagFolder2.php';?>

<script>
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false,
   bSort: false
   
  });

  $('table tbody').sortable({
      update: function (event, ui) {
          $(this).children().each(function (index) {
            //  console.log(index);
            if($(this).attr('data-position') != (index+1)){
                $(this).attr('data-position',(index+1)).addClass('changed');

            }


          });
          saveNewPositions();
      

          
      }
     
  });

  function saveNewPositions(){
      var positions = [];
      $('.changed').each(function () {
          positions.push([$(this).attr('data-index'),$(this).attr('data-position')]);
          $(this).removeClass('changed');
      });

      $.ajax({
            url:"<?=base_url()?>ADMS/saveNewPositionsM2",  
            method: 'POST',
            data:{
                update: 1,
                positions:positions

            },success: function (response){
                console.log(response);  
                location.reload();
            },
            error: function (){
                alert('ERROR');
            }
      });
      
  }
  

  $(document).on('click','.delete', function(){
        var subID = $(this).attr("id");
        $('#folderID').val(subID);
      
      });
      $(document).on('click','.update',function(){
        var folder_name = $(this).data("name");   
        var subID = $(this).attr("id");   
        $('#folder_name').val(folder_name);
        $('#subID').val(subID);

      
    });
  
  
});

</script>



