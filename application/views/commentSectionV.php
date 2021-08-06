<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['usersID']))
redirect(base_url()."ADMS/logInV"); ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Folders</title>
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
</style>
</head>
<body >
<div class="wrapper" >

  <!-- Content Wrapper. Contains page content -->
  <div class="" >
   

        <!-- Main content -->
        <div class="content">
             <div class="" id="comSide">
                              <div class="bg-light  card-header"  >
                                        <h4 class="text-center text-dark">Comment(s)</h4>
                                        <form method="POST"  id="form" class="p-2">
                                            <div class="form-group">
                                                <textarea name="comment" style="white-space: pre-wrap" id="comment"  class="form-control rounded-4" placeholder="Write Your comment Here" required></textarea>
                                                <input type="hidden" name="fileID" id="fileID">
                                            </div>
                                            
                                            <div class="form-group  clearfix">
                                                  <span class="float-right"> <button type="submit" name="submit" data-name="post" id="<?=$id?>" class="submit btn cstm-btn-navy rounded-4" value="Post">Post Comment</button></span>                                    
                                                                                        
                                            </div>
                                           </form>
                                        <div class="col-md-12  bg-light p-2 text-dark" id="fetch" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px" >
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