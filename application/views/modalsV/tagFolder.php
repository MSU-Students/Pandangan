<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--Create Modal-->
<div id="folderModal" class="modal  fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Create Label</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/createTagFolderM/<?=$levelID?>/<?= $rows['areaNum']?>/<?= $programID?>" method="post">
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a Label</label>
                   <div class="col-sm-12">
                   <!-- <textarea name="folderName" style="white-space: pre-wrap" class="form-control rounded-4" placeholder="Enter a folder name" autofocus required></textarea> -->
                  <input name="folderName" type="text" class="form-control" placeholder="Enter a Label" autofocus required>
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
<!--End of Create Modal-->

<!--delete Modal-->
<div id="deleteFolder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title" style="text-align: center"><span >Are you sure you wanna delete this Label?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>ADMS/deleteTagFolderM/<?=$levelID?>/<?= $rows['areaNum']?>/<?=$programID?>">
                 <input type="hidden" name="folderID" id="folderID">
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
<!--Rename Modal-->
<div id="renameFolder" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Rename Label</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/renameTagFolderM/<?=$levelID?>/<?= $rows['areaNum']?>/<?=$programID?>" method="post">
                    
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a new Label</label>
                   <div class="col-sm-12">
                   <!-- <textarea name="folder_name" id="folder_name" style="white-space: pre-wrap" class="form-control rounded-4" placeholder="Enter a folder name" autofocus required></textarea> -->
                   
                  <input name="folder_name" id="folder_name" type="text" class="form-control"  autofocus required>
                  <input class='form-control' type="hidden" name='usersFolderID' id='usersFolderID'>
                  
                  </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" type="submit" class="btn cstm-btn-navy btn-block ">Submit</button>
                  </div>
              </div>
            </form>
            </div>
            
        </div>
    </div>
</div>