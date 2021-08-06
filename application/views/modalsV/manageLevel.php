<!--Create Modal-->
<div id="addLevel" class="modal  fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Add a Level</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/addLevelM" method="post">
                <div class="form-group row">
                <label class="col-sm-8 ">Enter a Level Name</label>
                   <div class="col-sm-12">
                  <input name="levelName" id="input" type="text" class="form-control" placeholder="Enter a Level" autofocus required>
                  </div>
                </div>
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
<!--End of Create Modal-->



<!--delete Modal-->
<div id="deleteLevel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title" style="text-align: center"><span >Are you sure you wanna delete this Level?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div> 
            <div class="modal-body ">
            <form method="post" action="<?=base_url()?>ADMS/deleteLevelM">
                 <input type="hidden" name="levelID" id="levelID">
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
<div id="renameLevel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title">Rename Level</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form action="<?=base_url()?>ADMS/renameLevelM" method="post">
                    
                <div class="form-group row">
                <p  style="color:red">*Note: If you rename this level, all programs that are currently in this level will be affected.</p>
                <label class="col-sm-8 ">Enter a new Level Name</label>
                   <div class="col-sm-12">
                   
                  <input name="levelName" id="levelName" type="text" class="form-control"  autofocus required>
                  <input class='form-control' type="hidden" name='IDlevel' id='IDlevel'>
                  
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