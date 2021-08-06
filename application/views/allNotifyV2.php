<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Notifications</title>
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
              <li class="breadcrumb-item activated">Notifications</li>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
    <?php 
                  if(isset($_GET['m'])){
                     $message = $_GET['m'];
                     echo $message;
                  }
  ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid card row">
        <div align="center" class="mb-3 mt-3 btn-group">
          <td>
                    <a href="<?=base_url()?>/ADMS/markAllM" class="btn cstm-btn-navy">Mark All As Opened</a></span>
                    <button type="button" data-toggle="modal" data-target="#deleteNotify" class=" btn cstm-btn-red ">Clear All Notifications</button></span>
                    </td>
                  </div>
        <?php
            $assignedArea = base_url()."ADMS/myAssignedAreaV";
            $link = base_url()."ADMS/foldersV";
        
            foreach($row1 as $row2){

                $fileID = $row2['fileID'];
                $noteID = $row2['noteID'];
                $IDuser = $row2['user'];
                $title =  $row2['title'];
              
                $sql6 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $IDuser))->get()->row();
                $person = $sql6->Fname.' '.$sql6->Lname;
                
                if($row2['status'] == 'unopened'){
                  if($row2['category'] == 'upload'){

                      $sql4 = $this->db->select('path,fileName,uploader,status')->from('files')->where(array('id'=> $fileID))->get()->row();
                      $location = $sql4->path;
                      $user = $sql4->uploader;
                      $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                      $sql5 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $user))->get()->row();
                      $uploader = $sql5->Fname.' '.$sql5->Lname;
                      if($sql4->status == 'archived')
                            continue;
                      else{
                          echo '
                          <div class="alert-primary"><a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong >'.$uploader.'</strong>  uploaded a file in<br> folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                          ';
                  }
                  }elseif($row2['category'] == 'assign'){
                          echo '
                          <div class="alert-primary col-md-12" ><a  data-toggle="modal" data-target="#myAssignedArea" class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="#"> The Admin assigned <strong>you</strong> to <br> Area <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                          ';
                      
                  }elseif($row2['category'] == 'comment'){
                    $sql4 = $this->db->select('path,fileName,uploader')->from('files')->where(array('id'=> $fileID))->get()->row();
                    $location = $sql4->path;
                    $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                  
                    
                    echo '<div class="alert-primary"><a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"> <strong>'.$person.'</strong>  commented on a file from <br>folder  <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                    ';
                  }elseif($row2['category'] == 'deleteAll'){
                          echo '
                          <div class="alert-primary"><a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted Folder<br> <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                          ';
                 }else{
                          echo '
                          <div class="alert-primary"><a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted a file from <br>Folder <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                          ';
                  }
                
          }
          else{
            if($row2['category'] == 'upload'){
              
                        $sql4 = $this->db->select('path,fileName,uploader,status')->from('files')->where(array('id'=> $fileID))->get()->row();
                        $location = $sql4->path;
                        $user = $sql4->uploader;
                        $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                        $sql5 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $user))->get()->row();
                        $uploader = $sql5->Fname.' '.$sql5->Lname;
                        if($sql4->status == 'archived')
                        continue;
                  else{

                        echo '
                        <a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong >'.$uploader.'</strong>  uploaded a file in<br> folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a><div class="dropdown-divider "></div>
                        ';
                  }
            }elseif($row2['category'] == 'assign'){
                 
              echo '
              <a  data-toggle="modal" data-target="#myAssignedArea" class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="#"> The Admin assigned <strong>you</strong> to <br> Area <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a><div class="dropdown-divider "></div>
              ';
            }elseif($row2['category'] == 'comment'){
              
              $sql4 = $this->db->select('path,fileName,uploader')->from('files')->where(array('id'=> $fileID))->get()->row();
              $location = $sql4->path;
              $view = base_url()."ADMS/viewV/$fileID?folder=$location";
              $sql6 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $IDuser))->get()->row();
              $person = $sql6->Fname.' '.$sql6->Lname;
              
              echo '<a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong>'.$person.'</strong>  commented on a file from <br>folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                          ';
            }elseif($row2['category'] == 'deleteAll'){
                  echo '
                  <a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted Folder<br> <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                  ';
           }else{
                        echo '
                        <a class="noteID notify2 dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted a file from <br>Folder <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                        ';
                }
           
                } 
         }

          

      ?>

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



<style>
.tempHover:hover{
    background-color: white;
    color:navy;
}
</style>

<!--delete task Modal-->
<div id="deleteNotify" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this task?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body color6">
            <form method="post" action="<?=base_url()?>/ADMS/deleteNotifyM">
               
                <div class="control-group">
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy tempHover">Yes</button>
                      <button  type="button" class="btn cstm-btn-red tempHover" data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            
            </div>
        </div>
    </div>
</div>
<!--End of delete task Modal-->

<div id="myAssignedArea" class="modal  fade" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h3 class="modal-title"><span id="change_title">My Assigned Area</span></h3>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <h4>Please select a level:</h4>
              <?php
                    if($level ){
                      foreach($level as $row){
                          echo '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="'.base_url().'ADMS/myAssignedAreaV/'.$row->levelID.'"  class="btn cstm-btn-navy btn-block"><strong>'.$row->levelName.'</strong></a></li>';
                      } 
                  }else{
                    echo '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="#" class="btn btn-block"><strong>Sorry, there is no program to show.</strong></a></li>';
                  }
              ?>
              
                  
                 
            </div>
            
        </div>
    </div>
</div>