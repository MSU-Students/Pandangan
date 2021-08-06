<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
  
  // $sql2 = "SELECT * FROM notify,notification WHERE notify.usersID = $usersID AND notify.notifyID = notification.notifyID AND notify.status = 'unopened' ORDER BY noteID DESC";
  // $con->query($sql2);
  // $res = $con->query($sql2);
	
  $num1 = $this->ADMSM->totalNotifyM();
 
if(!isset($_SESSION['usersID']))
   redirect(base_url()."ADMS/logInV");
          
?>
<!DOCTYPE html>
<html lang="en">

  <!-- Bootstrap core CSS-->
  
  <header style="width:100%">
    <nav class="navbar navbar-expand navbar-dark bg-nav static-top">
     

    <h5 class="navbar-brand mr-1" >&nbsp;&nbsp; <strong style="font-size: 20px;font-family:Berlin Sans FB Demi"> 
     <i><img src="<?=base_url()?>msulogo.jpg" style="width:4%;height:5%"></i> <strong > ACCREDITATION DOCUMENT MANAGEMENT SYSTEM FOR ITE</strong></strong></h5>
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
    <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                  
                      <!-- Core plugin JavaScript-->
     <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                  
                      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
      <script src="vendor/jquery/jquery.js"></script>
  
</html>
<!-- 
<script>
$(document).ready(function(){
    $(document).on('click','.noteID', function(){  
           var noteID = $(this).attr("id"); 

          
           $.ajax({  
                url:"setOpen.php",  
                method:"post",  
                data:{noteID:noteID},  
                success:function(data){  
                    
                  
                }  
           });  
    
      });  
      
      $(function(){
        setInterval(function() {
          load_notification();
          load_notify();
        
        },1500);
    });
   
    
    function load_notify(){
            var usersID = <?=$usersID?>;
        $.ajax({  
                url:"fetchNotify.php",  
                method:"post",   
                data:{usersID:usersID},
                success:function(data){  
                     $('#fetch').html(data); 
                     
                   
                }  
           });  
    }
    
    function load_notification(){
            var id = <?=$usersID?>;
        $.ajax({  
                url:"fetchNotification.php",  
                method:"post",  
                data:{id:id},
                success:function(data){  
                     $('#fetchNotification').html(data); 
                    
                   
                }  
           });  
    }

    
     
});

</script> -->
