<!-- Edit modal -->
<div id="editAssess" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header cstm-modal-header" >
            <h4 class="modal-title"><span id="change_title"> Edit Assessment</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body">
            <form action="">
            <div class="form-group" id="assessEdit">
            
                  
            </div> 
            
            <div class="control-group">
                 <div class="controls mb-2">                    
                      <button name="submit" type="submit" class="edit2 btn cstm-btn-navy btn-block" data-dismiss="modal">Edit</button>
                  </div>
              </div>
            <input type="hidden" name="assessID" id="assessID">   
               
            </form>
            </div>
           
        </div>
    </div>
</div>

                  <!---End of edit modal-->
                

<!--delete file Modal-->
<div id="deleteAssessGen" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header colorDelete" >
            <h4 class="modal-title" style="text-align:center"><span>Are you sure you wanna delete this assessment?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">&times;</button>
                
            </div>
            <div class="modal-body ">
            <form >
                 <input type="hidden" name="id" id="id">
                 
                <div class="control-group">
                 <div align="center" class="controls">                    
                      <button name="submit" type="submit" id="yes" class="yes btn cstm-btn-navy tempHover" data-dismiss="modal">Yes</button>
                      <button  type="button" class="btn cstm-btn-red tempHover" data-dismiss="modal">No</button>
                  </div>
              </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!--End of delete Modal-->