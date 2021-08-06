<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>Areas</title>
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
    <?php $this->load->view('sideBarAccreditor'); ?>

    <div id="content-wrapper">
    <div class="container-fluid">

          <ol class="breadcrumb opened mrgnTop">
           
            <li class="breadcrumb-item activated"><strong>Areas</strong></li>
          </ol>
          
      
      
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
                              <th></th>
                               <th style="text-align:center"></th>
                               <th style="text-align:left" >Areas</th>
                                <th style="text-align:center">Total Folders</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                  
                      foreach($rows as $row){ 
                        
                    ?>       
                        
                                <tr>
                                    <td width="2%">Area</td>
                                    <td align="center" width="2%"><?= $row['areaNum'] ?></td> 
                                    <td>  <a href="<?=base_url()?>ADMS/insideAreaV/<?= $row['id']?>"  ><?= $row['areaName'] ?></a>
                                    </td> 
                                    <td align="center"><?=$overAllFolder[$i++]?></td>
                                   
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


<script>
$(document).ready(function(){
  $('table').DataTable({
  bFilter: false,
   bPaginate: false,
   bInfo: false,
   bSort: false
   
   
  });
    
 
});
</script>