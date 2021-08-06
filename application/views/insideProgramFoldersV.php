<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en"> 
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
 
  <title>Inside Program Folders</title>
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
         
           <li class="breadcrumb-item "> <a  href="<?=base_url()?>ADMS/manageProgramsV">Programs</a></li>
           <li class="breadcrumb-item "> <a  href="<?=base_url()?>ADMS/programsV/<?=$levelID?>/<?=$programID?>"><?=$programName->programName?></a></li>
           <li class="breadcrumb-item "><a href="<?=base_url()?>ADMS/insideProgramsV/<?=$levelID?>/<?= $areaNum?>/<?=$programID?>">Area <?= $areaNum?>  - <?=$rows2['areaName']?></a></li>
           <li class="breadcrumb-item "><a href="<?=base_url()?>ADMS/programFoldersV/<?=$levelID?>/<?= $areaID?>/<?= $usersFolderID?>/<?=$programID?>"><?=$rows['letter']?>. <?=$rows['name']?> </a></li>
           <li class="breadcrumb-item activated"><?=$subFolder->letter?>.<?=$subFolder->folderNum?> &nbsp; <?=$subFolder->subName?> </li>
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
        <div class="card mb-3">
        <div class="card-header color13">
             <strong> <?=$subFolder->letter?>.<?=$subFolder->folderNum?> &nbsp; <?=$subFolder->subName?>  (<?=$programName->programName?> - <?=$selectedLevel->levelName?>)</strong>
         </div>
         <div class="card-body" >
        <div class="table-responsive">
    
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" >
                    <thead class="color13 text-light" style="text-align: center">
                            <tr>
                               <th></th>
                                <th style="text-align:left"><i class="fas fa-fw fa-file"></i> File Name</th>
                                <?php
                                if($user->userType != 'Accreditor')
                                  echo '<th>Action</th>';
                                ?>

                               
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach($tagFilesList as $row){ 
                        
                    ?>       
                        
                                <tr>
                                <td style="width:5%"><span 
                                        <?php
                                          if($row['tagNum'] == 500){?>
                                            style="color:transparent"
                                            <?php
                                          }else{?>
                                              style="color:black"
                                           <?php   
                                          }

                                        ?>
                                    ><?=$row['tagNum']?>.</span></td>
                                 
                                              <td><a href="<?=base_url()?>ADMS/viewV3/<?=$levelID?>/<?= $row['fileID'] ?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>"><?= $row['fileName'] ?></a></td> 

                                    
                                    <?php 
                                      if($user->userType != 'Accreditor'){ ?>
                                        <td align="center">
                                              <button  type="button" name="tag" id="<?=$row['tagID']?>"  data-toggle="modal" 
                                              <?php
                                          if($checkLevel == 0)
                                              echo 'data-target="#empty"';
                                          elseif($checkTask == 0 )
                                            echo 'data-target="#empty2"';
                                          else
                                            echo 'data-target="#tagFile"';
                                        
                                        ?>
                                            
                                            class="tag btn cstm-btn-navy btn-sm" title="Tag File">Tag</button>
                                        </td>
                                    <?php  } ?>
                                   
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
<?php require 'modalsV/insideProgramFolders.php';?>

<script>
$(document).ready(function(){
  $('table').DataTable({
  
   bPaginate: false,
   bInfo: false,
   bSort: false
   
   
  });

  $(document).on('click','.tag', function(){
        var tagID = $(this).attr("id");
        
        $('#tagID').val(tagID);
    
      });
    
 
});
</script>