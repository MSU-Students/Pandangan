<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV"); ?>

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


    <span class="float-right mt-2" style="margin-right: 5px"><a href="<?=base_url()?>ADMS/insideFolderV?folder=<?=$folderName?>" class="btn btn-danger " style="border-radius:20px;text-align:center;background-color:red"><strong>X</strong></a></span>
 
      
                          <?php
                            if(substr($var, -3) == 'pdf' || substr($var, -3) == 'PDF'){
                          ?>
                              <div align="center">
                                      
                                        <iframe src="<?=$var?>" style="margin:20px auto 0" width="95%" height="90%" ></iframe>
                                      

                                  </div>
                          <?php
                              }elseif(substr($var, -3) == 'mp4' || substr($var, -3) == 'mkv' || substr($var, -3) == 'MP4' || substr($var, -3) == 'MKV'){
                          ?>
                                  <div class="" align="center">
                                      <video class="frame color8" style="margin:20px auto 0" width="100%" height="82%" controls autoplay >
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
                                        <h4 class="text-center p-2 text-dark">Comment(s)</h4>
                                        <div class="col-md-12  bg-light p-2 text-dark" id="fetch" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px" >
                                        </div>
                                        <form method="POST"  id="form" class="p-2">
                                            <div class="form-group">
                                                <textarea name="comment" style="white-space: pre-wrap" id="comment"  class="form-control rounded-4" placeholder="Write Your comment Here" required></textarea>
                                                <input type="hidden" name="fileID" id="fileID">
                                            </div>
                                            
                                            <div class="form-group  clearfix">
                                                  <span class="float-right"> <button type="submit" name="submit" data-name="post" id="<?=$id?>" class="submit btn cstm-btn-navy rounded-4" value="Post">Post Comment</button></span>                                    
                                                                                        
                                            </div>
                                           </form>
                                  </div>
                              </div>
                            

                              </div>
                          
                          <br>

        
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