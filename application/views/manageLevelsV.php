<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Manage Levels</title>
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
               <li class="breadcrumb-item activated">Manage Level</li>
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
            <button type="button" data-toggle="modal" data-target="#addLevel" class="addLevel btn cstm-btn-navy">Add a Level</button>
   </div>
        <div class="card mb-3">
        <div class="card-header color13" style="color: white">
             <strong>Levels</strong>
         </div>
        
         <div class="card-body" >
        <div class="table-responsive">
       <br>
           
            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                               
                                <th style="text-align:left">Levels</th>
                                <th>Actions</th>
                                
                               
                            </tr> 
                    </thead>
                    <tbody> 
                    <?php 
                     
                     foreach($showLevels as $level){
                     
                    ?>       
                                <tr data-index="<?=$level->levelID?>" data-position="<?=$level->num?>">
                                   <td><?=$level->levelName?></td>
                                   <td align="center">
                                      <div class="btn-group">
                                          <button  type="button" id="<?=$level->levelID?>" data-toggle="modal" data-target="#deleteLevel" class="delete btn cstm-btn-navy btn-sm" title="delete">Delete</button>
                                          <button  type="button" name="<?=$level->levelName?>" id="<?=$level->levelID?>" data-toggle="modal" data-target="#renameLevel" class="rename btn cstm-btn-navy btn-sm" title="rename">Reaname</button>
                                      </div>
                                   </td>
                                    
                                </>
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
<?php require 'modalsV/manageLevel.php';?>

<script> 
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false,
   bSort: false
   
   
  });

  $(document).on('click','.delete', function(){
        var levelID = $(this).attr("id");
        $('#levelID').val(levelID);
  }); 

    $(document).on('click','.rename',function(){
        var levelName = $(this).attr("name");   
        var levelID = $(this).attr("id");  
        $('#IDlevel').val(levelID);
        $('#levelName').val(levelName);

      
    });

  //   $('#click').click(function(){
  //      if(!$('#input').val()){
  //           return;
  //       } else{
  //         $('#loader-icon').show();
  //       }
     
      
  // });
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
            url:"<?=base_url()?>ADMS/saveNewPositionsM5",  
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
  
});

</script>