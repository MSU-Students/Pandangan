<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--Add File Modal-->
<div id="uploadFile" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" > 
            <h4 class="modal-title"><span>Upload File</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                 
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/uploadFileM" enctype='multipart/form-data'>
                   <div class="table-responsive"><p><strong>Select File</strong>  <input type="file" id="input" name="upload_file" autofocus required> </p></div>
                   

                   <input type="hidden" name="hidden_folder_name" id="hidden_folder_name">
                   <input type="hidden" name="check" id="check">
                    
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" id="click" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                      <center><img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
 
                  </div>
              </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<!--End of Upload Modal-->
<!--Rename Modal-->
<div id="renameFile" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Rename File</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>/ADMS/renameFileInFolderM" method="post">
                    
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a new file name</label>
                   <div class="col-sm-12"> 
                   <input name="file_name" id="file_name" style="white-space: pre-wrap" class="form-control rounded-4" placeholder="Enter a folder name" autofocus required>
                   
                  <!-- <input name="file_name"  id="file_name" type="text" class="form-control"  autofocus required> -->
                  <input class='form-control' type="hidden" name='action' id='action'>
                  <input class='form-control' type="hidden" name='folder_name' id='folder_name'>
                  <input class='form-control' type="hidden" name='old_name' id='old_name'>
                  </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" id="click2" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                      <center><img id="loader-icon2"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
                  </div>
              </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<!--End of rename Modal-->

<!--delete file Modal-->
<div id="deleteFile" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this file?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/deleteFileM">
                 <input type="hidden" name="fileID" id="fileID">

                <div class="control-group">
                    <div align="center" class="controls">                    
                        <button name="submit" id="click3" type="submit" class="btn cstm-btn-navy ">Yes</button>
                        <button  type="button"  class="btn cstm-btn-red " data-dismiss="modal">No</button>
                        <center><img id="loader-icon3"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
                    </div>
              </div> 
            </form>
            
            </div>
        </div>
    </div>
</div>
<!--End of delete Modal-->
<!--archive file Modal-->
<div id="archive" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna archive this file?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/archiveFileInFolderM">
                 <input type="hidden" name="fileName" id="fileName">
                 <input type="hidden" name="folderName" id="folderName">
                 
                <div class="control-group">
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy">Yes</button>
                      <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            
            </div>
        </div>
    </div>
</div>
<!--End of archive Modal-->
<!--tag file Modal-->
<div id="tagFile" class="modal fade " role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span>Select the location you want to tag the file</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div> 
            <div class="modal-body "> 
            
            <div class="white rounded"> 
              
            <form method="post" action="<?=base_url()?>/ADMS/tagFileM">
           
            <br> 
            <?php
                       
                        
                                foreach($areaAssignedM as $area){ 
                                    echo '<strong><p class="indent upper area navy">AREA '.$area->id.' - '.$area->areaName.' ( '.$area->programName.' )</p></strong>';
                                    $usersFolderM = $this->ADMSM->usersFolderM($area->id,$area->programID);
                                        foreach($usersFolderM as $folder){
                                      
                                                echo '<strong><p class="indent2 navy usersFolder">'.$folder->letter.' - '.$folder->name.'</p></strong>';
                                                $usersSubFolder = $this->ADMSM->usersSubFolderM($folder->usersFolderID);
        
                                                        foreach($usersSubFolder as $subFolder){
                                                            echo '<div class ="container"><div class="container indent3 navy usersSubFolder"><input type="checkbox" name="folders[]" value="'.$subFolder->subID.'"><strong > '.$subFolder->letter.'.'.$subFolder->folderNum.' - '.$subFolder->subName.'</strong></div></div>';
                                                    }
                                                    
                                        echo '<br>';
                                        
                                        }
                                        echo '<br>';
                                }
                                   echo '<div class="control-group">
                                    <br>
                                        <div align="center" class="controls">                    
                                                <button name="submit" type="submit" class="btn cstm-btn-navy">Tag</button>
                                                <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">Cancel</button>
                                            </div>
                                        <br><br>
                                    </div>';
                            
                      
                  ?>
                
               
            
             
            
                 <input type="hidden" name="sourcePath" id="sourcePath">
                 <input type="hidden" name="folder-name" id="folder-name">
               
            </form>
            </div>
                      <br>
            
            </div>
        </div>
    </div>
</div>
<!--End of tag Modal-->
<!--empty Modal-->

<div id="empty" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6" >
            <h4 class="modal-title" style="text-align: center"><span ><i class="fa fa-info-circle"></i> Info</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body " style="background-color:pink;">
               <div class="text-center" style="background-color:maroon;color:white"> <span>There is no folder and subfolder in your assigned area. <br> Creating a folder and subfolder in your assigned area is required to tag a file. <br> Or mayabe you are not assigned to any area or maybe there is no program created by the admin. <br> Thank you.</span></div>
            
            </div> 
        </div>
    </div>
</div>
<!--End of empty Modal-->

<!--empty Modal-->

<div id="empty2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6" >
            <h4 class="modal-title" style="text-align: center"><span ><i class="fa fa-info-circle"></i> Info</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body " style="background-color:pink;">
               <div class="text-center" style="background-color:maroon;color:white"> <span>You are currently not assigned to any area. <br> The admin must assigned you to an area first before you can tag files.<br> Thank you.</span></div>
            
            </div> 
        </div>
    </div>
</div>
<!--End of empty Modal-->


<!--details Modal-->
<div id="details" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Details</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
                <div id="detailsInfo" style="background-color:whitesmoke">
                                
                </div>
                
            </div>
           
        </div>
    </div>
</div>
<!--End of details Modal-->
