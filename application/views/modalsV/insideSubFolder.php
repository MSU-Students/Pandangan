<!--delete file Modal--> 
<div id="deleteFile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title" style="text-align:center"><span>Are you sure you wanna untag this file?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>ADMS/untagM/<?=$levelID?>/<?=$subFolderID?>/<?=$folderNum?>/<?=$areaID?>/<?=$usersFolderID?>/<?=$programID?>?name=<?=$folderName?>">
                 <input type="hidden" name="tagID" id="tagID">
                 
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
<!--End of delete Modal-->

<!--details Modal-->
<div id="details" class="modal fade" role="dialog">
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