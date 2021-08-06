<!--Create Modal-->
<div id="addProgram" class="modal  fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Add a Program</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/addProgramM" method="post">
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a Program Name</label>
                   <div class="col-sm-12">
                        <input name="programName" id="input" type="text" class="form-control" placeholder="Enter a Program" autofocus required>
                        
                      <div class="form-group mt-2">
                       
                                <?php
                                if($showLevels){
                                echo '<h5>Please select a level:</h5>';


                                foreach($showLevels as $level){
                                    echo '
                                        <input type="radio"  name="level" value="'.$level->levelID.'" required><span class="indent"> '.$level->levelName.'</span> <br>
                                            
                                    ';
                                }
                                }else
                                    echo '<h4>There is no level in the system. You should create a level befroe you can set the level.</h4>';
                                

                                ?>
                       
                    </div>
                  </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                 <?php
                     if($showLevels){

                       echo   '<button name="submit" id="click" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                           <img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none">';
                     }
                      ?>
                  </div>
                  </div>
              </div>
            </form>
            </div>
           
        </div>
    </div> 
</div>
<!--End of Create Modal-->

<!--delete Modal-->
<div id="deleteProgram" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title" style="text-align: center"><span >Are you sure you wanna delete this Program?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>ADMS/deleteProgramM">
                 <input type="hidden" name="programID" id="programID">
                <div class="control-group">
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy tempHover">Yes</button>
                      <button  type="button" class="btn cstm-btn-red tempHover" data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            
            </div> 
        </div>
    </div>
</div>
<!--end of delete Modal-->
<!--empty Modal-->
<div id="empty" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6" >
            <h4 class="modal-title" style="text-align: center"><span ><i class="fa fa-info-circle"></i> Info</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body " style="background-color:pink;">
               <div class="text-center" style="background-color:maroon;color:white"> <span>There is no level in the system ! <br> You should create a level first before you can add a program. <br>Thank you.</span></div>
            
            </div> 
        </div>
    </div>
</div>
<!--Rename Modal-->
<div id="renameProgram" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Rename Program</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/renameProgramM" method="post">
                    
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a new Program Name</label>
                   <div class="col-sm-12">
                   
                  <input name="programName" id="programName" type="text" class="form-control"  autofocus required>
                  <input class='form-control' type="hidden" name='IDprogram' id='IDprogram'>
                  
                  </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                  </div>
              </div>
            </form>
            </div>
           
        </div>
    </div>
</div>


<!--set Modal-->
<div id="set" class="modal  fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Set a Level</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div     class="modal-body ">
            <form action="<?=base_url()?>ADMS/setLevelM" method="post">
                <div class=" row"> 
                    <div class="col">
                      <!-- select -->

                      <div class="form-group">
                        
                          <?php
                          if($showLevels){
                            echo '<h4>Please select a level:</h4>';


                            foreach($showLevels as $level){
                                echo '
                                     <br><input type="radio"  name="level" value="'.$level->levelID.'" required><span class="indent"> '.$level->levelName.'</span> <br>
                                      
                                ';
                            }
                          }else
                                echo '<h4>There is no level in the system. You should create a level befroe you can set the level.</h4>';
                            

                          ?>
                          
                      </div>
                    </div>
                  </div>
                  <input class='form-control' type="hidden" name='program_id' id='program_id'>

    
                <div class="control-group">
                 <div class="controls mb-2">      
                 <?php
                     if($showLevels){

                       echo   '<br><button name="submit" id="click" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                           <img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none">';
                     }
                      ?>
                  </div>
              </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
<!--End of set Modal--> 

<!-- Assign Modal -->
<div id="program" class="modal  fade" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content" id="programModal">
            
            
        </div> 
    </div>
</div>
<!-- end of assign modal -->