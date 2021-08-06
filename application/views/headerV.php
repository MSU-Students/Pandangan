<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
  
  // $sql2 = "SELECT * FROM notify,notification WHERE notify.usersID = $usersID AND notify.notifyID = notification.notifyID AND notify.status = 'unopened' ORDER BY noteID DESC";
  // $con->query($sql2);
  // $res = $con->query($sql2);
	
  $num1 = $this->ADMSM->totalNotifyM();
  $usersID = $user->usersID;
if(!isset($_SESSION['usersID']))
   redirect(base_url()."ADMS/logInV");
          
?>
 
  <!-- Bootstrap core CSS-->
 
  <header >
    <nav class="navbar navbar-expand navbar-dark bg-nav static-top">
     

    <h5 class="navbar-brand mr-1 " >&nbsp;&nbsp; <strong style="font-size: 20px;font-family: Berlin Sans FB Demi"> 
     <i><img src="<?=base_url()?>msulogo.jpg" style="width:4%;height:5%;"></i> ACCREDITATION DOCUMENT MANAGEMENT SYSTEM FOR ITE</strong></h5>
      <!-- Navbar Search -->
     
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow ">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle point"> Hi, <?=$user->Fname?></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item point" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
<?php
      if($user->userType != 'Accreditor'){
       echo '<li class="nav-item dropdown no-arrow mx-1 ">
        <div id="notification">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw point">';
              
                if($num1 > 0)
                echo '<span class="badge badge-danger"   style="font-size:9px"><div id="fetch"></div></span>';
              else
                echo '<span class="badge badge-danger"   style="font-size:9px"></span>';

        echo'    </i>  
          </a>
          
          <div class="dropdown-menu dropdown-menu-right" id="fetchNotification" aria-labelledby="alertsDropdown">
           
            
          
            
            </div>
          </div>
      </li>';}?>
        
      </ul>

   </nav>

  
                
    </header>
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?=base_url()?>/ADMS/logOutM">Logout</a>
          </div>
        </div>
      </div>
    </div>
    
  



<script>
$(document).ready(function(){
  
    $(function(){
        setInterval(function() {
       load_notify();
       load_notification();
        },2000);
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
