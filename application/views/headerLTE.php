<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV");

  $num1 = $this->ADMSM->totalNotifyM();
  $level = $this->ADMSM->showLevelsM();
  $usersID = $user->usersID;
        
?>
<html>
<link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/lte/pandangan-logo.3.png">

  <style>
  .j{
    color:rgb(3, 3, 100); 
  }
  .j:hover{
    color:blue; 
  }
  .about{
    color:rgb(3, 3, 100);
  }
  .about:hover{
    color:blue;
  }
  
</style>

</html>
<nav class="main-header navbar navbar-expand elevation-1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <button class="nav-link btn" data-widget="pushmenu" href="#"  style="color:white"><i class="fas fa-bars j"></i></button>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a class="brand-link" href="#" role="button"><img src="<?=base_url()?>/lte/logMSU.jpg" class="brand-image img-square "> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <strong  class="nav-link" style="color:rgb(3, 3, 100)">ADMS (AACCUP Instrument)</strong>
      </li>
     
    </ul>

 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
     
      <li class="nav-item dropdown">
      <button class="nav-link btn " data-toggle="dropdown" href="#" style="color:white">
          
          <span class="about"><i class="fas fa-user-circle "></i> <strong>Hi, <?=$user->Fname?></strong></span>
      </button>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
         <a href="#" class="dropdown-item text-center " data-toggle="modal" data-target="#logoutModal">Log Out</a>
         
        </div>
           
      </li>
    
    <?php if($user->userType != 'Accreditor'){

      echo '<li class="nav-item dropdown">
        <button class="nav-link btn" data-toggle="dropdown" href="#" style="color:white">
          <i class="fas fa-bell j">';
          if($num1 > 0)
            echo '<span class="badge badge-danger navbar-badge"><div id="fetch"></div></span>';

       echo '   </i>
          
        </button>
        <div class="dropdown-menu  dropdown-menu-lg dropdown-menu-right" id="fetchNotification">
          
        </div>
      </li>';
    } ?>
      <li class="nav-item">
        <button class="nav-link btn " data-widget="control-sidebar" data-slide="true" href="#"><span class="about"> <i class="fas fa-info-circle "> </i></span></button>
           
      </li>
      
    </ul>
  </nav>

<!-- Log out modal -->
<div id="logoutModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna logout?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">

                <div class="control-group">
                <form action="<?=base_url()?>ADMS/logOutM" method="post">
                   <div class="control-group">
                     <div  align="center" class="controls mb-2">                    
                          <button name="submit" type="submit" class="btn cstm-btn-navy ">Yes</button>
                         <button  type="button" class="btn cstm-btn-red " data-dismiss="modal">No</button>
                      </div>
                  </div>
                </form>
               
              </div> 
            
            </div>
        </div>
    </div>
</div>
<!-- end Log out modal -->



<!-- 
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
</div> -->


<script>
$(document).ready(function(){

  
    $(function(){ 
        setInterval(function() {
       load_notify();
       load_notification();
        },3000);
    });
   
    load_notify();
    load_notification();
    function load_notify(){
            var usersID = <?=$usersID?>;
        $.ajax({  
                url:"<?=base_url().'ADMS/fetchNotifyM'?>",  
                method:"post",   
                data:{usersID:usersID},
                success:function(data){  
                     $('#fetch').html(data); 
                     
                   
                }  
           });  
    }

    function load_notification(){
            var usersID = <?=$usersID?>;
        $.ajax({  
                url:"<?=base_url().'ADMS/fetchNotificationM'?>",  
                method:"post",  
                data:{usersID:usersID},
                success:function(data){  
                     $('#fetchNotification').html(data); 
                    
                   
                }  
           });  
    }
    
    $(document).on('click','.noteID', function(){  
           var noteID = $(this).attr("id"); 

          
           $.ajax({  
                url:"<?=base_url().'ADMS/setOpenM'?>",  
                method:"post",  
                data:{noteID:noteID},  
                success:function(data){  
                    
                  
                }  
           });  
    
      });  
      
});

</script>