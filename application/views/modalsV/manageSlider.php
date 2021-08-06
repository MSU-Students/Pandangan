<!--Add File Modal-->
<div id="uploadFile" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span>Upload File</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                 
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/uploadFileM2" enctype='multipart/form-data'>
                   <div class="table-responsive"><p><strong>Select File</strong>  <input type="file" id="input" name="upload_file" autofocus required> </p></div>
                   

                
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


<!--delete file Modal-->
<div id="deleteFile" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" align="center" >
            <h4 class="modal-title"><span>Are you sure you wanna delete this file?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>/ADMS/deleteFileSliderM">
                 <input type="hidden" name="fileID" id="fileID">

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


<!--view Modal-->
<div id="view" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header"  >
            <h4 class="modal-title"><span>Slider Image</span></h4>
                <button type="button" class=" x btn btn-md cstm-btn-red" data-dismiss="modal"  aria-label="Close"><strong>&times;</strong></button>
                
            </div>
            
            <div class="modal-body"  >
                <div id="viewInfo">
                                
                </div>
                
            </div>
           
        </div>
    </div>
</div>

<!--End of view Modal-->