<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADMSM extends CI_Model {
 
     
 
    public function logInM($username,$password){
  
           $row = $this->db->get_where('users',array('username'=> $username))->row();
                      $check = password_verify($password,$row->password);
                    if($check == 0){
                      $this->session->set_flashdata('logInError',"<div class='alert alert-danger text-center'><strong> Invalid Username or Password !!!</strong></div>");
                        
                        redirect(base_url()."ADMS/logInV");
                   }
                    else if($check == 1 && $row->status == 'activated'){

                        $_SESSION['usersID'] = $usersID = $row->usersID;
                        $row2 = $this->db->get_where('users',array('usersID'=> $usersID))->row();
                        $user = $row2->userType;
    
                    
                        redirect(base_url()."ADMS/homePageV");
                      
                        
                    }
                    else{
                      $this->session->set_flashdata('logInError',"<div class='alert alert-danger text-center'><strong> Sorry, your account is deactivated !!!</strong></div>");
                        redirect(base_url()."ADMS/logInV");
                        
                    }
    }

      public function logOutM(){
       
              try {
   
          unset($_SESSION['usersID']);
          session_destroy();
          redirect(base_url()."ADMS/logInV");
      }
      catch (exception $e) {
          echo $e;
      }
     
                
      }
     
     public function userM(){
            
            $usersID = $_SESSION['usersID'];
           // $query = $this->db->select('Fname')->from('users')->where(array('usersID'=> $usersID))->get();
            $row = $this->db->get_where('users',array('usersID'=> $usersID))->row();
           
          return $row;
            
     }
      
        public function manageListM(){
           $query = $this->db->get('users')->result();  
           return $query;
        } 

        public function adminInsertFieldModalM($got_usersID){
      
            $row = $this->db->get_where('users',array("usersID" => $got_usersID))->row(); 
         
              return $row;
          
       } 
        
       public function addAccountM($Fname,$Mname,$Lname,$username,$password,$userType){
              //  $Fname2 = str_ireplace("'",'-',$Fname); 
              //  $userN = str_ireplace("'",'-',$username); 
              //  $userN2 = str_ireplace(" ",'',$userN); 
              //  $userN3 = strtolower($userN2);
               $Fname2 = strtolower($Fname);
              $Fname3 = str_ireplace(" ",'',$Fname2); 
              $where = array('Fname' => $Fname, 'Mname' => $Mname, 'Lname' => $Lname);
              $this->db->select('*')->from('users')->where($where);
              $query =$this->db->get();
              $check = $query->num_rows();
                
                  if($check > 0){
                    redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-danger text-center'><strong> That account is already existed. Adding Account Failed !!!</strong></div>");
                  }
                  else{
                    
                      $hashed = password_hash($password, PASSWORD_DEFAULT);
                      $data = array(
                        'Fname' => $Fname,
                        'Mname' => $Mname,
                        'Lname' => $Lname,
                        'password' => $hashed,
                        'userType' => $userType,
                        'status' => 'activated'
                      );
                      if($this->db->insert('users', $data)){
                        $last = $this->db->select('*')->from('users')->order_by('usersID', 'DESC')->limit(1)->get()->row();
                        $username2 = $Fname3.$last->usersID;
                        $this->db->update('users', array('username' => $username2), array('usersID' => $last->usersID));
                        redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-success text-center'><strong> Account successfully created !!!</strong></div>");

                      }else{
                        redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-danger text-center'><strong> An error occured !!!</strong></div>");

                      }
                    
                  }
          }

      public function deactivateM($deactivate){
       
          $data = array('status' => 'deactivated');
          $this->db->update('users', $data, array('usersID' => $deactivate));
          redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-success text-center'><strong> Account successfully deactivated !!!</strong></div>");
      }

      public function activateM($activate){
          $data = array('status' => 'activated');
          $this->db->update('users', $data, array('usersID' => $activate));
          
          redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-success text-center'><strong> Account successfully activated !!!</strong></div>");

      }

      public function updateUserM($Fname,$Mname,$Lname,$usersID,$userType){
              
              // $Fname2 = str_ireplace("'",'-',$Fname); 
              // $userN = str_ireplace("'",'-',$Fname); 
              // $userN2 = str_ireplace(" ",'',$userN); 
              // $userN3 = strtolower($userN2);
              $hashed = password_hash(12345, PASSWORD_DEFAULT);
              $Fname2 = strtolower($Fname);
              $Fname3 = str_ireplace(" ",'',$Fname2); 
              $data = array('Fname' => $Fname,'Mname' => $Mname,'Lname' => $Lname, 'userType' => $userType);
              
              if($this->db->update('users', $data, array('usersID' => $usersID))){
                $last = $this->db->select('*')->from('users')->where('usersID', $usersID)->get()->row();
                $username2 = $Fname3.$last->usersID;
                $this->db->update('users', array('username' => $username2, 'password' =>  $hashed), array('usersID' => $last->usersID));
                redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-success text-center'><strong> User successfuly updated !!!</strong></div>");

              }else{
               redirect(base_url()."ADMS/adminManageAccountPageV?m=<div class='alert alert-danger text-center'><strong> An error occured !!!</strong></div>");

              }
         
    }

      public function editAccountM($Fname,$Mname,$Lname,$username,$password,$confrimPassword){
        $num = $this->db->select('*')->from('users')->where('username', $username)->get()->num_rows();
        $check = $this->db->select('*')->from('users')->where('username', $username)->get()->row();
        $usersID = $_SESSION['usersID'];
        
        if($password != $confrimPassword){
            redirect(base_url()."ADMS/accountSettingPageV?m=<div class=' text-center alert alert-danger'><strong> The two passwords did not match !!!</strong></div>");

        }else if($num > 0 && $check->usersID != $usersID){
            redirect(base_url()."ADMS/accountSettingPageV?m=<div class=' text-center alert alert-danger'><strong> The username you entered already existed !!!</strong></div>");

        }
        else{
              $userN2 = str_ireplace(" ",'',$username); 
              $hashed = password_hash($password, PASSWORD_DEFAULT);
              $this->db->update('users', array('Fname' => $Fname,'Lname' => $Lname,'Mname' => $Mname,'username' => $userN2,'password' => $hashed), array('usersID' => $usersID));
              redirect(base_url()."ADMS/accountSettingPageV?m=<div class='text-center alert alert-success'><strong> Changes saved !!!</strong></div>");


        }
    }

      public function createFolderM($folderName){

        if(!file_exists($folderName)){

          chdir("uploads");
          $folder = str_ireplace('&',' and ',$folderName); 
          if(mkdir($folder,0777,true)){
              redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-success'><strong> Folder successfully created !!!</strong></div>");
         }else{
              redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> Folder name should not contain /  \  (  )  *  :  <  > '' ' and ? or dot at the end </strong></div>");
     }
         
        }else{
            redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> Folder name already existed !!!</strong></div>");
        }
      }

      public function createFolderM2($folderName){

        if(!file_exists($folderName)){

          chdir("uploads2");
          $folder = str_ireplace('&',' and ',$folderName); 
          if(mkdir($folder,0777,true)){
              return true;
         }else{
            return false;
     }
         
        }else{
          return false;
        }
      }

      public function renameFolderM($newName,$oldName){

          $newName2 = str_ireplace('&',' and ',$newName);
            $data = array('path' => $newName2);
            chdir("uploads");
            if(rename($oldName, $newName2)){
               $this->db->update('files', $data, array('path' => $oldName));
               redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-success'><strong> Folder successfully renamed !!!</strong></div>");
           }else{
                redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> Folder name should not contain /  \  (  )  *  :  <  > '' ' and ? or dot at the end </strong></div>");
           }
            
            
      }

      public function renameFolderM2($newName,$oldName){

        $newName2 = str_ireplace('&',' and ',$newName);
          $data = array('path' => $newName2);
          chdir("uploads2");
          if(rename($oldName, $newName2)){
            //  $this->db->update('evaluation_file', $data, array('path' => $oldName));
              return true;
          }else{
            return  false;
         }
          
          
    }

      public function personM($usersID){
        $row = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $usersID))->get()->row();
        $person = $row->Fname.'  '.$row->Lname;
        $notifyID = 0;

        return $person;
      }

      public function timeM(){
        
        return date('h:i a',strtotime('+ 6 hour'));

      }

      public function notifyM($category,$date,$actualTime,$fileID,$usersID,$title,$assignTaskID){
                    $this->db->insert('notification', array('category' => $category,'date' => $date,'time' => $actualTime,'fileID' => $fileID,'usersID' => $usersID,'title' => $title, 'assignTaskID' => $assignTaskID));

                    $row2 = $this->db->select('notifyID')->from('notification')->where(array('category' => $category,'date' => $date,'time' => $actualTime,'fileID' => $fileID,'usersID' => $usersID,'title' => $title))->get()->row();
                    $notifyID = $row2->notifyID;
                    if($category == 'assign'){
                      $this->db->insert('notify', array('notifyID' => $notifyID,'usersID' => $usersID,'status' => 'unopened'));
                    }else{

                      $res3 = $this->db->get_where('users',array("status" => "activated"))->result();  
                            
                      foreach($res3 as $row3){
                          $user = $row3->usersID;
                          $row4 = $this->db->get_where('users',array("usersID" => $user))->row();  
                        
                          if($row4->userType == 'Accreditor')
                              continue;
                          else{
                              
                                  $this->db->insert('notify', array('notifyID' => $notifyID,'usersID' => $user,'status' => 'unopened'));
                            }
                      }
                  }
      }

      public function deleteFolderM($folderName){

           $usersID = $_SESSION['usersID'];
           chdir("uploads");
            
           $files = scandir($folderName);
           $category = 'deleteAll';
           $date = date("M  d,  Y");
           $actualTime = $this->timeM();
           

            $this->notifyM($category,$date,$actualTime,null,$usersID,$folderName,null);

           foreach($files as $file){
              if($file === '.' or $file === '..')
                  continue;
              else{
                  $this->db->delete('files', array("fileName" => $file, "path" => $folderName));
  
                  unlink($folderName.'/'.$file);
                 
              }
              
          }
          if(rmdir($folderName)){
            redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-success'><strong> Folder successfully deleted !!!</strong></div>");
          
          }



     } 
     public function deleteFolderM2($folderName,$programID){

      chdir("uploads2");
       
      $files = scandir($folderName);
      $actualTime = $this->timeM();
      
      foreach($files as $file){
         if($file === '.' or $file === '..')
             continue;
         else{
            //  $this->db->delete('evaluation_file', array("fileName" => $file, "path" => $programID));

             unlink($folderName.'/'.$file);
            
         }
         
     }
     if(rmdir($folderName)){
        return true;
     }
     else 
          return false;

} 


     public function uploadFileM($file,$folder,$tempFile,$check){
       
          $usersID = $_SESSION['usersID'];
        
          // $c=0;
         
          $category = 'upload';
          $date = date("M  d,  Y");
          $actualTime = $this->timeM();   
          $extension = pathinfo($file, PATHINFO_EXTENSION);

               

           chdir("uploads/".$folder);
           $file = str_ireplace('&',' and ',$file);

                
          
         

            if($extension == "PDF" || $extension == "pdf" || $extension == "jpg" || $extension == "JPG" || $extension == "JPEG" || $extension == "jpeg" || $extension == "PNG" || $extension == "png" || $extension == "MP4" || $extension == "mp4" ){
             
              if(!file_exists($file)){
                  if(move_uploaded_file($tempFile,$file)){

                      $this->db->insert('files', array('fileName' => $file,'path' => $folder,'uploader' => $usersID,'date' => $date,'time' => $actualTime,'status' => 'notArchived' ));
                     $row = $this->db->select('id')->from('files')->where(array('fileName' => $file,'path' => $folder,'uploader' => $usersID,'date' => $date,'time' => $actualTime,'status' => 'notArchived' ))->get()->row();
                     $fileID = $row->id;
                       $this->notifyM($category,$date,$actualTime,$fileID,$usersID,null,null);
                        if($check == 'true'){
                            redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully uploaded !!!</strong></div>");
                        }
                            else{
                               redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-success'><strong> File successfully uploaded !!!</strong></div>");
                          }

                  }else{
                     
                     if($check == 'true')
                            redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong>An error occured. The file should not exceed 200 MB !!!</strong></div>");
                        else
                          redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong>An error occured. The file should not exceed 200 MB !!!</strong></div>");
                  }
              }else{
                       if($check == 'true')
                            redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> Uploading failed! That file name already existed !!!</strong></div>");
                        else
                          redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> Uploading failed! That file name already existed !!!</strong></div>");
              }
      }
          else{
              if($check == 'true')
                 redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> Uploading failed! This system only allows PDF,MP4,JPG,PNG file formats or the file you uploaded exceeds 200 MB !!!</strong></div>");
              else
                redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> Uploading failed! This system only allows PDF,MP4,JPG,PNG file formats or the file you uploaded exceeds 200 MB !!!</strong></div>");

          }


             
    }

    public function uploadFileM2($file,$tempFile){
      $usersID = $_SESSION['usersID'];
      $extension = pathinfo($file, PATHINFO_EXTENSION);
      chdir("uploads/slider");
      $file = str_ireplace('&',' and ',$file);

      $numRow = $this->db->select('fileName')->from('files')->where(array('fileName' => $file, 'path' => 'slider'))->get()->num_rows();


      if($extension != "jpg" && $extension != "JPG" && $extension != "JPEG" && $extension != "jpeg" && $extension != "PNG" && $extension != "png" ){
        redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-danger'><strong> Uploading failed! This system only allows JPG,PNG file formats for slider images !!!</strong></div>");

      }else{
        if(move_uploaded_file($tempFile,$file)){
            if($numRow == 0){
              $this->db->insert('files', array('fileName' => $file,'path' => 'slider','uploader' => $usersID,'date' => $date,'time' => '','status' => 'notArchived' ));
              redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-success'><strong> File successfully uploaded !!!</strong></div>");
            }
            else
           redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-danger'><strong> Uploading failed! That file name already existed !!!</strong></div>");

      }else{
           redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");
          }
        
      }
    }

    public function uploadFileM3($levelID,$programID,$file,$tempFile,$folder){
      $usersID = $_SESSION['usersID'];
      $file = str_ireplace('&',' and ',$file);
      $date = date("M  d,  Y");
      $actualTime = $this->timeM();   
      $extension = pathinfo($file, PATHINFO_EXTENSION);
      chdir("uploads2/".$folder);
      $numRow = $this->db->select('fileName')->from('evaluation_file')->where(array('fileName' => $file, 'path' => $programID,'levelID' => $levelID))->get()->num_rows();


      if($extension != "pdf" && $extension != "PDF"){
        redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Uploading failed! This system only allows PDF files !!!</strong></div>");

      }else{
        if(move_uploaded_file($tempFile,$file)){
            if($numRow == 0){
              $this->db->insert('evaluation_file', array('fileName' => $file,'path' => $programID,'levelID' => $levelID,'uploader' => $usersID,'date' => $date,'time' => $actualTime));
              redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-success'><strong> File successfully uploaded !!!</strong></div>");
            }
            else
           redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Uploading failed! That file name already existed !!!</strong></div>");

      }else{
           redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");
          }
        
      }
    }


    public function tagFileM($usersFolderID, $sourcePath,$folderName){
      $usersID = $_SESSION['usersID'];
      $date = date("M  d,  Y");
      $actualTime = $this->timeM();

      foreach($usersFolderID as $targetPath => $value){

            $numRow = $this->db->select('*')->from('tags')->where(array('fileName' => $sourcePath, 'targetPath' => $value))->get()->num_rows();
            
            if($numRow > 0 )
                $res1 = true;
            else
              $res1 = $this->db->insert('tags', array('fileName' => $sourcePath,'tagger' => $usersID,'sourcePath' => $sourcePath,'targetPath' => $value, 'tagNum' => 500, 'date' => $date, 'time' => $actualTime));
        

      }
        if($res1){
            redirect(base_url()."ADMS/insideFolderV?folder=".$folderName."&m=<div class='text-center alert alert-success'><strong> File successfully tagged !!!</strong></div>");

         }else{
            redirect(base_url()."ADMS/insideFolderV?folder=".$folderName."&m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
         }

    
   

}

  public function tagFromTagsM($levelID,$tagID,$subID,$subName,$areaID,$usersFolderID,$folderNum,$subFolderID,$programID){
    $usersID = $_SESSION['usersID'];
    $date = date("M  d,  Y");
    $actualTime = $this->timeM();
    
    $row = $this->db->select('*')->from('tags')->where(array('id'=> $tagID))->get()->row();


        foreach($subID as $targetPath => $value){

          $numRow = $this->db->select('*')->from('tags')->where(array('fileName' => $row->sourcePath, 'targetPath' => $value))->get()->num_rows();
          
          if($numRow > 0 )
              $res1 = true;
          else
            $res1 = $this->db->insert('tags',array('fileName' => $row->fileName, 'tagger' => $usersID, 'sourcePath' => $row->sourcePath, 'tagNum' => 500, 'date' => $date, 'time' => $actualTime, 'targetPath' => $value));
      

         }

      if($res1)
        redirect(base_url()."ADMS/insideProgramFoldersV/".$levelID."/".$areaID."/".$usersFolderID."/".$folderNum."/".$subFolderID."/".$programID."?name=".$subName."&m=<div class='text-center alert alert-success'><strong> File Successfully tagged !!!</strong></div>");

      else
        redirect(base_url()."ADMS/insideProgramFoldersV/".$levelID."/".$areaID."/".$usersFolderID."/".$folderNum."/".$subFolderID."/".$programID."?name=".$subName."&m=<div class='text-center alert alert-danger'><strong> ERROR !!!</strong></div>");

  }

    public function archiveAllM($folder){
     
      $num = $this->db->select('*')->from('files')->where(array('path' => $folder))->get()->num_rows();
      
        if($num == 0){

            redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong>There is no file in your chosen folder !!!</strong></div>");
        }
        else{
          chdir("uploads");
          $files = scandir($folder);
        foreach($files as $file){
            if($file === '.' or $file === '..')
                continue;
            else{
                $source = $folder.'/'.$file;
                $target = 'Archive/'.$file;
                copy($source,$target);
                
                $row = $this->db->select('id')->from('files')->where(array('fileName'=> $file, 'path' => $folder))->get()->row();
                $sourcePath = $row->id;

                $stmt = $this->db->delete('tags', array("sourcePath" => $sourcePath));
                $num_rows = $this->db->select('*')->from('files')->where(array('fileName' => $file, 'path' => 'Archive'))->get()->num_rows();

                if($num_rows == 0){
                   $stmt2 = $this->db->update('files', array('status' => 'archived'), array('fileName' => $file, 'path' => $folder));
                   $this->db->delete('comments', array("file" => $sourcePath));
                }
               else
                    $stmt2 = $this->db->delete('files',array('fileName' => $file, 'path' => $folder));

                $stmt3 = $this->db->update('files', array('path' => 'Archive'), array('fileName' => $file, 'status' => 'archived'));


                if($row &&  $stmt && $stmt2 && $stmt3){
                     if(unlink($_POST["file_name"].'/'.$file)){
                        continue;
                     }
                }else{
                  redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong>An error occured !!!</strong></div>");
                }
            }
        }
        redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-success'><strong>All files in your chosen folder successfully archived  !!!</strong></div>");
        
      }
		
    }
   
  public function filesListM($folder) { 
      $row = $this->db->get_where('files',array("path" => $folder, "status" => "notArchived"))->result();  
      return $row;

    }
    public function filesListM2($levelID,$programID){
      return $this->db->get_where('evaluation_file',array("path" => $programID, "levelID" => $levelID))->result();  
    }
    public function selectTagM(){

      $usersID = $_SESSION['usersID'];

      $row = $this->db->select('areas.id,areas.areaName,usersfolder.letter,usersfolder.name,userssubfolder.folderNum,userssubfolder.subName,userssubfolder.subID')
                  ->from('areas')
                  ->join('usersfolder', 'usersfolder.area = areas.id')
                  ->join('userssubfolder', 'userssubfolder.usersfolder = usersfolder.usersFolderID')
                  ->join('assigntask', 'areas.id = assignTask.area')
                  ->where('assignTask.user', $usersID)->get()->result();
      return $row;
    }

    public function areaAssignedM(){
      $usersID = $_SESSION['usersID'];

      $row = $this->db->select('areas.id,areas.areaName,assigntask.program,programs.programName,programs.programID')
                  ->from('areas')
                  ->join('assigntask', 'areas.id = assigntask.area')
                  ->join('programs', 'programs.programID = assigntask.program')
                  ->join('users', 'assigntask.user ='.$usersID)
                  ->where('users.usersID', $usersID)->get()->result();
      return $row;
    }
    public function usersFolderM($areaID,$programID){
     $programLevel = $this->db->select('*')->from('programs')->where('programID', $programID)->get()->row();
       return $result = $this->db->select('*')
              ->from('areas')
              ->join('usersfolder', 'areas.id = usersfolder.area')
              ->join('programs', 'programs.programID = usersfolder.program')
              ->where('programs.programID', $programID)
              ->where('usersfolder.area', $areaID)
              ->where('usersfolder.area', $areaID)
              ->where('usersfolder.level', $programLevel->levelID)
              ->order_by('usersfolder.letter', 'ACS')->get()->result();
        
    }
    public function checkTaskM(){
      $usersID = $_SESSION['usersID'];
      return $this->db->select('*')->from('assigntask')->where('user', $usersID)->get()->num_rows();
    }

    public function usersSubFolderM($usersFolderID){
      $programLevel = $this->db->select('*')->from('usersfolder')->where('usersFolderID', $usersFolderID)->get()->row();
    
      return  $result = $this->db->select('*')
              ->from('userssubfolder')
              ->join('programs', 'programs.programID = userssubfolder.program')
              ->join('usersfolder', 'usersfolder.program = programs.programID')
              ->where('userssubfolder.usersfolder',$usersFolderID)
              ->where('usersfolder.usersfolderID', $usersFolderID)
              ->where('userssubfolder.level', $programLevel->level)
              ->order_by('userssubfolder.folderNum', 'ACS')->get()->result();
    }

    public function numTagM(){

      $usersID = $_SESSION['usersID'];
      $num = $this->db->select('*')
                  ->from('areas')
                  ->join('usersfolder', 'usersfolder.area = areas.id')
                  ->join('userssubfolder', 'userssubfolder.usersfolder = usersfolder.usersFolderID')
                  ->join('assigntask', 'areas.id = assignTask.area')
                  ->where('assignTask.user', $usersID)->get()->num_rows();
      return $num;
    }

    public function renameFileInFolderM($newName,$oldName,$folder){

      $newName2 = str_ireplace('&',' and ',$newName);
      $ext = '.'.pathinfo($oldName, PATHINFO_EXTENSION);
      $extension = pathinfo($newName2, PATHINFO_EXTENSION);
        
        chdir("uploads/".$folder);

        if($extension != "PDF" && $extension != "pdf" && $extension != "jpg" && $extension != "JPG" && $extension != "JPEG" && $extension != "jpeg" && $extension != "PNG" && $extension != "png" && $extension != "MP4" && $extension != "mp4" ){
                $newName2 = $newName2.$ext;

              if(rename($oldName, $newName2)){
                $this->db->update('files', array('fileName' => $newName2), array('fileName' => $oldName, 'status' => 'notArchived', 'path' => $folder));
                redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");
                
            }else{
                redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> File name should not contain & /  \  (  )  *  :  <  > '' ' and ? or dot at the end </strong></div>");
                
            }
        }
        else{
          if(rename($oldName, $newName2)){
            $this->db->update('files', array('fileName' => $newName2), array('fileName' => $oldName, 'status' => 'notArchived', 'path' => $folder));
            redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");
            
        }else{
            redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> File name should not contain & /  \  (  )  *  :  <  > '' ' and ? or dot at the end </strong></div>");
            
        }
          redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");

        }
       
  }
  public function renameEvaFileM($newName,$oldName,$folder,$fileID,$levelID,$programID){

    $newName2 = str_ireplace('&',' and ',$newName);
    $ext = '.'.pathinfo($oldName, PATHINFO_EXTENSION);
    $extension = pathinfo($newName2, PATHINFO_EXTENSION);
      
      chdir("uploads2/".$folder);

      if($extension != "PDF" && $extension != "pdf"){
              $newName2 = $newName2.$ext;

            if(rename($oldName, $newName2)){
              $this->db->update('evaluation_file', array('fileName' => $newName2), array('fileID' => $fileID));
          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");
              
          }else{
          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> File  name should not contain & /  \  (  )  *  :  <  > '' ' and ? or dot at the end !!!</strong></div>");
         
          }
      }
      else{
        if(rename($oldName, $newName2)){
          $this->db->update('evaluation_file', array('fileName' => $newName2), array('fileID' => $fileID));
          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");
          
      }else{
          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> File  name should not contain & /  \  (  )  *  :  <  > '' ' and ? or dot at the end !!!</strong></div>");
          
      }
          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-success'><strong> File successfully renamed !!!</strong></div>");

      }
     
}

    public function deleteFileM($fileID){
      $path = $this->db->select('path,fileName')->from('files')->where(array('id' => $fileID))->get()->row();
      $folder = $path->path;
      $file = $path->fileName;
      $usersID = $_SESSION['usersID'];
      $category = 'deleteSingle';
      $date = date("M  d,  Y");
      $actualTime = $this->timeM();  
      chdir("uploads/".$folder);

      if(file_exists($file)){
      
        if(unlink($file)){
 
           $this->db->delete('files', array("id" => $fileID));
           $this->notifyM($category,$date,$actualTime,null,$usersID,$folder,null);

           redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully deleted !!!</strong></div>");
       
        }else{

          redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> Deleting problem occur !!!</strong></div>");
           
        }
    }

    }
    
    public function  deleteEvaFileM($fileID,$levelID,$programID,$folder){
      $path = $this->db->select('*')->from('evaluation_file')->where(array('fileID' => $fileID))->get()->row();
      
      $file = $path->fileName;
      $usersID = $_SESSION['usersID'];
      chdir("uploads2/".$folder);

      if(file_exists($file)){
      
        if(unlink($file)){
 
           $this->db->delete('evaluation_file', array("fileID" => $fileID));

          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-success'><strong> File successfully deleted !!!</strong></div>");
       
        }else{

          redirect(base_url()."ADMS/finalEvaluateV/".$levelID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> something went wrong !!!</strong></div>");
           
        }
    }

    }
   

    public function deleteFileSliderM($fileID){
      $name = $this->db->select('fileName')->from('files')->where(array('id' => $fileID))->get()->row();
      $file = $name->fileName;
      chdir("uploads/slider");

      if(file_exists($file)){
      
        if(unlink($file)){
 
           $this->db->delete('files', array("id" => $fileID));

           redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-success'><strong> File successfully deleted !!!</strong></div>");
       
        }else{

           redirect(base_url()."ADMS/manageSliderV?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
           
        }
    }

    }

    public function detailsM($id){

      $output = '';
      
      $rows = $this->db->select('files.fileName,files.path,users.Fname,users.Mname,users.Lname,files.time,files.date')->from('files')->where(array('files.id' => $id))->join('users', 'users.usersID = files.uploader')->get()->row();
      
      if($rows){
        
      $output .= '  
        <div class="table-responsive">  
             <table class="table table-bordered">';  
          if($rows)
          {
              $output .= '
              <tr>
                  <th scope="row"> File Name:</th>
                  <td>'.$rows->fileName.'</td>
              </tr>
              <tr>
                <th scope="row"> Folder:</th>
                <td>'.$rows->path.'</td>
              </tr>
              <tr>
                <th scope="row"> Uploaded by:</th>
              <td>'.$rows->Fname.'  '.$rows->Mname.' '. $rows->Lname.'</td>
              </tr>
              <tr>
                <th scope="row"> Time Uploaded:</th>
              <td>'.$rows->time.'</td>
              </tr>
              <tr>
                <th scope="row"> Date Uploaded:</th>
              <td>'.$rows->date.'</td>
              </tr>
          
              ';
                  
                          
          }
              
        $output .= "</table></div>";  
        return $output; 
        
      } else
        return 'sql error';
    }

    public function archiveFileInFolderM($file,$folder){
      $source = $folder.'/'.$file;
      $target = 'Archive/'.$file;
      chdir("uploads");
      
     if(file_exists($folder.'/'.$file)){
      
      if(copy($source,$target)){
        
        if(unlink($folder.'/'.$file)){ 

      $stmt = $this->db->select('*')->from('files')->where(array('fileName' => $file, 'path' => $folder))->get()->row();
      $sourcePath = $stmt->id;
      $stmt2 = $this->db->delete('tags', array("sourcePath" => $sourcePath));
      $num_rows = $this->db->select('*')->from('files')->where(array('fileName' => $file, 'path' => 'Archive'))->get()->num_rows();

      if($num_rows == 0){
           $stmt3 = $this->db->update('files', array('status' => 'archived'), array('fileName' => $file, 'path' => $folder));
           $this->db->delete('comments', array("file" => $sourcePath));

      }
      else
        $stmt3 = $this->db->delete('files',array('fileName' => $file, 'path' => $folder));
           
      
          
      $stmt4 = $this->db->update('files', array('path' => 'Archive'), array('fileName' => $file, 'status' => 'archived'));

      if($stmt && $stmt2 && $stmt3 && $stmt4){

          redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-success'><strong> File successfully archived !!!</strong></div>");
                
      }else{
          redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> An error occured !!!</strong></div>");     
             
          }
     }
    }else{
      redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> An error occured !!!</strong></div>");
    }
 }

    }    

    public function viewM($fileName){
      
      $var = base_url().'/uploads/slider/'.$fileName;
      
      
          return   '<h5> Image Name:  <strong>'.$fileName.'</strong></h5>
          <div align="center" >
                          <img class="d-block w-100" src="'.$var.'" >
                      </div>';
          
    }
  
    public function commentM($fileID,$comment){
 
      
      $usersID = $_SESSION['usersID'];
      $category = 'comment';
      $date = date("M  d,  Y");
      $actualTime = $this->timeM(); 

      $this->db->insert('comments', array('content' => $comment,'comUser' => $usersID,'file' => $fileID,'date' => $date ));
      $this->notifyM($category,$date,$actualTime,$fileID,$usersID,$comment,null);

    }

    public function assessmentM($fileID,$assessment){
      $date = date("M  d, Y");
      $usersID = $_SESSION['usersID'];
     
      $this->db->insert('assessment', array('content' => $assessment,'assessUser' => $usersID,'file' => $fileID,'date' => $date, 'type' => 'specific' ));

    }
    
    public function assessGenM($assessment){
      $date = date("M  d, Y");
      $usersID = $_SESSION['usersID'];

      $this->db->insert('assessment', array('content' => $assessment,'assessUser' => $usersID,'file' => null,'date' => $date, 'type' => 'general' ));
     

    }

    public function fetchComM($fileID){
      $output = "";
      $usersID = $_SESSION['usersID'];

      $rows = $this->db->select('*')->from('comments')->where(array('file'=> $fileID))->order_by('comID', 'DESC')->get()->result_array();
          if($rows){
            foreach($rows as $row){
              $comUser = $row['comUser'];
              $row2 = $this->db->select('*')->from('users')->where(array('usersID'=> $comUser))->get()->row_array();

                $output .= '  <div align="center">
                  <div class=" mb-5 " >
                      <div class="card-header   ">
                          <span class="float-left" style="font-size:14px"><strong>'.$row2['Fname'].'&nbsp;  '.$row2['Lname'].'</strong></span>
                            <span class="float-right font-italic" style="font-size:14px"><strong>'.$row['date'].'</strong></span>
                    </div>
                        <div class="card-body py-2" >
                              <p  style="text-align:left;font-size:14px;white-space: pre-wrap" id="content"><span style="padding-left:30px">'.$row['content'].'</span></p>
                        </div>
                            <div class=" py-2">';
                            if($usersID == $comUser){
                              $output .=' <div class="float-right" style="font-size:14px">
                              <a href="#" class=" delete text-red mr-2" data-toggle="modal" data-target="#delete"  id="'.$row['comID'].'"   title="Delete">Delete</a>
                              <a href="#" class=" edit text-blue mr-2" id="'.$row['comID'].'" name="'.$row['content'].'" data-toggle="modal" data-target="#editCom" title="Edit">Edit</a>
                        </div>';
                            }
                    
                    $output .='  </div>
                                                
                  </div>
                  </div>
                  <div class="dropdown-divider"></div>';
                                          
             }
          }else
          echo "<h3 class='text-center'>There are no comments.</h3>";
                  

     return $output;

    }

    public function fetchAssessM($fileID){
      $output = "";
      $usersID = $_SESSION['usersID'];

      $rows = $this->db->select('*')->from('assessment')->where(array('file'=> $fileID, 'type' => 'specific'))->order_by('assessID', 'Desc')->get()->result_array();
         
      if($rows){
        foreach($rows as $row){
              $assessUser = $row['assessUser'];
              $row2 = $this->db->select('*')->from('users')->where(array('usersID'=> $assessUser))->get()->row_array();
              $output .= '  <div align="center" class="">
            <div class="mb-5">
               <div class="card-header">
                    <span class="float-left " style="font-size:14px"><strong>'.$row2['Fname'].'&nbsp;  '.$row2['Lname'].'</strong> (Accreditor)</span>
                      <span class="float-right font-italic" style="font-size:14px"><strong>'.$row['date'].'</strong></span>
             </div>
                 <div class="card-body py-2">
                       <p  style="text-align:left;font-size:14px;white-space: pre-wrap" id="content">'.$row['content'].'</p>
                 </div>
                     <div class="py-2">';
                     if($usersID == $assessUser){
                            $output .='
                          <div class="float-right">
                          <a href="#" class="delete text-red mr-2"  id="'.$row['assessID'].'"  data-toggle="modal" data-target="#deleteAssess" title="Delete">Delete</a>
                        <a href="#" class="edit text-blue mr-2" id="'.$row['assessID'].'" data-toggle="modal" data-target="#editAssess" title="Edit">Edit</a>
                      </div>';
                    }
                    $output .='  </div>
                                                
                    </div>
                    </div>
                    <div class="dropdown-divider"></div>';
                                    
          }
      }else
          echo "<h5 class='text-center'>There are no assessments from the accreditors.</h5>";
     

         return $output;
    }

    public function fetchAssessGenM(){
      $output = "";
      $usersID = $_SESSION['usersID'];

      $rows = $this->db->select('*')->from('assessment')->where(array('type' => 'general'))->order_by('assessID', 'Desc')->get()->result_array();
      if($rows){
        foreach($rows as $row){
              $assessUser = $row['assessUser'];
              $row2 = $this->db->select('*')->from('users')->where(array('usersID'=> $assessUser))->get()->row_array();
              $output .= '  <div align="center" class="">
            <div class="mb-5">
               <div class="card-header">
                    <span class="float-left " style="font-size:14px"><strong>'.$row2['Fname'].'&nbsp;  '.$row2['Lname'].'</strong> (Accreditor)</span>
                      <span class="float-right font-italic" style="font-size:14px"><strong>'.$row['date'].'</strong></span>
             </div>
                 <div class="card-body py-2">
                       <p  style="text-align:left;font-size:14px;white-space: pre-wrap" id="content">'.$row['content'].'</p>
                 </div>
                     <div class="py-2">';
                     if($usersID == $assessUser){
                            $output .='
                          <div class="float-right">
                          <a href="#" class="delete text-red mr-2"  id="'.$row['assessID'].'"  data-toggle="modal" data-target="#deleteAssessGen" title="Delete">Delete</a>
                        <a href="#" class="edit text-blue mr-2" id="'.$row['assessID'].'" data-toggle="modal" data-target="#editAssess" title="Edit">Edit</a>
                      </div>';
                    }
                    $output .='  </div>
                                                
                    </div>
                    </div>
                    <div class="dropdown-divider"></div>';
                                    
          }
      }else
          echo "<h5 class='text-center mb-5'>There are no assessments from the accreditors.</h5>";
 
         return $output;

    }

    public function showAreasM(){

      $rows = $this->db->select('*')->from('areas')->get()->result_array();
      return $rows;

    }

    public function selectedAreaM($id){

      $rows = $this->db->select('*')->from('areas')->where(array('id'=> $id))->get()->row_array();
      return $rows;

    }

    public function selectedUsersFolderM($usersFolderID,$programID){

      return $this->db->select('*')->from('usersfolder')->where(array('usersFolderID'=> $usersFolderID,'program' => $programID))->get()->row_array();

    }
public function showUsersFolderM($levelID,$areaID,$programID){
                      
      $rows = $this->db->select('*')->from('usersfolder')->where(array('area'=> $areaID,'program' => $programID,'level' => $levelID ))->order_by('letter', 'ACS')->get()->result_array();
      return $rows;
}

     
    public function totalAssignedM(){

       $totalAssign = array();
       $rows =  $this->showAreasM();

        foreach($rows as $row){
          $id = $row['id'];
          $num_rows = $this->db->select('*')->from('assigntask')->where(array('area'=> $id))->get()->num_rows();
              
          array_push($totalAssign,$num_rows);
          
        }

        return $totalAssign;
    }

    public function showUsersM(){
      
      $rows = $this->db->select('*')->from('users')->where(array('status'=> 'activated', 'userType !=' => 'Accreditor' ))->order_by('Lname', 'ASC')->get()->result_array();
        return $rows;
    }

    public function showAssignedUsersM($areaNum){
      $user = $this->userM();
      $output = "";
          $rows = $this->db->select('users.usersID,areas.areaName,users.Fname,users.Mname,users.Lname,assigntask.id,programs.programName,programs.programID')->from('users')
                  ->join('assignTask', 'assigntask.user = users.usersID')
                  ->join('areas', 'areas.id = assigntask.area')
                  ->join('programs', 'programs.programID = assigntask.program')
                  ->where('areas.id',$areaNum)->get()->result_array();
                  
                  $output .='<div class="table-responsive">
                  <table class="table table-striped"  id="dataTable" width="100%" cellspacing="0" >
                      <thead class="cstm-modal-header">
                            
                                  <th>Name of user(s) assigned in this area</th>
                                  <th style="text-align:center">Program</th>';
                              if($user->userType == 'Admin'){
                                $output .=' <th style="text-align:center">Action</th>';
                                 
                                }
           $output .='</thead>
                      <tbody style="background-color:white">  ';
          
          foreach($rows as $row){                      
                 
                
                     $output .=' 
                     
                     <tr>
                            <td>'.$row['Lname'].',  '.$row['Fname'].'  '. $row['Mname'].'</td> 
                            <td align="center">'.$row['programName'].'</td>';
                            
                      if($user->userType == 'Admin'){
                          $output .=' <td align="center">
                              <button  type="button" id="'.$row['id'].'" name="'.$row['programID'].'" data-toggle="modal" data-target="#delete" class="delete btn cstm-btn-navy btn-sm">Delete</button>
                              </td>';
                          }

                         $output .='</tr>';
           
          }
          $output .='
                    </tbody>
                    </table>
                  </div>';
          return $output;
    }

    public function assignTaskM($user,$area,$program){
      $date = date("M  d,  Y");
      $actualTime = $this->timeM(); 
      $category="assign";
      $date = date("M  d,  Y");


      foreach($user as $name => $usersID){
        $numRow = $this->db->select('*')->from('assignTask')->where(array('user'=> $usersID, 'area' => $area,'program' => $program))->get()->num_rows();
        $row = $this->db->select('programName')->from('programs')->where('programID',$program)->get()->row();
        $nameArea = $this->db->select('areaNum,areaName')->from('areas')->where(array('id'=> $area))->get()->row();
        $areaName = $nameArea->areaNum.' '.$nameArea->areaName.' in ';
        
          if($numRow > 0 )
            $rows2 = true;
          else{

            $rows2 = $this->db->insert('assignTask', array('user' => $usersID,'area' => $area,'program' => $program));
            $rows3 = $this->db->select('id')->from('assignTask')->where(array('user' => $usersID,'area' => $area,'program' => $program))->get()->row();
            $this->notifyM($category,$date,$actualTime,null,$usersID,$areaName,$rows3->id);
     
          }
      }

      if($rows2){
		  	redirect(base_url()."ADMS/assignTaskV?m=<div class='text-center alert alert-success'><strong> User(s) successfully assigned !!!</strong></div>");

      }else{
		  	redirect(base_url()."ADMS/assignTaskV?m=<div class='text-center alert alert-danger'><strong> SQL Error !!!</strong></div>");
      }
    }
    
    public function deleteTaskM($assigntaskID){
     
    
      $res = $this->db->delete('assigntask', array("id" => $assigntaskID));
      if($res){
        $this->db->delete('notification',array('assigntaskID' => $assigntaskID));
		  	redirect(base_url()."ADMS/assignTaskV?m=<div class='text-center alert alert-success'><strong> User successfully deleted !!!</strong></div>");
      }else{
        die("SQL Error...");
      }

    }
    // public function checkProgramLevelM(){
    //   $usersID = $_SESSION['usersID'];

    //   return $this->db->select('*')->from('programs')
    //       ->join('assigntask','assigntask.program = programs.programID')
    //       ->join('level','programs.levelID = level.levelID')
    //       ->where(array('assigntask.user'=> $usersID))->get()->num_rows(); 

    // }
    public function showAssignedAreaM(){
        $usersID = $_SESSION['usersID'];
       

      // if($this->ADMSM->checkProgramLevelM() == 0){
      //       $rows = $this->db->select('areas.areaNum,areas.id,areas.areaName,assigntask.program,programs.programName')->from('areas')
      //       ->join('assigntask', 'assigntask.area = areas.id')
      //       ->join('programs', 'assigntask.program = programs.programID')
      //       ->where(array('assigntask.user'=> $usersID))->order_by('areas.areaNum', 'ACS')->get()->result_array();
      // }else{
            $rows = $this->db->select('areas.areaNum,areas.id,areas.areaName,assigntask.program,programs.programName,programs.levelID')->from('areas')
            ->join('assigntask', 'assigntask.area = areas.id')
            ->join('programs', 'assigntask.program = programs.programID')
            ->join('level', 'level.levelID = programs.levelID')
            ->where(array('assigntask.user'=> $usersID))->order_by('areas.areaNum', 'ACS')->get()->result_array();
      
       
                
        return $rows;

    }
    public function assignModalM($areaName,$levelID,$areaID,$programID,$levelName,$program_name){
		$level = $this->ADMSM->showLevelsM(); 

      $output = "";

      $output .= "<div class='modal-header cstm-modal-header'  >
            <h5 class='modal-title'><strong>Area ".$areaID." ".$areaName."</strong></h5>
                <button type='button' class='close' data-dismiss='modal' style='color:white' aria-label='Close'>&times;</button>
                
            </div>
            <div class='modal-body mb-3'>
            <h5><strong>".$program_name."</strong></h5>
            <h5>Current Level: <strong>".$levelName."</strong></h5>
            <h5>Please select a level:</h5>";
             
                    if($level ){
                      foreach($level as $row){
                          $output .= '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="'.base_url().'ADMS/tagFolderV/'.$row->levelID.'/'.$areaID.'/'.$programID.'"  class="btn cstm-btn-navy btn-block"><strong>'.$row->levelName.'</strong></a></li>';
                      } 
                  }else{
                    $output .= '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="#" class="btn btn-block"><strong>Sorry, there is no level to show.</strong></a></li>';
                  }
             
                  
                 
                  $output .= "</div>";
            return $output;
   }

   public function programModalM($programID,$programName,$currentLevel,$level_id){
    $level = $this->ADMSM->showLevelsM(); 

    $output = "";

    $output .= "<div class='modal-header cstm-modal-header'  >
          <h5 class='modal-title'><strong>".$programName."</strong></h5>
              <button type='button' class='close' data-dismiss='modal' style='color:white' aria-label='Close'>&times;</button>
              
          </div>
          <div class='modal-body mb-3'>
          <h5>Current Level: <strong>".$currentLevel."</strong></h5>
          <h5>Please select a level:</h5>";
           
                  if($level ){
                    foreach($level as $row){
                        $output .= '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="'.base_url().'ADMS/programsV/'.$row->levelID.'/'.$programID.'"  class="btn cstm-btn-navy btn-block"><strong>'.$row->levelName.'</strong></a></li>';
                    } 
                }else{
                  $output .= '<li class="nav-item mb-1 mt-1" style="list-style:none"><a href="#" class="btn btn-block"><strong>Sorry, there is no level to show.</strong></a></li>';
                }
           
                
               
                $output .= "</div>";
          return $output;
   }

    public function totalFolderM($levelID){
    
      $totalFolder = array();
      $rows =  $this->showAssignedAreaM();

       foreach($rows as $row){
        $area = $row['id'];
        $programID = $row['program'];

         $num_rows = $this->db->select('*')->from('usersfolder')->where(array('area'=> $area, 'program' => $programID,'level' =>$levelID))->get()->num_rows();
             
         array_push($totalFolder,$num_rows);
         
       }

       return $totalFolder;
    }

  
    public function areaM($areaID){
      
       return $this->db->select('*')->from('areas')->where(array('id'=> $areaID))->get()->row_array();

    }

    public function totalFolderM2($areaID,$programID){
    
      return $this->db->select('*')->from('usersfolder')->where(array('area'=> $areaID, 'program' => $programID))->get()->num_rows();
        
  }

 
    public function folderListM($levelID,$areaID,$programID){
    
       return $this->db->select('*')->from('usersfolder')->where(array('area'=> $areaID,'program' => $programID,'level' => $levelID))->order_by('letter', 'ACS')->get()->result_array();
  
  }
  public function createTagFolderM($levelID,$folderName,$areaID,$programID){

    $num = $this->db->select('*')->from('usersfolder')->where(array('area' => $areaID ,'name' => $folderName,'program' => $programID,'level' => $levelID,))->get()->num_rows();
    $n = '';
           

    if($num == 0){
               
    $this->db->insert('usersfolder', array('name' => $folderName,'area' => $areaID,'letter' => $n,'program' => $programID,'level' => $levelID));
    redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully created !!!</strong></div>");
    
  }else{
      redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."?m=<div class='text-center alert alert-danger'><strong> That folder already existed !!!</strong></div>");
  }
    
  }

  public function totalUserFolderM($levelID,$areaID,$programID){
    $totalUserFolder = array();
    $rows = $this->folderListM($levelID,$areaID,$programID);

    foreach($rows as $row){
      $usersFolder = $row['usersFolderID'];
      $program =  $row['program'];
      $num_rows = $this->db->select('*')->from('userssubfolder')->where(array('usersfolder'=> $usersFolder,'program' => $program,'level' => $levelID))->get()->num_rows();

      array_push($totalUserFolder,$num_rows);

    }

    return $totalUserFolder;

  }

  public function renameTagFolderM($levelID,$folderName,$usersFolderID,$areaID,$programID){
    $query = $this->db->update('usersfolder', array('name' => $folderName), array('usersFolderID' => $usersFolderID));

    if($query){
      redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully renamed !!!</strong></div>");
    }
    else{
      redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
    }


  }

  public function deleteTagFolderM($levelID,$folderID,$areaID,$programID){
    $query = $this->db->delete('usersfolder', array("usersFolderID" => $folderID));

    if($query){
      redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully deleted !!!</strong></div>");
    }
    else{
      redirect(base_url()."ADMS/tagFolderV/".$levelID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
    }
  }
   
  
  
  public function breadCrumbM($usersFolderID){

      return $this->db->select('name,area,letter')->from('usersfolder')->where(array('usersFolderID' => $usersFolderID))->get()->row_array();

  }

  public function subFolderListM($usersFolderID,$programID){
    
    return $this->db->select('*')->from('usersSubFolder')->where(array('usersFolder'=> $usersFolderID,'program' => $programID))->order_by('folderNum', 'ACS')->get()->result_array();
      
}

  public function getSubFolderM($subID){

    return $this->db->select('subName')->from('usersSubFolder')->where('subID',$subID)->get()->row()->subName;

  }

public function subFolderM($subFolderID){
  return $this->db->select('*')
                  ->from('userssubFolder')
                  ->join('usersFolder','userssubfolder.usersFolder = usersFolder.usersFolderID')
                  ->where(array('subID'=> $subFolderID))->get()->row();

}

  public function createSubFolderM($levelID,$usersFolderID,$areaID,$folderName,$programID){

    $num = $this->db->select('*')->from('userssubFolder')->where(array('usersFolder'=> $usersFolderID, 'subName' => $folderName,'program' => $programID,'level' => $levelID))->get()->num_rows();

        if($num == 0){
              
            $this->db->insert('userssubFolder', array('subName' => $folderName,'usersFolder' => $usersFolderID,'program' => $programID,'folderNum' => 0,'level' => $levelID));
            redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully created !!!</strong></div>");
        

      }else{
          redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
          
      }
  }

  public function subFolderNumM($usersFolderID,$programID){

     return $this->db->select('*')->from('usersSubFolder')->where(array('usersFolder'=> $usersFolderID,'program' => $programID))->get()->num_rows();
  }

  public function totalFilesM($usersFolderID,$programID){
    
    $totalFiles = array();
    $rows =  $this->subFolderListM($usersFolderID,$programID); 

  
     foreach($rows as $row){
      $subID = $row['subID'];
       $num_rows = $this->db->select('id')->from('tags')->where(array('targetpath'=> $subID))->get()->num_rows();
           
       array_push($totalFiles,$num_rows);
       
     }

     return $totalFiles;
  }

  public function totalSubfoldersM($levelID,$areaID, $programID){
    $totalSubfolders = array();
    $rows =  $this->showUsersFolderM($levelID,$areaID, $programID); 

    foreach($rows as $row){
        $usersFolderID = $row['usersFolderID'];
        
       $num_rows = $this->db->select('*')->from('userssubfolder')->where(array('usersfolder'=> $usersFolderID,'program' =>  $programID,'level' => $levelID))->get()->num_rows();
           
       array_push($totalSubfolders,$num_rows);
       
     }

     return $totalSubfolders;
    
  }

  public function renameSubFolderM($levelID,$usersFolderID,$areaID,$folderName,$subID,$programID){
    

   
    if($this->db->update('userssubfolder', array('subName' => $folderName), array('subID' => $subID,'level' => $levelID))){
              
      redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully renamed !!!</strong></div>");
  

    }else{
        redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
    
}
  }

  public function deleteSubFolderM($levelID,$usersFolderID,$areaID,$folderID,$programID){
    $query = $this->db->delete('userssubfolder', array("subID" => $folderID, "usersFolder" => $usersFolderID));

    if($query){
      redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-success'><strong> Folder successfully deleted !!!</strong></div>");
    }
    else{
        redirect(base_url()."ADMS/tagFolderV2/".$levelID."/".$usersFolderID."/".$areaID."/".$programID."?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
    }
  }

 
  
  public function tagFilesListM($subFolderID){
  
        return $this->db->select('files.id as fileID,tags.id as tagID,files.fileName,files.path,tags.tagNum')
                    ->from('files')
                    ->join('tags', 'tags.fileName = files.id')
                    ->where('tags.targetPath',$subFolderID)
                    ->where('files.status','notArchived')
                    ->order_by('tags.tagNum', 'ACS')
                    ->get()->result_array();
  }

  public function deleteComM($id){
    
    $row = $this->db->select('*')->from('comments')->where(array('comID'=> $id))->get()->row();
    $fileID = $row->file;
    $content = $row->content;
    $comUser = $row->comUser;
    $this->db->delete('comments', array("comID" => $id));
    $this->db->delete('notification', array("category" => "comment", "fileID" => $fileID, "title" => $content, "usersID" => $comUser));
    
  }
  
  public function editComModalM($comID){
    
    $row = $this->db->select('content')->from('comments')->where(array('comID'=> $comID))->get()->row();
    $output = $row->content;
			return '<textarea name="content2" id="content2" class="form-control rounded-4" required>'.$output.'</textarea>';
}

  public function editAssessModalM($assessID){
    
    $row = $this->db->select('content')->from('assessment')->where(array('assessID'=> $assessID))->get()->row_array();
    $output = $row['content'];
			return '<textarea name="content3" id="content3" class="form-control rounded-4" required>'.$output.'</textarea>';
  }

  public function editAssessGenModalM($assessID){
    $row = $this->db->select('content')->from('assessment')->where(array('assessID'=> $assessID))->get()->row_array();
    $output = $row['content'];

    return '<textarea name="content3" id="content3" style="height:300px" class="form-control rounded-4" required>'.$output.'</textarea>';
    
  }

  public function editComM($comID,$content){

    $this->db->update('comments', array('content' => $content), array('comID' => $comID));
      
}

  public function getFolderM($fileID){
    
    $row = $this->db->select('path')->from('files')->where(array('id'=> $fileID))->get()->row();
    return $row->path;
} 

public function getFolderM2($programID){
    
  $row = $this->db->select('*')->from('programs')->where(array('programID'=> $programID))->get()->row();
  return $row->programName;
} 

public function getFileNameM($fileID){
    
  $row = $this->db->select('fileName')->from('files')->where(array('id'=> $fileID))->get()->row();
  return $row->fileName;
}
public function getFileNameM2($levelID,$programID,$fileID){
    
  $row = $this->db->select('fileName')->from('evaluation_file')->where(array('fileID' => $fileID,'levelID'=> $levelID,'path' => $programID))->get()->row();
  return $row->fileName;
}

  public function showArchiveFilesM(){

  return $this->db->select('*')->from('files')->where(array('status'=> 'archived'))->get()->result_array();

}

public function overAllFolderM($levelID,$programID){
    
  $overAllFolder = array();
  $id = 1;
   while($id < 11){
    
     $num_rows = $this->db->select('*')->from('usersfolder')->where(array('area'=> $id++,'program' => $programID,'level' => $levelID,))->get()->num_rows();
         
     array_push($overAllFolder,$num_rows);
     
   }

   return $overAllFolder;
}

public function untagM($leveleID,$tagID,$subFolderID,$folderNum,$areaID,$usersFolderID,$name,$programID){

  $query = $this->db->delete('tags', array("id" => $tagID));

  if($query){
    redirect(base_url()."ADMS/insideSubfolderV/".$leveleID."/".$subFolderID."/".$folderNum."/".$areaID."/".$usersFolderID."/".$programID."?name=".$name."&m=<div class='text-center alert alert-success'><strong> File successfully untagged !!!</strong></div>");
  }
  else{
    redirect(base_url()."ADMS/insideSubfolderV/".$leveleID."/".$subFolderID."/".$folderNum."/".$areaID."/".$usersFolderID."/".$programID."?name=".$name."&m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
  }

}

public function detailsTagM($subID,$fileID){

  $row = $this->db->select('files.fileName,users.Fname,users.Lname,users.Mname,tags.date,tags.time')
  ->from('users')
  ->join('tags', 'users.usersID = tags.tagger')
  ->join('files', 'files.id = tags.fileName')
  ->where(array('tags.targetPath' => $subID, 'files.id' => $fileID))->get()->row_array();
  $output = '';
           $output .= '  
                     <div class="table-responsive">  
                          <table class="table table-bordered">';  
                           $output .= '
                           <tr>
                               <th scope="row"> File Name:</th>
                               <td>'.$row['fileName'].'</td>
                           </tr>
                           
                           <tr>
                             <th scope="row"> Tagged by:</th>
                           <td>'.$row['Fname'].'  '.$row['Mname'].' '. $row['Lname'].'</td>
                           </tr>
                           <tr>
                             <th scope="row"> Time tagged:</th>
                           <td>'.$row['time'].'</td>
                           </tr>
                           <tr>
                             <th scope="row"> Date tagged:</th>
                           <td>'.$row['date'].'</td>
                           </tr>
                       
                           </table></div>';  
                     return $output;  
}

public function totalNumFileM($subFolderID){

  return $this->db->select('id')->from('tags')->where(array('targetpath'=> $subFolderID))->get()->num_rows();
}



public function deleteFileInArchiveM($id){

  $path = $this->db->select('fileName')->from('files')->where(array('id' => $id))->get()->row();
  $file = $path->fileName;
  
  chdir("uploads/Archive");

  if(file_exists($file)){
  
    if(unlink($file)){
      
       $this->db->delete('files', array("id" => $id));
       redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-success'><strong> File successfully deleted !!!</strong></div>");
   
    }else{

      redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");
     
       
    }
}

 
}

public function editAssessM($assessID,$content){

    $this->db->update('assessment', array('content' => $content), array('assessID' => $assessID));

}

public function editAssessGenM($assessID,$content){

  $this->db->update('assessment', array('content' => $content), array('assessID' => $assessID));

}


public function deleteAssessM($assessID){
  $this->db->delete('assessment', array("assessID" => $assessID));

}
public function totalNotifyM(){

  $usersID = $_SESSION['usersID'];
  $num = $this->db->select('*')
                  ->from('notification')
                  ->join('notify', 'notify.notifyID = notification.notifyID')
                  ->where('notify.status','unopened')
                  ->where('notify.usersID', $usersID)
                  ->order_by('noteID', 'DESC')
                  ->get()->num_rows();
  if($num == 0)
    return;
  else
    return $num;

}

public function fetchNotificationM(){

           $usersID = $_SESSION['usersID'];
            $num = 0;
            $output="";
            $link = base_url()."ADMS/foldersV";
           
            $sql2 = $this->db->select('notification.notifyID,notification.category,notification.date,notification.time,notification.fileID,notification.usersID as user,notification.title,notify.noteID,notify.notifyID,notify.usersID,notify.status,notification.assignTaskID')
                    ->from('notification')
                    ->join('notify', 'notify.notifyID = notification.notifyID')
                    ->where(array('notify.usersID' => $usersID, 'notify.status' => 'unopened'))->order_by('noteID', 'DESC')->limit(5)->get()->result_array();

            $number = $this->db->select('*')
                    ->from('notification')
                    ->join('notify', 'notify.notifyID = notification.notifyID')
                    ->where(array('notify.usersID' => $usersID))->order_by('noteID', 'DESC')->get()->num_rows();

         
            
            

          if($number == 0)
              $num = null;
          else
            $num = $number;


            
                foreach($sql2 as $row2){

                  $fileID = $row2['fileID'];
                  $noteID = $row2['noteID'];
                  $IDuser = $row2['user'];
                  $title =  $row2['title'];

                  if($row2['assignTaskID'] != null){

                    $assignTaskID =  $row2['assignTaskID'];
                    $sql7 = $this->db->select('program')->from('assigntask')->where(array('id'=> $assignTaskID))->get()->row();
                    
                    if($sql7){
                      $programID = $sql7->program;
                      $sql8 = $this->db->select('programName')->from('programs')->where(array('programID'=> $programID))->get()->row();
                      $title2 = $title.''.$sql8->programName;
                    }else {
                      $this->db->delete('notification', array("assignTaskID" => $assignTaskID));

                    }
                       
                  }
                  
                  
                
                  $sql6 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $IDuser))->get()->row();
                  $person = $sql6->Fname.' '.$sql6->Lname;
                  
                  if($row2['status'] == 'unopened'){
                    if($row2['category'] == 'upload'){

                        $sql4 = $this->db->select('path,fileName,uploader,status')->from('files')->where(array('id'=> $fileID))->get()->row();
                        $location = $sql4->path;
                        $user = $sql4->uploader;
                        $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                        $sql5 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $user))->get()->row();
                        $uploader = $sql5->Fname.' '.$sql5->Lname;
                        if($sql4->status == 'archived'){
                              
                              $this->db->delete('notification', array("fileID" => $fileID));
                              $num--;
                              continue;
                        }
                        else{
                            echo '
                            <div class="alert-primary"><a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong >'.$uploader.'</strong>  uploaded a file in<br> folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                            ';
                      }
                    }elseif($row2['category'] == 'assign'){
                        
                            echo '
                            <div class="alert-primary "><a href="'.base_url().'ADMS/myAssignedAreaV" class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" > The Admin assigned <strong>you</strong> to <br> Area <strong>'.wordwrap($title2,40,"<br>").'</strong><br><span class="dateSize text-rigj">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                            ';
                        
                    }elseif($row2['category'] == 'comment'){
                      $sql4 = $this->db->select('path,fileName,uploader')->from('files')->where(array('id'=> $fileID))->get()->row();
                      $location = $sql4->path;
                      $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                    
                      
                      echo '<div class="alert-primary"><a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"> <strong>'.$person.'</strong>  commented on a file from <br>folder  <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                      ';
                    }elseif($row2['category'] == 'deleteAll'){
                            echo '
                            <div class="alert-primary"><a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted Folder<br> <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                            ';
                   }else{
                            echo '
                            <div class="alert-primary"><a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted a file from <br>Folder <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a></div> <div class="dropdown-divider "></div>
                            ';
                    }
                  
            }
            else{
              if($row2['category'] == 'upload'){
                
                          $sql4 = $this->db->select('path,fileName,uploader,status')->from('files')->where(array('id'=> $fileID))->get()->row();
                          $location = $sql4->path;
                          $user = $sql4->uploader;
                          $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                          $sql5 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $user))->get()->row();
                          $uploader = $sql5->Fname.' '.$sql5->Lname;
                          
                  if($sql4->status == 'archived'){
                            $num--;
                           continue;
                      }
                    else{
                      echo '
                      <a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong >'.$uploader.'</strong>  uploaded a file in<br> folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a>
                      ';
                      }
              }elseif($row2['category'] == 'assign'){
                   
                echo '
                <a data-toggle="modal" data-target="#myAssignedArea" class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" > The Admin assigned <strong>you</strong> to <br> Area <strong>'.wordwrap($title2,40,"<br>").'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a><div class="dropdown-divider "></div>
                ';
              }elseif($row2['category'] == 'comment'){
                
                $sql4 = $this->db->select('path,fileName,uploader')->from('files')->where(array('id'=> $fileID))->get()->row();
                $location = $sql4->path;
                $view = base_url()."ADMS/viewV/$fileID?folder=$location";
                $sql6 = $this->db->select('Fname,Lname')->from('users')->where(array('usersID'=> $IDuser))->get()->row();
                $person = $sql6->Fname.' '.$sql6->Lname;
                
                echo '<a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$view.'"><strong>'.$person.'</strong>  commented on a file from <br>folder <strong>'.$location.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                            ';
              }elseif($row2['category'] == 'deleteAll'){
                    echo '
                    <a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted Folder<br> <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                    ';
             }else{
                          echo '
                          <a class="noteID notify dropdown-item py-2 point" id="'.$noteID.'" style="text-decoration:none" href="'.$link.'"><strong>'.$person.'</strong>  deleted a file from <br>Folder <strong>'.$title.'</strong><br><span class="dateSize">'.$row2['date'].'  '.$row2['time'].'</span></a> <div class="dropdown-divider "></div>
                          ';
                  }
             
                  } 
           }

                if($num == null)
                    $output .='  <a class="see2 notify dropdown-item text-center"  href="#"><strong> No Notification </strong></a>';
                else
                    $output .= ' <a class="see notify dropdown-item py-2 text-center"  href="'.base_url().'ADMS/allNotifyV"><strong> See All Notification </strong></a>';


            echo $output;
            
            

  
  
	
    }




