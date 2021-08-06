<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV"); ?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
   
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>Preview</title>
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
 
     
 
  
</head>

<body class="" style="background-color:rgb(12, 12, 63)">


    <span class="float-right mt-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideProgramFoldersV/<?=$levelID?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>" class="btn btn-danger " style="border-radius:20px;text-align:center;background-color:red"><strong>X</strong></a></span>
       
     
           
      
                          <?php
                            if(substr($var, -3) == 'pdf' || substr($var, -3) == 'PDF'){
                          ?>
                              <div align="center">
                                      
                                        <iframe src="<?=$var?>" style="margin:20px auto 0" width="100%" height="100%"></iframe>
                                      

                                  </div>
                          <?php
                              }elseif(substr($var, -3) == 'mp4' || substr($var, -3) == 'mkv' || substr($var, -3) == 'MP4' || substr($var, -3) == 'MKV'){
                          ?>
                                  <div class="" align="center">
                                      <video class="frame color8" style="margin:20px auto 0" width="100%" height="100%" controls autoplay >
                                          <source src="<?=$var?>" type="video/mp4" >
                                    </video>
                                  </div>
                          <?php          
                          }else{?>
                                  <div align="center" >
                                      <img src="<?=$var?>" alt="" class="frame color8" style="margin:20px auto 0">
                                  </div>
                              <?php
                            
                          }
                          ?>
              
                      <div class="container-fluid" >
                              <div class="row justify-content-center"  >
                                  <div class="col-md-8 bg-light  card-header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                                        <h4 class="text-center p-2 text-dark">Assessment(s)</h4>
                                        <div class="col-md-12  bg-light p-2 text-dark" id="fetch" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px" >
                                        </div>
                                        <form method="POST"  id="form" class="p-2">
                                            <div class="form-group">
                                                <textarea name="comment" style="white-space: pre-wrap" id="comment"  class="form-control rounded-4" placeholder="Write your assessment here" required></textarea>
                                                <input type="hidden" name="fileID" id="fileID">
                                            </div>
                                            
                                            <div class="form-group  clearfix">
                                                  <span class="float-right"> <button type="submit" name="submit" data-name="post" id="<?=$id?>" class="submit btn cstm-btn-navy rounded-4" value="Post">Post Assessment</button></span>                                    
                                                                                        
                                            </div>
                                           </form>
                                  </div>
                              </div>
                            

                        </div>
                          
            

        
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