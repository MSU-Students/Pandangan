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
            <form method="post" action="<?=base_url()?>/ADMS/uploadFileM3/<?=$levelID?>/<?=$programID?>" enctype='multipart/form-data'>
                   <div class="table-responsive"><p><strong>Select File</strong>  <input type="file" id="input" name="upload_file" autofocus required> </p></div>
                   

                   <input type="hidden" name="hidden_folder_name" id="hidden_folder_name">
                    
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" id="click" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                      <img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none"> 
 
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
            <form action="<?=base_url()?>/ADMS/renameEvaFileM/<?=$levelID?>/<?=$programID?>" method="post">
                    
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a new file name</label>
                   <div class="col-sm-12">
                   <input name="file_name" id="file_name" style="white-space: pre-wrap" class="form-control rounded-4" placeholder="Enter a folder name" autofocus required>
                   
                  <input class='form-control' type="hidden" name='file_id' id='file_id'>
                  <input class='form-control' type="hidden" name='folder_name' id='folder_name'>
                  <input class='form-control' type="hidden" name='old_name' id='old_name'>
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
            <form method="post" action="<?=base_url()?>/ADMS/deleteEvaFileM/<?=$levelID?>/<?=$programID?>">
                 <input type="hidden" name="fileID" id="fileID">
                 <input type="hidden" name="folder" id="folder">

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
<!--End of delete Modal-->