public function setOpenM($noteID){

    $this->db->update('notify', array('status' => 'opened'), array('noteID' => $noteID));
  
} 

public function allNotifyM(){

  $usersID = $_SESSION['usersID'];

  return $this->db->select('notification.notifyID,notification.category,notification.date,notification.time,notification.fileID,notification.usersID as user,notification.title,notify.noteID,notify.notifyID,notify.usersID,notify.status,notification.assignTaskID')
                    ->from('notification')
                    ->join('notify', 'notify.notifyID = notification.notifyID')
                    ->where(array('notify.usersID' => $usersID))->order_by('noteID', 'DESC')->get()->result_array();
} 

public function deleteNotifyM(){
  
  $usersID = $_SESSION['usersID'];
  $this->db->delete('notify', array("usersID" => $usersID));

  $sql4 = $this->db->select('*')->from('notify')->get()->num_rows();
  
  if($sql4 == 0)
      $this->db->empty_table('notification');
    
  redirect(base_url()."ADMS/allNotifyV?m=<div class='text-center alert alert-success'><strong> All of your notifications are successfully deleted !!!</strong></div>");
  
}

public function markAllM(){
  
  $usersID = $_SESSION['usersID'];
  $this->db->update('notify', array('status' => 'opened'), array('usersID' => $usersID));
  redirect(base_url()."ADMS/allNotifyV");
	
}

