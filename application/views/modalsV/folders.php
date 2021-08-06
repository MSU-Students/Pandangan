

<!--Create Modal-->
<div id="folderModal" class="modal fade" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Create Folder</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>/ADMS/createFolderM" method="post">
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a folder name</label>
                   <div class="col-sm-12">
                   <input name="folderName" id="folderName"style="white-space: pre-wrap" class="form-control rounded-4"  placeholder="Enter a folder name" autofocus required>

                   <!-- <input name="folderName"  class="form-control rounded-4" placeholder="Enter a folder name" autofocus required> -->

                </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" id="click4" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                      <center><img id="loader-icon4"  src="<?=base_url()?>/loader.gif" style="display:none"> </center> 
                  </div>
              </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
<!--End of Create Modal-->
<!--Rename Modal-->
<div id="renameFolder" class="modal fade" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Rename Folder</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>/ADMS/renameFolderM" method="post">
                    
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a new folder name</label>
                   <div class="col-sm-12">
                   <input name="folder_name" id="folder_name"style="white-space: pre-wrap" class="form-control rounded-4" placeholder="Enter a folder name" autofocus required>

                  <!-- <input name="folder_name" id="folder_name" type="text" class="form-control"  autofocus required> -->
                  <input class='form-control' type="hidden" name='action' id='action'>
                  <input class='form-control' type="hidden" name='old_name' id='old_name'>
                  </div>
                </div>
                <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" id="click3" type="submit" class="btn cstm-btn-navy btn-block">Submit</button>
                      <center><img id="loader-icon3"  src="<?=base_url()?>/loader.gif" style="display:none"> </center> 
                  </div>
              </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
<!--End of rename Modal-->
<!--Upload Modal-->

<div id="uploadFile" class="modal fade" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                     <center><img id="loader-icon"  src="<?=base_url()?>/loader.gif" style="display:none"> </center> 

                  </div>
              </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<!--End of Upload Modal-->

<!--delete Modal-->
<div id="deleteFolder" class="modal fade" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this folder?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/deleteFolderM">
                 <input type="hidden" name="name" id="name">
                <div class="control-group">
                <div align="center" class="controls">                    
                      <button name="submit" id="click2" type="submit"class="btn cstm-btn-navy ">Yes</button>
                      <button  type="button" class="btn cstm-btn-red " data-dismiss="modal">No</button>
                     <center><img id="loader-icon2"  src="<?=base_url()?>/loader.gif" style="display:none"> </center> 

                  </div>
              </div> 
            </form>
            </div>
            
        </div>
    </div>
</div>
<!--End of delete Modal-->
<!--archive Modal-->
<div id="archiveFolder" class="modal fade" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna archive all files in this folder?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
                  <form method="post" action="<?=base_url()?>/ADMS/archiveAllM">
                    
                        <input type="hidden" name="file_name" id="file_name">
                        <div class="control-group">
                        <div align="center" class="controls">                    
                      <button name="submit" id="click5" type="submit" class="btn cstm-btn-navy">Yes</button>
                      <button  type="button" class="btn cstm-btn-red" data-dismiss="modal">No</button>
                      <center><img id="loader-icon5"  src="<?=base_url()?>/loader.gif" style="display:none"> </center> 
                  </div>
                         </div>
                    </form>
            </div>
            
        </div>
    </div>
</div>
<!--End of archive Modal-->

