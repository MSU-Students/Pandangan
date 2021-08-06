<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- assign task modal -->

<div id="task" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" align="center" >
            <h4 class="modal-title"><span >Assign task to user(s) </span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/assignTaskM">
            
                <div class="table-responsive">
                <table class="table table-striped"  id="dataTable" width="100%" cellspacing="0" >
                    <thead class="cstm-modal-header">
                            <tr>
                                <th style="text-align:center">Users</th>
                               
                            </tr>
                    </thead>
                    <tbody style="background-color:white">
                  
                  <?php 
                  
                      foreach($showUsers as $row3){
                        
                      ?> 
                
                      <tr>
                        <td><input type="checkbox" id="input" name="users[]" value="<?=$row3['usersID']?>" >  <?=$row3['Lname']?>  , <?=$row3['Fname']?>   <?=$row3['Mname']?></td>
                      </tr>
                      <?php
                      }
                  
                  ?>
                 
               </tbody> 
               </table>
                </div>
                <div  class="card">
                    <div class="card-header">
                        Select a Program: 
                    </div>
                    <div class="card-body">
                    <?php  
                     
                     foreach($showPrograms as $program){
                     
                    ?>       
                        <input type="radio"  id="input1" name="program" value="<?= $program->programID?>" required><span class="indent"> <?=$program->programName?></span> <br>
                     <?php } ?>
                  
                    </div>
                </div>
                 <input type="hidden" name="area" id="area">
                
                <div class="control-group"> 
                <br>
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" id="click" class="btn cstm-btn-navy">Assign</button>
                      <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">Cancel</button>
                      <center><img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 

                  </div>
              </div>
            </form>
                      <br>
            
            </div>
        </div>
    </div>
</div>
<!-- End assign task modal -->

<!-- view area task modal -->

<div id="viewTask" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title" >Area <span id="areaNum"></span> <span id="title"></span></h4>
            <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
                
            </div>
            
            <div class="modal-body " >
                <div id="viewTaskInfo">
                                
                </div>
                
            </div>
            
        </div>
    </div>
</div>

<div id="empty" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6" >
            <h4 class="modal-title" style="text-align: center"><span ><i class="fa fa-info-circle"></i> Info</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body " style="background-color:pink;">
               <div class="text-center" style="background-color:maroon;color:white"> <span>There is no program in the system ! <br> You should create a program first before you can assign a task for a user. <br>Thank you.</span></div>
            
            </div> 
        </div>
    </div>
</div>


<!-- End of view area task modal -->
<!--delete task Modal-->
<div id="delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this task?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/deleteTaskM">
                
                 <input type="hidden" name="assigntaskID" id="assigntaskID">
                <div class="control-group">
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy ">Yes</button>
                      <button  type="button" class="btn cstm-btn-red " data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            
            </div>
        </div>
    </div>
</div>
<!--End of delete task Modal-->