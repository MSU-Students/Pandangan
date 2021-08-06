<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Area Folders</title>
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
            <li class="breadcrumb-item activated">Area <?= $rows['areaNum']?> <?=$rows['areaName']?></li>
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
     <button type="button" name="create_folder" id="create_folder" data-toggle="modal" data-target="#folderModal" class="btn cstm-btn-navy"> Create Label</button>
   </div>
        <div class="card mb-3">
        <div class="card-header color13" style="color: white">
             <strong>Area <?= $rows['areaNum']?> <?=$rows['areaName']?> (<?=$programName->programName?> - <?=$selectedLevel->levelName?>)</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive"> 
        <br>
            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0" >
            
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th></th>
                                <th style="text-align:left">Label</th>
                                <th >Total Sub_Label</th>
                                <th >Actions</th>
                                <!-- <th>Set Parameter</th> -->
                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                     foreach($folderList as $row2){
                    
                      ?>
                     
                     <tr data-index="<?=$row2['usersFolderID']?>" data-position="<?=$row2['num']?>">
                    
                              
                                    <td style="width:5%"><span 
                                        <?php
                                          if($row2['letter'] == '') {?>
                                            style="color:transparent"
                                            <?php
                                          }else{ ?>
                                              style="color:black"
                                           <?php   
                                          }

                                        ?>
                                    ><?=$row2['letter']?>.</span></td>
                                    
                                    <td><a href="<?=base_url()?>ADMS/tagFolderV2/<?=$levelID?>/<?= $row2['usersFolderID'] ?>/<?=$areaID?>/<?=$programID?>"><p style="white-space: pre-wrap"><?= $row2['name'] ?></p></a></td> 
                                    <td align="center"><?= $totalUserFolder[$j++]?></td> 
                                    <td class="clearfix" align="center">
                                    <div class="btn-group" align="center">
                                      <button  type="button"  name="update" id="<?= $row2['usersFolderID'] ?>" data-name="<?= $row2['name'] ?>" data-toggle="modal" data-target="#renameFolder" class="update btn cstm-btn-navy btn-sm" title="Rename">Rename</button>
                                      <button  type="button" name="delete" id="<?= $row2['usersFolderID'] ?>" data-toggle="modal" data-target="#deleteFolder" class="delete btn cstm-btn-navy btn-sm" title="Delete">Delete</button>
                                    
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
<?php require 'modalsV/tagFolder.php';?>

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
            url:"<?=base_url()?>ADMS/saveNewPositionsM",  
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
        var id = $(this).attr("id");
        $('#folderID').val(id);
      
   });
      $(document).on('click','.update',function(){
        var folder_name = $(this).data("name");   
        var usersFolderID = $(this).attr("id");  
        $('#usersFolderID').val(usersFolderID);
        $('#folder_name').val(folder_name);

      
    });
    

   


    
  
});

</script>

