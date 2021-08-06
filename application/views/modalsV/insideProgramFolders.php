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
              
            <form method="post" action="<?=base_url()?>/ADMS/tagFromTagsM/<?=$levelID?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>/<?=$programID?>?name=<?=$subName?>">
            <br><br><br>
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
                  ?>
                
                <div class="control-group">
                <br>
                <div align="center" class="controls">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy">Tag</button>
                      <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">Cancel</button>
                  </div>
                  <br><br>
              </div>
            
             
            
                 <input type="hidden" name="tagID" id="tagID">
               
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