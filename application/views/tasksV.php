<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>Assign Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
     <!-- myStyle CSS-->
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/css/sb-admin.css" rel="stylesheet">
      <!-- Bootstrap core JavaScript-->
      <script src="<?=base_url()?>/vendor/jquery/jquery.min.js"></script>
      <script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                  
                      <!-- Core plugin JavaScript-->
     <script src="<?=base_url()?>/vendor/jquery-easing/jquery.easing.min.js"></script>
                  
                      <!-- Custom scripts for all pages-->
      <script src="<?=base_url()?>/js/sb-admin.min.js"></script>
      <script src="<?=base_url()?>/vendor/jquery/jquery.js"></script>
 
    
  <!--  <script src="jquery.min.js"></script>-->
  <style>
    .upload{
      background-color:darkgreen;
      color:white
    }
    .upload:hover{
      background-color: transparent;
      color: darkgreen;
      border-color: darkgreen;
    }
   
a{
        color:black;
    }
  a:hover{
      color: blue;
  }

    
  </style>
   <?php $this->load->view('headerV'); ?>
</head>
<body >

    <div id="wrapper">
    <?php $this->load->view('sidebarAdminV'); ?>

    <div id="content-wrapper">
    <div class="container-fluid">

          <ol class="breadcrumb opened mrgnTop">
            <li class="breadcrumb-item">
            <?php
            if($user->userType == 'admin'){
          ?>
              <strong style="color:blue">ADMIN</strong>
          <?php
            }else{
          ?>
              <strong style="color:blue">USER</strong>
              
          <?php    
            }
          ?>
            </li>
            <li class="breadcrumb-item active"><strong>Assign Task</strong></li>
          </ol>
          <?php 
                   if(isset($_SESSION['foldersMsg'])){
                    $message = $_SESSION['foldersMsg'];
                    echo $message;
                 }
                  ?>
      
      
        <br>
        <div class="card mb-3">
        <div class="card-header color13" >
             <strong>List Of Areas</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
      <br>
            
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13">
                            <tr>
                               <th style="text-align:center">Area Number</th>
                               <th style="text-align:left">Area Name</th>
                                <th style="text-align:center">Total Assigned Users</th>
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
    <br><br><br>
    <?php $this->load->view('footerV'); ?>    
    
    <script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- <script src="../js/demo/datatables-demo.js"></script> -->


   

 
</body>
</html>

<!-- view area task modal -->

<div id="viewTask" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header color5" >
            <h4 class="modal-title" >Area <span id="areaNum"></span> <span id="title"></span></h4>
            <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
                
            </div>
            
            <div class="modal-body cstmSky" >
                <div id="viewTaskInfo">
                                
                </div>
                
            </div>
            <div class="modal-footer cstmSky">
            <button type="button" class="btn cstm-btn-red" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>



<!-- End of view area task modal -->

<script>
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
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
        $('#area').val(areaNum);
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
    
</script>