public function restoreM($folder,$fileID){
          $stmt = $this->db->select('fileName')->from('files')->where(array('id' => $fileID))->get()->row();
          $file = $stmt->fileName;
          $source = 'Archive/'.$file;
          $target = $folder.'/'.$file;
          chdir("uploads");
          
        if(file_exists($source) && !file_exists($target)){
          
          if(copy($source,$target)){
            
            if(unlink($source)){ 

              $stmt2 = $this->db->update('files', array('path' => $folder, 'status' => 'notArchived'), array('id' => $fileID));

          if($stmt2){

              redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-success'><strong> File successfully restored !!!</strong></div>");
                    
          }else{
              redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-danger'><strong> SQL Error !!!</strong></div>");
                
              }
        }else{
              redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-danger'><strong> not Unlink !!!</strong></div>");
        }
          }else{
            redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-danger'><strong> Not copied !!!</strong></div>");
          }
        }else{
            redirect(base_url()."ADMS/archivePageV?m=<div class='text-center alert alert-danger'><strong>That file already existed in your desired folder!!!</strong></div>");
        }
}

    public function saveNewPositionsM($positions){
          $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
          foreach($positions as $position){
              $index = $position[0];
              $newPosition = $position[1];

             $this->db->update('usersfolder', array('num' => $newPosition, 'letter' => $alphabet[$newPosition-1]), array('usersFolderID' => $index));

        }
    }

    public function saveNewPositionsM2($positions){
      foreach($positions as $position){
          $index = $position[0];
          $newPosition = $position[1];

         $this->db->update('userssubfolder', array('folderNum' => $newPosition), array('subID' => $index));

    }
}

    public function saveNewPositionsM3($positions){
      foreach($positions as $position){
          $index = $position[0];
          $newPosition = $position[1];

        $this->db->update('tags', array('tagNum' => $newPosition), array('id' => $index));

      }
    }

    public function saveNewPositionsM4($positions){
      $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

      foreach($positions as $position){
          $index = $position[0];
          $newPosition = $position[1];

        $this->db->update('files', array('time' => $alphabet[$newPosition-1]), array('id' => $index));

      }
    }

    public function saveNewPositionsM5($positions){
      foreach($positions as $position){
          $index = $position[0];
          $newPosition = $position[1];

        $this->db->update('level', array('num' => $newPosition), array('levelID' => $index));

      }
    }

    public function saveNewPositionsM6($positions){
      foreach($positions as $position){
          $index = $position[0];
          $newPosition = $position[1];

        $this->db->update('programs', array('num' => $newPosition), array('programID' => $index));

      }
    }

    public function sliderM(){
      return $this->db->select('*') ->from('files')->where(array('path' => 'slider'))->order_by('time', 'ACS')->get()->result();
  }

  public function showProgramsM(){
    return $this->db->select('*') ->from('programs')->order_by('num', 'ACS')->get()->result();
  }

  public function showProgramNameM($programID){
    return $this->db->select('programName') ->from('programs')->where('programID', $programID)->get()->row();
  }

  public function addProgramM($programName,$level){
      //  if( $this->db->insert('programs', array('programName' => $programName))){

      //         redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-success'><strong> Program successfully added !!!</strong></div>");
      //  }else  
      //      redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");
    $check = $this->db->select('*')->from('programs')->where('programName',$programName)->get()->num_rows();
       
      if($check == 0){
        $this->db->insert('programs', array('programName' => $programName,'levelID' => $level));
        $this->ADMSM->createFolderM2($programName);
           $row = $this->ADMSM->showLevelsM();
            $last = $this->db->select('*')->from('programs')->order_by('programID', 'DESC')->limit(1)->get()->row();
          
            foreach($row as $level){
              // $this->db->insert('programLevel', array('level' => $level->levelID,'program' => $last->programID));

              for ($i=1; $i < 11; $i++) { 
 
                if($this->db->insert('usersfolder', array('name' => '(Give this a label)','area' => $i,'letter' => 'A','program' => $last->programID,'level' => $level->levelID))){
  
                      $last2 = $this->db->select('*')->from('usersfolder')->order_by('usersfolderID', 'DESC')->limit(1)->get()->row();
                       $this->db->insert('userssubFolder', array('subName' => '(Give this a sub label)','usersFolder' => $last2->usersFolderID,'program' => $last->programID,'folderNum' => 1,'level' => $level->levelID));
  
                }
              
            }
 
            }
                  
              redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-success'><strong> Program successfully added !!!</strong></div>");
             

  }else if ($check != 0){
    redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> That program already existed!!!</strong></div>");

  }else
           redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");

}
 
  

  public function deleteProgramM($programID){
    $program= $this->db->select('*')->from('programs')->where('programID',$programID)->get()->row();

    if( $this->db->delete('programs', array('programID' => $programID))){
      $this->ADMSM->deleteFolderM2($program->programName,$programID);
      redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-success'><strong> Program successfully deleted !!!</strong></div>");
    }
     else  
        redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");

}

  public function renameProgramM($programID,$programName){
    $program= $this->db->select('*')->from('programs')->where('programID',$programID)->get()->row();

    if( $this->db->update('programs', array('programName' => $programName), array('programID' => $programID))){
     
        $this->ADMSM->renameFolderM2($programName,$program->programName);
        redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-success'><strong> Program successfully renamed !!!</strong></div>");
    }
       
    else  
        redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");

  }

  public function checkLevelM(){
    return $this->db->select('*') ->from('level')->get()->num_rows();

  }
  public function checkProgramM(){
    return $this->db->select('*') ->from('programs')->get()->num_rows();

  }
  public function showLevelsM(){
    return $this->db->select('*') ->from('level')->order_by('num', 'ACS')->get()->result();
  }
  public function selectedLevelM($levelID){
    return $this->db->select('*') ->from('level')->where('levelID',$levelID)->get()->row();
  }

  public function addLevelM($levelName){
    $check = $this->db->select('*')->from('level')->where('levelName',$levelName)->get()->num_rows();
    if( $this->ADMSM->checkLevelM() == 0){
          $this->db->insert('level', array('levelName' => $levelName));
           redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-success'><strong> Level successfully created !!!</strong></div>");
    }else if($this->ADMSM->checkLevelM() > 0){
        $row = $this->ADMSM->showProgramsM();
        if($check != 0) 
             redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-danger'><strong> Level already existed !!!</strong></div>");
       else{
          $this->db->insert('level', array('levelName' => $levelName));
       }
        $last = $this->db->select('*')->from('level')->order_by('levelID', 'DESC')->limit(1)->get()->row();

        foreach($row as $program){
          // $this->db->insert('programLevel', array('level' => $last->levelID,'program' => $program->programID));
         
              for ($i=1; $i < 11; $i++) { 
    
                if($this->db->insert('usersfolder', array('name' => '(Give this a label)','area' => $i,'letter' => 'A','program' => $program->programID,'level' => $last->levelID))){

                      $last2 = $this->db->select('*')->from('usersfolder')->order_by('usersfolderID', 'DESC')->limit(1)->get()->row();
                      $this->db->insert('userssubFolder', array('subName' => '(Give this a sub label)','usersFolder' => $last2->usersFolderID,'program' => $program->programID,'folderNum' => 1,'level' => $last->levelID));

                }
              
            }
        }
        redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-success'><strong> Level successfully created !!!</strong></div>");

    }
    else
        redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong !!!</strong></div>");

  }

  public function renameLevelM($levelID,$levelName){
    if( $this->db->update('level', array('levelName' => $levelName), array('levelID' => $levelID)))
    redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-success'><strong> Level successfully renamed !!!</strong></div>");
else  
    redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");

  }

  public function deleteLevelM($levelID){
    if($this->db->select('*')->from('programs')->where('levelID',$levelID)->get()->num_rows() > 0){
      redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-danger'><strong> You cannot delete this level because it is a current level in a program. Instead, you can rename it !!!</strong></div>");

    }else{
      if( $this->db->delete('level', array('levelID' => $levelID))){
        // if($this->ADMSM->checkLevelM() == 0){
        //   $this->db->empty_table('programs');
        // }
      
          redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-success'><strong> Level successfully deleted !!!</strong></div>");
      }else  {
          redirect(base_url()."ADMS/manageLevelsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");
  }
    }
    
}

