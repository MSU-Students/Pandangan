<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Assign Task</title>
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
            
            <?php
            if($user->userType == 'Admin')
               echo '<li class="breadcrumb-item activated">Assign Task</li>';
            else
               echo '<li class="breadcrumb-item activated">View Tasks</li>';

            ?> 
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
        <div class="card-header color13" >
             <strong>List Of Areas</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
    
            
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13">
                            <tr>
                               <th style="text-align:center">Area Number</th>
                               <th style="text-align:left">Area Name</th>
                                <th style="text-align:center">Total Assigned Users</th>
                                <?php
                                if($user->userType == 'Admin')
                                    echo '<th style="text-align:center">Acion</th>'; 
                                ?>
                            </tr>
                    </thead>
                    <tbody> 
                    <?php
                  
                      foreach($rows as $row){ 
                        
                    ?>       
                        
                                <tr>
                                    <td align="center"><?= $row['areaNum'] ?></td> 
                                    <td>  <a href="#" id="<?= $row['id']?>" name="<?=$row['areaName']?>" class="viewAssignedUser" data-toggle="modal" data-target="#viewTask"><?= $row['areaName'] ?></a>
                                    </td> 
                                    <td align="center"><?=$totalAssign[$i++]?></td>
                                    <?php
                                    if($user->userType == 'Admin'){
                                        echo '<td align="center">
                                        <div class="btn-group">
                                           <button  type="button" id="'.$row['id'].'" name="'.$row['areaName'].'" data-toggle="modal"'; 

                                          
                                            if($checkProgram == 0) 
                                              echo 'data-target="#empty"';
                                            else
                                              echo 'data-target="#task"';
                                         
                                      
                                          echo 'class="task btn cstm-btn-navy btn-sm">Assign Task</button>
                                        </div>
                                        </td>';
                                     } ?>
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

<?php require 'modalsV/assignTask.php';?>





<script>
$(document).ready(function(){
  $('table').DataTable({
  // bFilter: false,
   bPaginate: false,
   bInfo: false
   
   
  });
  
     
    $(document).on('click','.task', function(){
        var area = $(this).attr("id");
        $('#area').val(area);
       
      });
      $(document).on('click','.viewAssignedUser', function(){
        var title = $(this).attr("name");
        var areaNum = $(this).attr("id"); 
        $('#title').text(title);
        $('#areaNum').text(areaNum);
        // $('#area').val(areaNum);
        $.ajax({  
                url:'<?=base_url().'ADMS/showAssignedUsersM'?>',  
                method:"post",  
                data:{areaNum:areaNum},  
                success:function(data){  
                     $('#viewTaskInfo').html(data);  
                    // $('#details').modal("show");
                     console.log(data);
                }  
           }); 

      });
      $(document).on('click','.delete', function(){
        var assigntaskID = $(this).attr("id");
        $('#assigntaskID').val(assigntaskID);
       
      });
   
    

  //     $('#click').click(function(){
  //      if(!$('#input').val() || !$('#input1').val()){
  //           return;
  //       } else{
  //         $('#loader-icon').show();
  //       }
     
      
  // });

});

</script>