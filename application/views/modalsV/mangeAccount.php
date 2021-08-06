     <!--Modal-->
     <div id="addAccount"  class="modal fade" role="dialog" aria-hidden="true">  
        <div >
            <div class="modal-dialog" role="">
              <div class="modal-content" style="border-radius: 10px"  >
                <div class="modal-header cstm-modal-header" >
                  <h5 class="modal-title"  >Create Account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                  </button>
                </div>
                <div class="modal-body ">
                    <form class="" method="post" action="<?=base_url()?>/ADMS/addAccountM">
                            
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">First Name</label>
                                  <div class="col-sm-9">
                                      <input name="Fname" type="text" class="form-control" id="input1" placeholder="Enter a Name" autofocus required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Middle Name</label>
                                  <div class="col-sm-9">
                                      <input name="Mname" type="text" class="form-control" id="input2" placeholder="Enter Middle Name" autofocus required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Last Name</label>
                                  <div class="col-sm-9">
                                      <input name="Lname" type="text" class="form-control" id="input3" placeholder="Enter Last Name" autofocus required>
                                  </div>
                                </div>
                               
                                
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">User Type</label>
                                                    <div class="col-sm-9">
                                             <select name="userType" id="userType" class="userType" required>
                                                        <option></option>
                                                        <option>Admin</option>
                                                        <option>Area Faculty</option>
                                                        <option>Accreditor</option>
                                                    
                                            </select>

                                  </div>
                                </div>

                               

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
    </div>

    <!--     MODAL 
   
    end of modal-->
    
    
                  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"  style="border-radius: 10px">
                                    <form role="form" method="post" action="<?=base_url()?>/ADMS/updateUserM">
                                        <div class="modal-header cstm-modal-header">
                                            
                                            <h4 class="modal-title" id="myModalLabel">User Update Info</h4>
                                            <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                    <div class="modal-body ">                                            
                                    <input class='form-control' type="hidden" name='usersID' id='usersID'>
                                        <div class='form-group'>
                                            <label>Firstname</label>
                                            <input class='form-control' id="Fname" name='Fname' required>
                                        </div>
                                        <div class='form-group'>
                                            <label>Middle Initial</label>
                                            <input class='form-control' name='Mname' id='Mname' required>
                                        </div>
                                        <div class='form-group'>
                                            <label>Lastname</label>
                                            <input class='form-control' name='Lname' id='Lname' required>
                                        </div>
                                        <div class='form-group'>
                                            <label>User Type</label>
                                                <select name="userType" id="userType2" class="userType" required>
                                                            <option></option>
                                                            <option>Admin</option>
                                                            <option>Area Faculty</option>
                                                            <option>Accreditor</option>
                                                        
                                                </select>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls mb-2">                    
                                            <button type='submit' id="click2" name='updatebutton' class='btn cstm-btn-navy btn-block'>Update</button>
                                           <center><img id="loader-icon2"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
                     
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                  </div> <!--modal-->

<div class="modal fade" id="deactivatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content"  style="border-radius: 10px">
                                        <form role="form" method="post" action="<?=base_url()?>/ADMS/deactivateM">
                                            <div  class="modal-header cstm-modal-header">
                                                <h4 class="modal-title" id="myModalLabel"><p style="font-size:30px;text-align:center">Are you sure you want to deactivate this account?</p></h4>
                                                <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body ">

                                                
                                                <input class="form-control" type="hidden"  name="idToDeactivate" id="idToDeactivate" >
                                            </div>
                                            <div class="control-group">
                                            <div align="center" class="controls mb-4">                    
                                                    <button type="submit" id="click3" name="deactivatebutton" class="btn cstm-btn-navy">Yes</button>
                                                    <button type="button" class="btn cstm-btn-red" data-dismiss="modal">No</button>
                                                    <center><img id="loader-icon3"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
                                                </div>
                                            </div>
                                             
                                        </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        
                                    </div>
                                    <!-- /.modal-dialog -->
</div><!--modal-->

<div class="modal fade" id="activatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content"  style="border-radius: 10px">
                                        <form role="form" method="post" action="<?=base_url()?>/ADMS/activateM">
                                            <div class="modal-header cstm-modal-header">
                                                <h4 class="modal-title" id="myModalLabel"><p style="font-size:30px;text-align:center">Are you sure you want to re-activate this account?</p></h4>
                                                <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body ">
                                                
                                                <input class="form-control" type="hidden"  name="idToActivate" id="idToActivate" >
                                            </div>
                                            <center class="mb-4">
                                                <button type="submit" id="click4" name="activatebutton" class="btn cstm-btn-navy">Yes</button>
                                                <button type="button" class="btn cstm-btn-red" data-dismiss="modal">No</button>
                                                <center><img id="loader-icon4"  src="<?=base_url()?>/loader.gif" style="display:none"></center> 
                                            </center>
                                        </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        
                                    </div>
                                    <!-- /.modal-dialog -->
</div><!--modal-->
