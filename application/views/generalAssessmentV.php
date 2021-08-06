<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
 
  <title>General Assessment</title>
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
a:hover{
color:grey;
text-decoration: underline;
}
.info-div {
  position: relative;
  z-index: 10;
  height: 100vh;
  overflow-y: scroll;
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
  <div class="content-wrapper"  style="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          <div class="col colorCrumb elevation-1">
            <ol class="breadcrumb float-sm-left mb-2 mt-2 ml-2 ">
                <li class="breadcrumb-item activated">General Assessment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
   
  
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" >
        <div class="container-fluid">
              <div class="container-fluid " ><br>
                              <div class="row justify-content-center "  >
                                  <div class="col elevation-2 " style="border-top-left-radius:5px;border-top-right-radius:5px;background-color:white">
                                  <?php  if($user->userType == 'Accreditor'){ ?>
                                       <div class="card-header cstm-modal-header text-center"> <strong class=" p-2 text-light" style="font-family:Arial">Make General Assessment</strong></div>
                                       
                                        <form method="POST"  id="form" class="p-2 frame">
                                            <div class="form-group">
                                                <textarea name="assessment" id="assessment"  class="form-control rounded-4" style="white-space: pre-wrap" placeholder="Write Your Assessment Here" required></textarea>
                                                <input type="hidden" name="fileID" id="fileID">
                                            </div>
                                            
                                            <div class="form-group clearfix">
                                                  <span class="float-right"><button type="submit" name="submit" data-name="post"  class="submit btn cstm-btn-navy rounded-4" value="Post">Post Assessment</button></span>                                    
                                            </div>
                                            
                                           </form>
                                       <?php }else{ ?>
                                        <div class="card-header cstm-modal-header text-center"> <strong class=" p-2 text-light" style="font-family:Arial">Accreditor's General Assessment</strong></div>

                                     <?php  } ?>
                                           <div class="col-md-12  bg-light  text-dark" id="fetchData" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px" >                            
                                         </div>
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



</body>
</html>

<?php require 'modalsV/generalAssessment.php';?>
 
  
<script>
$(document).ready(function(){
    $(document).on('click','.edit', function(){  
           var assessID = $(this).attr("id"); 
           var comment = $(this).attr("name"); 
           $('#assessID').val(assessID);
           $.ajax({  
                url:"<?=base_url().'ADMS/editAssessGenModalM'?>",  
                method:"post",  
                data:{assessID:assessID},  
                success:function(data){  
                     $('#assessEdit').html(data);  
                    
                     
                }  
           }); 

          

    });  

    $(document).on('click','.edit2', function(){  

    var content2 = $("#content3").val(); 
    var assessID = $("#assessID").val(); 

    $.ajax({  
                url:"<?=base_url().'ADMS/editAssessM'?>",  
                method:"post",  
                data:{assessID:assessID,content2:content2},  
                success:function(data){ 
                    load_assessment(); 
                     
                }  
           }); 

   
});
   
    
  $(document).on('click','.submit', function(){
      event.preventDefault(); 
  
        var assessment = $('#assessment').val();
        if(assessment == ''){
            alert('You cannot have an empty assessment.');
        }
        else{
        $.ajax({  
                url:"<?=base_url().'ADMS/assessGenM'?>",  
                method:"post",  
                data:{assessment:assessment},
                success:function(data){  
                    
                     $('#form')[0].reset();
                     load_assessment();
                     
                }  
           }); 
        } 
    });
    load_assessment();
    $(function(){
        setInterval(function() {
            load_assessment(); 
        },2000);
    });
   
    
    function load_assessment(){
            var id = $('.submit').attr("id");
        $.ajax({  
                url:"<?=base_url().'ADMS/fetchAssessGenM'?>",  
                method:"post",   
                data:{id:id},
                success:function(data){  
                     $('#fetchData').html(data); 
                    
                   
                }  
           });  
    }
    $(document).on('click','.delete', function(){
        var id = $(this).attr("id");
        $('#yes').val(id);
               
    });

    $(document).on('click','.yes', function(){  
        var assessID = $("#yes").val(); 

        
        
        $.ajax({  
                url:"<?=base_url().'ADMS/deleteAssessM'?>",  
                method:"post",   
                data:{assessID:assessID},
                success:function(data){  
                    console.log(data);
                }  
           });  
    });
  
});

</script>
  

