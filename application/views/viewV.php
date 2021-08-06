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
<body>
<div class="wrapper" >

  <!-- Content Wrapper. Contains page content -->
  <div class="" >
   

        <!-- Main content -->
        <div class="content">

            <div class="container-fluid row" style="width:100%;height:100vh">
            
            
             <!-- <dissv class="col-sm-8" style="width:100%;background-color:pink"> -->
             
             <?php
                            if(substr($var, -3) == 'pdf' || substr($var, -3) == 'PDF'){
                          ?>
                              <div class="col-md-8 ">
                                  <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideFolderV?folder=<?=$folderName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;">X</a></span>
                                      
                                        <iframe  src="<?=$var?>" frameborder="0" style="width:100%;height:100vh" ></iframe>
                                      

                                  </div>
                          <?php
                              }elseif(substr($var, -3) == 'mp4' || substr($var, -3) == 'mkv' || substr($var, -3) == 'MP4' || substr($var, -3) == 'MKV'){
                          ?>
                                  <div class="col-md-8" align="center">
                                        <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideFolderV?folder=<?=$folderName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;">X</a></span>

                                      <video class="frame v" height="90%" controls autoplay >
                                          <source src="<?=$var?>" type="video/mp4" >
                                    </video>
                                  </div>
                          <?php          
                          }else{?>
                                  <div class="col-md-8 " align="center" >
                                             <span class="float-left mt-2 mb-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideFolderV?folder=<?=$folderName?>" class="btn btn-danger btn-sm " style="border-radius:20px;text-align:center;">X</a></span>

                                      <iframe src="<?=$var?>" alt="" frameborder="0" class="" style="width:100%;height:100vh"></iframe>
                                  </div>
                              <?php
                            
                          }
                          ?>
              
            <!-- </dissv> -->
               
                      <div class="col-md-4 info-div " >
                              <div class="bg-light  card-header"  >
                                        <h4 class="text-center text-dark">Comment(s)</h4>
                                        <form method="POST"  id="form" >
                                            <div class="form-group">
                                                <textarea name="comment" style="white-space: pre-wrap" id="comment"  class="form-control rounded-4" placeholder="Write Your comment Here" required></textarea>
                                                <input type="hidden" name="fileID" id="fileID">
                                            </div> 
                                            
                                            <div class="form-group  clearfix">
                                                  <span class="float-right"> <button type="submit" name="submit" data-name="post" id="<?=$id?>" class="submit btn cstm-btn-navy btn-sm rounded-4" value="Post">Post Comment</button></span>                                    
                                                                                        
                                            </div>
                                           </form>
                                        <div class="col-md-12  bg-light text-dark" id="fetch" >
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

<?php require 'modalsV/view.php';?>
  

 <script>
$(document).ready(function(){

    $(document).on('click','.edit', function(){  
           var comID = $(this).attr("id"); 
           var comment = $(this).attr("name"); 
           $('#comID').val(comID);
           $('#comment2').val(comment);
           $.ajax({  
                url:"<?=base_url().'ADMS/editComModalM'?>",  
                method:"post",  
                data:{comID:comID},  
                success:function(data){  
                     $('#comEdit').html(data);  
                    
                     
                }  
           }); 

           

    });  

    $(document).on('click','.edit2', function(){  

    var content2 = $("#content2").val(); 
    var idCom = $("#comID").val(); 

    $.ajax({  
                url:"<?=base_url().'ADMS/editComM'?>",  
                method:"post",  
                data:{idCom:idCom,content2:content2},  
                success:function(data){  
                    load_comment();
                      
                }  
           }); 

   
});
     
      
  $(document).on('click','.submit', function(){
      event.preventDefault(); 
        
        var fileID = $(this).attr("id");
        var comment = $('#comment').val();
        if(comment == ''){
            alert('You cannot have an empty comment.');
        }
        else{
            $.ajax({  
                    url:'<?=base_url().'ADMS/commentM'?>',  
                    method:"post",  
                    data:{fileID:fileID,comment:comment},
                    success:function(data){  
                        $('#form')[0].reset();
                        load_comment();
                        
                    }  
            }); 
        } 
    });
    
    load_comment();
    $(function(){
        setInterval(function() { 
            load_comment();  
        },2000);
    });
   
    
    function load_comment(){
            var id = $('.submit').attr("id");
        $.ajax({  
                url:'<?=base_url().'ADMS/fetchComM'?>',  
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
        var id = $("#yes").val(); 
        var idFile = $("#idFile").val();

              $.ajax({  
                        url:'<?=base_url().'ADMS/deleteComM'?>',  
                        method:"post",   
                        data:{id:id},
                        success:function(data){  
                        // console.log(data);
                         
                        }  
                });

    });
  
});

</script>