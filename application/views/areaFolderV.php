<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title><?=$rows['name']?></title>
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
<body style="background-color:powderblue">

    <div id="wrapper">
    <?php $this->load->view('sideBarAccreditor'); ?>
    
    <div id="content-wrapper">
    <div class="container-fluid">
    <ol class="breadcrumb mrgnTop">
           
            <li class="breadcrumb-item activated"><strong>Area <?=$rows2['id']?> <?=$rows2['areaName']?> / <?=$rows['letter']?>. <?=$rows['name']?> </strong></li>
          </ol>
          
          <div style="margin-bottom: 10px">
          <a  href="<?=base_url()?>ADMS/insideAreaV/<?=$areaNum?>/<?=$usersFolderID?>" class="btn cstm-btn-red" ><i class="fa fa-arrow-left"></i> Back</a>
          
            
        </div>
        
        <div class="card mb-3">
        <div class="card-header color13" style="color: white">
             <strong> <?=$rows['letter']?>. <?=$rows['name']?></strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
        
            <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13" style="text-align: center">
                            <tr>
                                <th></th>
                                <th style="text-align:left"><i class="fas fa-fw fa-folder"></i> Folder Name</th>
                                <th >Total Files</th>
                                
                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                     
                      
                     foreach($row as $row2){
                    
                      ?>
                     
                                <tr>
                                    <td style="width:5%"><span 
                                        <?php
                                          if($row2['folderNum'] == 500){?>
                                            style="color:transparent"
                                            <?php
                                          }else{?>
                                              style="color:black"
                                           <?php   
                                          }

                                        ?>
                                    ><?=$rows['letter']?>.<?=$row2['folderNum']?></span></td>
                                    
                                    <td><a href="<?=base_url()?>ADMS/insideAreaFolderV/<?=$areaNum?>/<?=$usersFolderID?>/<?=$row2['folderNum']?>/<?=$row2['subID']?>?name=<?=$row2['subName']?>"><?= $row2['subName'] ?></a></td> 
                                    <td align="center"><?= $totalFiles[$i++]?></td> 
                                    
                                   
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
    <?php $this->load->view('footerV'); ?>    
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>
 
</body>
</html>
