<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Manage Accounts</title>
  <link rel="stylesheet" href="<?=base_url()?>/lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.min.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/adminlte.css" type="text/css">
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>/lte/dist/css/myStyle.css" type="text/css">
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="<?=base_url()?>/lte/dist/js/jquery-3.3.1.slim.min.js"></script>
    <script src="<?=base_url()?>/lte/dist/js/jspdf.min.js"></script>
    <script src="<?=base_url()?>/lte/dist/js/jspdf.plugin.autotable.min.js"></script>
    <script src="<?=base_url()?>/lte/dist/js/tableHTMLExport.js"></script>
    <script src="<?=base_url()?>/lte/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>/lte/dist/js/tableHTMLExport.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/lte/dist/js/adminlte.min.js"></script>

   
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed " >
<div class="wrapper"  >

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
              <li class="breadcrumb-item activated">Manage Accounts</li>
             
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </div>
 
              
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content"> 
    
      <div class="container-fluid">
      <?php 
                  if(isset($_GET['m'])){
                     $message = $_GET['m'];
                     echo $message;
                  }
                  ?>     
      <center class="mb-2">
          <button type="button" value="Save as PDF" id="pdf" class="btn cstm-btn-navy btn-md"  >Save as PDF</button>
              <button type="button" class="btn cstm-btn-navy btn-md" data-toggle="modal" data-target="#addAccount">Create Account</button>
              </center>
      <div class="card mb-3">
            <div class="card-header color13">
              <strong>User Accounts</strong>
              </div>
            <div class="card-body" >
              <div class="table-responsive"  >
                <table class="table table-striped " id="dataTable" width="100%" cellspacing="0" >
                  <thead class="color13">
                    <tr>
                      <th>Name</th>
                      <th>User Type</th>
                      <th>Username</th>
                      <th style="text-align:center">Actions</th>
                      <th style="text-align:center">Status</th>
                    </tr>
                  </thead>
                 
                  <tbody >
                    <?php
                        foreach($list as $row){
                        ?>
                              <tr>
                                <td><?php echo $row->Lname."  ,   ". $row->Fname."    " .$row->Mname?></td>
                                <td><?=$row->userType?></td>
                                <td><?=$row->username?></td>
                                <td style="text-align: center;">      
                                       <?php   if($row->userType !== 'Admin'){ ?>
                                            <div class=" btn-group" >
                                                
                                                <button type="button" id="<?php echo $row->usersID;?>" class="btn cstm-btn-navy btn-sm update" data-toggle="modal" data-target="#editModal">Update</button>
                                                
                                                 <?php   if($row->status == 'activated'){?>
                                                  
                                                        <button type='button' id="<?php echo $row->usersID;?>" class='btn cstm-btn-navy btn-sm btndeactivate' data-toggle="modal" data-target="#deactivatemodal">Deactivate</button>
                       
                                                 <?php   }
                                                    else{ ?>
                                                    
                                                        <button type='button' id="<?php echo $row->usersID;?>" class='btn cstm-btn-navy btn-sm btnactivate' data-toggle="modal" data-target="#activatemodal">Activate</button>
                          
                                                 <?php   } ?>
                                                  
                                            </div>
                                        <?php   } ?>
                                                
                                </td>
                                        <?php   if($row->status == 'activated') { ?>
                                                  
                                                      <td style="text-align:center"><span class="badge badge-success"><?php echo $row->status ?></span></td>
                                           <?php   }
                                              else{ ?>
                                              
                                                       <td style="text-align:center"><span class="badge badge-danger"><?php echo $row->status ?></span></td>
                                           <?php   } ?>
                                
                              </tr>

                      <?php
                        }
                    ?>
                  
                  </tbody>
                </table>

                      <!-- middle -->
          <div style="display:none">
                <table class="table table-striped "  id="savePDF" width="100%" cellspacing="0" >
                  <thead class="color13">
                    <tr>
                      <th>Name</th>
                      <th>User Type</th>
                      <th>Username</th>
                      <th style="text-align:center">Status</th>
                    </tr>
                  </thead>
                 
                  <tbody >
                    <?php
                        foreach($list as $row){
                        ?>
                              <tr>
                                <td><?php echo $row->Lname."  ,   ". $row->Fname."    " .$row->Mname?></td>
                                <td><?=$row->userType?></td>
                                <td><?=$row->username?></td>
                                
                                        <?php   if($row->status == 'activated') { ?>
                                                  
                                                      <td style="text-align:center"><span class="badge badge-success"><?php echo $row->status ?></span></td>
                                           <?php   }
                                              else{ ?>
                                              
                                                       <td style="text-align:center"><span class="badge badge-danger"><?php echo $row->status ?></span></td>
                                           <?php   } ?>
                                
                              </tr>

                      <?php
                        }
                    ?>
                  
                  </tbody>
                </table>
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

<!-- jQuery -->


 

<script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
</body>
</html>
<?php require 'modalsV/mangeAccount.php';?>



<script>
$(document).ready(function(){
  
  $('table').DataTable({
  bFilter: true,
   bPaginate: false
  // bInfo: false
   
  });
        $('.update').click(function(){
            var usersID = $(this).attr("id");

            $.ajax({
                url:"<?=base_url()?>/ADMS/adminInsertFieldModalM",
                method:"post",
                data:{usersID:usersID},
                dataType:"json",
                success:function(data){
                        $('#usersID').val(usersID); 
                      	$('#Fname').val(data.Fname);
                        $('#Mname').val(data.Mname);
                        $('#Lname').val(data.Lname);
                        $('#editModal').appendTo('body').modal('show');

                }
            })


            
        });

        $('.btndeactivate').click(function(){
            var usersID = $(this).attr("id");

            $('#idToDeactivate').val(usersID);
            $('#deactivatemodal').appendTo('body').modal('show');
        });
        
      $('.btnactivate').click(function(){
            var usersID = $(this).attr("id");

            $('#idToActivate').val(usersID);
            $('#Activatemodal').appendTo('body').modal('show');
        });

        $("#pdf").on("click", function () {
        $("#savePDF").tableHTMLExport({ type: "pdf", filename: "user_accounts.pdf" });
      });


      $('#click').click(function(){
       if(!$('#input1').val() || !$('#input2').val() || !$('#input3').val() || !$('#userType').val()){
            return;
        } else{
          $('#loader-icon').show();
        }
  });

  $('#click2').click(function(){
       if(!$('#Fname').val() || !$('#Mname').val() || !$('#Lname').val() || !$('#userType2').val()){
            return;
        } else{
          $('#loader-icon2').show();
        }
  });
  
    $('#click3').click(function(){
        
        $('#loader-icon3').show();
  
  });
  $('#click4').click(function(){
      
      $('#loader-icon4').show();
 
});
});


  

</script>