public function setLevelM($levelID,$program_id){

  if($this->db->update('programs', array('levelID' => $levelID),array('programID' => $program_id))){
    
        redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-success'><strong> You have successfully set the level !!!</strong></div>");
  }
  else{
    redirect(base_url()."ADMS/manageProgramsV?m=<div class='text-center alert alert-danger'><strong> Something went wrong!!!</strong></div>");

  }

}


public function currentLevelM(){
  
 
  $checkLevel = $this->db->select('*')->from('level')->get()->result();

  if($checkLevel){
    $currentLevel2 = $this->db->select('*')->from('level')->where('levelID',$currentLevel->level)->get()->row();
    return $currentLevel2->levelID;
  }
      
  else if(!$checkLevel){
       return 0;
  } else{

      $last = $this->db->select('*')->from('level')->order_by('levelID', 'DESC')->limit(1)->get()->row();

      return $last->levelID;
  
}


}
public function programCurrLevelM($levelID){
  if($levelID == null)
      return 'no current level';
  else{
    $currentLevel = $this->db->select('*')->from('level')->where('levelID',$levelID)->get()->row();
    return $currentLevel->levelName;
  }
  
}

// public function programLevelM(){
   
//   $currentLevel = $this->db->select('*')->from('setlevel')->get()->row();
//   if($currentLevel){
//        $currentLevel2 = $this->db->select('*')->from('level')->where('levelID',$currentLevel->level)->get()->row();
//        return $currentLevel2->levelName;
//   }else
//       return 'There is no level at the moment. You must create a level first. Thank You.';
// }

public function programsM(){
  $user = $this->userM();
  $assignedPrograms = $this->db->select('*')->from('assigntask')->where('user',$user->usersID)->get()->result();


}



}//end of class
?>