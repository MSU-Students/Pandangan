<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV"); ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Preview</title>
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/lte/pandangan-logo.3.png">
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.min.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/myStyle.css" type="text/css">
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
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
<body >
<div class="wrapper" >

  <!-- Content Wrapper. Contains page content -->
  <div class="" >
   

        <!-- Main content --> 
        <div class="content">

            <div class="container-fluid row">
            
            
             <!-- <dissv class="col-sm-8" style="width:100%;background-color:pink"> -->
             
             <?php
                            if(substr($var, -3) == 'pdf' || substr($var, -3) == 'PDF'){
                          ?>
                              <div class="col-md-8 ">
                                    <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideProgramFoldersV/<?=$levelID?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;background-color:red">X</a></span>
                                      
                                        <iframe  src="<?=$var?>" frameborder="0" style="width:100%;height:100vh" ></iframe>
                                      

                                  </div>
                          <?php
                              }elseif(substr($var, -3) == 'mp4' || substr($var, -3) == 'mkv' || substr($var, -3) == 'MP4' || substr($var, -3) == 'MKV'){
                          ?>
                                <div class="col-md-8" align="center">
                                     <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideProgramFoldersV/<?=$levelID?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;background-color:red">X</a></span>

                                      <video class="frame v" height="90%" controls autoplay >
                                          <source src="<?=$var?>" type="video/mp4" >
                                    </video>
                                  </div>
                          <?php          
                          }else{?>
                                  <div class="col-md-8 " align="center" >
                                    <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideProgramFoldersV/<?=$levelID?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;background-color:red">X</a></span>

                                      <iframe src="<?=$var?>" alt="" frameborder="0" class="" style="width:100%;height:100vh"></iframe>
                                  </div>
                              <?php
                            
                          }
                          ?>
            <!-- </dissv> -->

                           
                              <div class="col-sm-4 info-div"  >
                                  <div class=" bg-light  card-header">
                                        <h4 class="text-center text-dark">Assessment(s)</h4>
                                       
                                            <form method="POST"  id="form">
                                                <div class="form-group">
                                                    <textarea name="comment" 
                                                    
                                                    <?php if($user->userType != 'Accreditor')
                                                            echo  'style="white-space: pre-wrap;display:none"';
                                                           else
                                                                 echo  'style="white-space: pre-wrap"';

                                                    ?> 
                                                    id="comment"  class="form-control rounded-4" placeholder="Write your assessment here" required></textarea>
                                                    <input type="hidden" name="fileID" id="fileID">
                                                </div>
                                                
                                                <div class="form-group  clearfix">
                                                    <span class="float-right"> <button type="submit"
                                                    <?php if($user->userType != 'Accreditor') 
                                                    
                                                         echo   'style="display:none"';
                                                    ?> 
                                                     name="submit" data-name="post" id="<?=$id?>" class="submit btn cstm-btn-navy btn-sm rounded-4" value="Post">Post Assessment</button></span>                                    
                                                                                            
                                                </div>
                                            </form>
                                          
                                      
                                        
                                           <div class="col-md-12  bg-light text-dark" id="fetch" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px" >
                                        </div>
                                  </div>
                              </div>
                            

             

        
        
        </div>
    </div>
    
  </div>
 

 
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
</body>
</html>

<?php require 'modalsV/view3.php';?>
 

 <script>
$(document).ready(function(){

    $(document).on('click','.edit', function(){  
           var assessID = $(this).attr("id"); 
           var comment = $(this).attr("name"); 
           $('#assessID').val(assessID);
           $.ajax({  
                url:"<?=base_url().'ADMS/editAssessModalM'?>",  
                method:"post",  
                data:{assessID:assessID},  
                success:function(data){  
                     $('#comEdit').html(data);  
                    
                     
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
        
        var fileID = $(this).attr("id");
        var assessment = $('#comment').val();
        if(assessment == ''){
            alert('You cannot have an empty assessment.');
        }
        else{
            $.ajax({  
                    url:'<?=base_url().'ADMS/assessmentM'?>',  
                    method:"post",  
                    data:{fileID:fileID,assessment:assessment},
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
                url:'<?=base_url().'ADMS/fetchAssessM'?>',  
                method:"post",   
                data:{id:id},
                success:function(data){  
                     $('#fetch').html(data); 
                    
                   
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
                        url:'<?=base_url().'ADMS/deleteAssessM'?>',  
                        method:"post",   
                        data:{assessID:assessID},
                        success:function(data){  
                        // console.log(data);
                         
                        }  
                });

    });
  
});

</script>