<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADMS extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['usersID'])){
			redirect(base_url()."ADMS/homePageV");     
		  } 
	    else
			$this->load->view('indexV');
	}

 	public function logInV()
	{
		
			$this->load->view('logInV');
	}
	public function commentSectionV()
	{
		
			$this->load->view('commentSectionV');
	}

	public function starter(){
		$this->load->view('starter');

	}
	
	public function logInM()
	{
		if(isset($_POST['logIn'])){
            $username = $_POST['username'];
			$password = $_POST['password'];

			$this->ADMSM->logInM($username,$password);
			
		}
		else
			die("Unauthorized Access...");
	}
	

	public function homePageV()
	{
		$data['user'] = $this->ADMSM->userM();
		$data['slider'] = $this->ADMSM->sliderM();
		
		$this->load->view('homePageV',$data);
	}

	public function manageSliderV()
	{
		$data['user'] = $this->ADMSM->userM();
		$data['slider'] = $this->ADMSM->sliderM();
		
		$this->load->view('manageSliderV',$data);
	}

	public function logOutM()
	{
		if(isset($_SESSION['usersID']))
			$this->ADMSM->logOutM();
		else
			die("Unauthorized Access...");

	}
	
	public function adminManageAccountPageV()
	{
		$data['list'] = $this->ADMSM->manageListM();		
		$data['user'] = $this->ADMSM->userM();
		$this->load->view('adminManageAccountPageV',$data);
	}

	public function adminManageAccountPageV2()
	{
		$data['list'] = $this->ADMSM->manageListM();		
		$data['user'] = $this->ADMSM->userM();
		$this->load->view('adminManageAccountPageV2',$data);
	}
	
	public function adminInsertFieldModalM()
	{
		if(isset($_POST['usersID'])){
			$got_usersID = $_POST['usersID'];
			$row = $this->ADMSM->adminInsertFieldModalM($got_usersID);
		}
		echo json_encode($row);
	}
	public function addAccountM()
	{
		if(isset($_POST['submit'])){
			$Fname = $_POST['Fname'];
			$Mname = $_POST['Mname'];
			$Lname = $_POST['Lname'];
			// $username = $_POST['username'];
			$userType = $_POST['userType'];
			$password = 12345;
			$row = $this->ADMSM->addAccountM($Fname,$Mname,$Lname,$Fname,$password,$userType);
			
		}
		else
			die("Unauthorized Access...");
	}

	public function deactivateM(){

		if(isset($_POST['deactivatebutton']))
		{
			$deactivate = $_POST['idToDeactivate'];
			$this->ADMSM->deactivateM($deactivate);
		
		}else
			die("Unauthorized Access...");
	}

	public function activateM(){

		if(isset($_POST['activatebutton']))
		{
			$activate = $_POST['idToActivate'];
			$this->ADMSM->activateM($activate);
		
		}else
			die("Unauthorized Access...");
	}

	

	public function editAccountM(){
		if(isset($_POST['submit'])){

			$Fname = $_POST['Fname'];
			$Mname = $_POST['Mname'];
			$Lname = $_POST['Lname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confrimPassword = $_POST['confirmPassword'];

			$this->ADMSM->editAccountM($Fname,$Mname,$Lname,$username,$password,$confrimPassword);

		}else
			die("Unauthorized Access...");
	}
	
	public function updateUserM(){

		if(isset($_POST['updatebutton']))
		{
			$usersID  = $_POST['usersID'];
			$Fname = $_POST['Fname'];
			$Mname = $_POST['Mname'];
			$Lname = $_POST['Lname'];
			$userType = $_POST['userType'];
			
			$this->ADMSM->updateUserM($Fname,$Mname,$Lname,$usersID,$userType);

		}else
			die("Unauthorized Access...");
	}

	public function foldersV(){
		
		$data['user'] = $this->ADMSM->userM();
		$this->load->view('foldersV',$data);
	}

	public function createFolderM(){

		if(isset($_POST["submit"])){

			$folderName = $_POST["folderName"];
			$this->ADMSM->createFolderM($folderName);

		}else
			die("Unauthorized Access...");
	}

	public function renameFolderM(){

		if(isset($_POST["submit"])){
            $newName = $_POST["folder_name"];
			$oldName = $_POST["old_name"];
			$this->ADMSM->renameFolderM($newName,$oldName);
			
            
		}else
			die("Unauthorized Access...");
	}

	public function deleteFolderM(){
		if(isset($_POST["submit"])){
      
			$folderName = $_POST["name"];
			$this->ADMSM->deleteFolderM($folderName);

		}else
			die("Unauthorized Access...");
	}

	public function uploadFileM(){
		$folder = $_POST["hidden_folder_name"];
		$check = $_POST["check"];
		$file = $_FILES["upload_file"]["name"];
		$tempFile = $_FILES["upload_file"]["tmp_name"];
			
		if($_FILES["upload_file"]["size"] > 217221329 ){
			if($check == 'true')

                redirect(base_url()."ADMS/insideFolderV?folder=".$folder."&m=<div class='text-center alert alert-danger'><strong> The file must not be more than 200 MB!!!</strong></div>");
            else
               redirect(base_url()."ADMS/foldersV?m=<div class='text-center alert alert-danger'><strong> The file must not be more than 200 MB !!!</strong></div>");
		}else{
		if(isset($_POST['submit'])){
			$this->ADMSM->uploadFileM($file,$folder,$tempFile,$check);
		}else
			die("Unauthorized Access...");
		}
		// echo $_FILES["upload_file"]["size"];
	}

	public function uploadFileM2(){
	
		$file = $_FILES["upload_file"]["name"];
		$tempFile = $_FILES["upload_file"]["tmp_name"];
		
	if(isset($_POST['submit'])){
		
		$this->ADMSM->uploadFileM2($file,$tempFile);
	}else
		die("Unauthorized Access...");
	
}
public function uploadFileM3($levelID,$programID){
	
	$file = $_FILES["upload_file"]["name"];
	$tempFile = $_FILES["upload_file"]["tmp_name"];
	$folder = $_POST["hidden_folder_name"];
	
	
if(isset($_POST['submit'])){
	
	$this->ADMSM->uploadFileM3($levelID,$programID,$file,$tempFile,$folder);
}else
	die("Unauthorized Access...");

}

	public function tagFileM(){
		$folderName = $_POST["folder-name"];
		if(isset($_POST["folders"])){
           $subID = $_POST["folders"];
		   $sourcePath = $_POST["sourcePath"];
		   
		   
		   $this->ADMSM->tagFileM($subID, $sourcePath,$folderName);
		}else{
           redirect(base_url()."ADMS/insideFolderV?folder=".$folderName."&m=<div class='text-center alert alert-danger'><strong> You have to select at least one folder to tag file !!!</strong></div>");
		}
			
	}
	
	public function archiveAllM(){
		if(isset($_POST['submit'])){
			$folder = $_POST["file_name"];
			$this->ADMSM->archiveAllM($folder);
		}else
			die("Unauthorized Access...");

	}
	
	public function insideFolderV(){
		$folder = $_GET['folder'];
		$data['user'] = $this->ADMSM->userM();			
		$data['filesList'] = $this->ADMSM->filesListM($folder);
		$data['folder'] = $folder;
		// $data['selectTag'] = $this->ADMSM->selectTagM();
		$data['num'] = $this->ADMSM->numTagM();
		$data['checkLevel'] = $this->ADMSM->checkLevelM();
		$data['areaAssignedM'] = $this->ADMSM->areaAssignedM();
		$data['checkTask'] = $this->ADMSM->checkTaskM();
		
		
		
		$this->load->view('insideFolderV',$data);
	}

	public function finalEvaluateV($levelID,$programID){
		$data['user'] = $this->ADMSM->userM();			
		$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
		$data['filesList'] = $this->ADMSM->filesListM2($levelID,$programID);
		$data['levelID'] = $levelID;
		$data['programName'] = $this->ADMSM->showProgramNameM($programID);
		$data['programID'] = $programID;
		$this->load->view('finalEvaluateV',$data);
	
	 }

	

	public function download(){
		$folder = $_GET['folder'];
		$file = $_GET['file'];

		$this->load->helper('download');
		chdir("uploads/".$folder);

		force_download($file,NULL);

	}
	public function download2(){
		$folder = $_GET['folder'];
		$file = $_GET['file'];

		$this->load->helper('download');
		chdir("uploads2/".$folder);

		force_download($file,NULL);

	}

	public function renameFileInFolderM(){

		if(isset($_POST["submit"])){
			$newName = $_POST["file_name"];
			$oldName = $_POST["old_name"];
			$folder = $_POST["folder_name"];
			$this->ADMSM->renameFileInFolderM($newName,$oldName,$folder);
			
            
		}else
			die("Unauthorized Access...");
	}
	public function renameEvaFileM($levelID,$programID){

		if(isset($_POST["submit"])){
			$newName = $_POST["file_name"];
			$oldName = $_POST["old_name"];
			$folder = $_POST["folder_name"];
			$fileID = $_POST["file_id"];
			$this->ADMSM->renameEvaFileM($newName,$oldName,$folder,$fileID,$levelID,$programID);
			
            
		}else
			die("Unauthorized Access...");
	}

	public function deleteFileM(){
		
		if(isset($_POST["fileID"])){
			
			$fileID = $_POST['fileID'];
			$this->ADMSM->deleteFileM($fileID);

		}else
			die("Unauthorized Access...");

	}
	public function deleteEvaFileM($levelID,$programID){
		if(isset($_POST["fileID"])){
			
			$fileID = $_POST['fileID'];
			$folder = $_POST['folder'];
			$this->ADMSM->deleteEvaFileM($fileID,$levelID,$programID,$folder);

		}else
			die("Unauthorized Access...");

	}
	

	public function deleteFileSliderM(){
		if(isset($_POST["fileID"])){
			
			$fileID = $_POST['fileID'];
			$this->ADMSM->deleteFileSliderM($fileID);

		}else
			die("Unauthorized Access...");

	}

	public function detailsM(){
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$output = $this->ADMSM->detailsM($id);

			echo $output;

		}else
			die("Unauthorized Access...");


	}

	public function archiveFileInFolderM(){
		
		if(isset($_POST["submit"])){
            $file = $_POST['fileName'];
			$folder = $_POST['folderName'];
			
			$this->ADMSM->archiveFileInFolderM($file,$folder);
			
		}else
			die("Unauthorized Access...");

	} 



	public function viewV($fileID){
		$sourceFolder = $this->ADMSM->getFolderM($fileID);
		$fileName = $this->ADMSM->getFileNameM($fileID);
		$data['folderName'] = $_GET['folder'];
		$data['var'] = base_url().'/uploads/'.$sourceFolder.'/'.$fileName;
		$data['id'] = $fileID;

		$this->load->view('viewV',$data);
		
	}
	public function viewV2($levelID,$fileID,$subFolderID,$folderNum,$areaID,$usersFolderID,$programID){
		$data['folderName'] = $this->ADMSM->getSubFolderM($subFolderID);
		$sourceFolder = $this->ADMSM->getFolderM($fileID);
		$fileName = $this->ADMSM->getFileNameM($fileID);
		$data['fileName'] = $fileName;
		$data['var'] = base_url().'/uploads/'.$sourceFolder.'/'.$fileName;
		$data['id'] = $fileID;
		$data['folderNum'] = $folderNum;
		$data['usersFolderID'] = $usersFolderID;
		$data['areaID'] = $areaID;
		$data['subFolderID'] = $subFolderID;
		$data['programID'] = $programID;
		$data['levelID'] = $levelID;

		$this->load->view('viewV2',$data);
	}

	public function viewV3($levelID,$fileID,$areaID,$usersFolderID,$folderNum,$subFolderID,$programID){
		$data['levelID'] = $levelID;
		$data['areaID'] = $areaID;
		$data['folderNum'] = $folderNum;
		$data['programID'] = $programID;
		$data['subFolderID'] = $subFolderID;
		$data['usersFolderID'] = $usersFolderID;
		$data['id'] = $fileID;
		$data['subName'] = $_GET['name'];
		$sourceFolder = $this->ADMSM->getFolderM($fileID);
		$fileName = $this->ADMSM->getFileNameM($fileID);
		$data['user'] = $this->ADMSM->userM();
		$data['var'] = base_url().'/uploads/'.$sourceFolder.'/'.$fileName;

		$this->load->view('viewV3',$data);
	}

	public function viewV4($fileID){
		$sourceFolder = $this->ADMSM->getFolderM($fileID);
		$fileName = $this->ADMSM->getFileNameM($fileID);
		$data['var'] = base_url().'/uploads/'.$sourceFolder.'/'.$fileName;

		$this->load->view('viewV4',$data);
	}
	public function viewV5($levelID,$programID,$fileID){
		$data['levelID'] = $levelID;
		$data['programID'] = $programID;
		$sourceFolder = $this->ADMSM->getFolderM2($programID);
		$fileName = $this->ADMSM->getFileNameM2($levelID,$programID,$fileID);
		$data['var'] = base_url().'/uploads2/'.$sourceFolder.'/'.$fileName;

		$this->load->view('viewV5',$data);
	}


	public function commentM(){
		
			
			if(isset($_POST['fileID'])){
				$fileID = $_POST['fileID'];
				$comment = $_POST['comment'];
				
				$this->ADMSM->commentM($fileID,$comment);
	
			
			}else
				die("Unauthorized Access...");
			
	}

	public function assessmentM(){
		if(isset($_POST['fileID'])){
			$fileID = $_POST['fileID'];
			$assessment = $_POST['assessment'];
			
			$this->ADMSM->assessmentM($fileID,$assessment);

		
		}else
			die("Unauthorized Access...");
	}

	public function assessGenM(){
		if(isset($_POST['assessment'])){
			$assessment = $_POST['assessment'];
			
			$this->ADMSM->assessGenM($assessment);

		
		}else
			die("Unauthorized Access...");
	}

	public function fetchComM(){
		
		if(isset($_POST['id'])){
			$fileID = $_POST['id'];
			$output = $this->ADMSM->fetchComM($fileID);

			 echo $output;

		}else
			die("Unauthorized Access...");


	}

	public function fetchAssessM(){
		if(isset($_POST['id'])){
			$fileID = $_POST['id'];
			$output = $this->ADMSM->fetchAssessM($fileID);

			 echo $output;

		}else
			die("Unauthorized Access...");

	} 

	public function fetchAssessGenM(){
		
		$output = $this->ADMSM->fetchAssessGenM();

		 echo $output;

	} 

	public function assignTaskV(){

		$data['user'] = $this->ADMSM->userM();
		$data['rows'] = $this->ADMSM->showAreasM();
		$data['totalAssign'] = $this->ADMSM->totalAssignedM();
		$data['showUsers'] = $this->ADMSM->showUsersM();
		$data['i'] = 0;
		$data['showPrograms'] = $this->ADMSM->showProgramsM();
		$data['checkLevel'] = $this->ADMSM->checkLevelM();
		$data['checkProgram'] = $this->ADMSM->checkProgramM();


		$this->load->view('assignTaskV',$data);

	}

	public function showAssignedUsersM(){
		
		if(isset($_POST['areaNum'])){
			$areaNum = $_POST['areaNum'];
			$output = $this->ADMSM->showAssignedUsersM($areaNum);

			 echo $output;

		}else
			die("Unauthorized Access...");


	}

	public function assignTaskM(){
		if(isset($_POST["users"])){
			$user = $_POST["users"];
			$program = $_POST["program"];
			$area = $_POST["area"];
			$this->ADMSM->assignTaskM($user,$area,$program);

		}else{
			redirect(base_url()."ADMS/assignTaskV?m=<div class='text-center alert alert-danger'><strong> You must select at least one user to assign task !!!</strong></div>");     
		
		}
	}

	public function deleteTaskM(){
		if(isset($_POST['assigntaskID'])){
			$assigntaskID = $_POST['assigntaskID'];
			$this->ADMSM->deleteTaskM($assigntaskID);
			
		}else
			die("Unauthorized Access...");
	} 
	public function accountSettingPageV(){
		$data['user'] = $this->ADMSM->userM();
		
		$this->load->view('accountSettingPageV',$data);
	}
	
	public function myAssignedAreaV(){
		$data['user'] = $this->ADMSM->userM();
		// $data['totalFolder'] = $this->ADMSM->totalFolderM($levelID);
		$data['showAssignedArea'] = $this->ADMSM->showAssignedAreaM();
		// $data['i'] = 0;
		// $data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
		// $data['levelID']= $levelID;

		
		$this->load->view('myAssignedAreaV',$data);

	}
	public function assignModalM(){
		if(isset($_POST["areaName"]) && isset($_POST["levelID"]) && isset($_POST["areaID"]) && isset($_POST["programID"]) && isset($_POST["levelName"])){
			$areaName = $_POST["areaName"];
			$levelID = $_POST["levelID"];
			$areaID = $_POST["areaID"];
			$programID = $_POST["programID"];
			$levelName = $_POST["levelName"];
			$program_name = $_POST["program_name"];
			
			$output = $this->ADMSM->assignModalM($areaName,$levelID,$areaID,$programID,$levelName,$program_name); 

			echo $output;
		}else
			die("Access forbidden..");   
		
	}

	public function programModalM(){
		if(isset($_POST["programID"]) && isset($_POST["programName"]) && isset($_POST["currentLevel"]) && isset($_POST["level_id"])){
			$programID = $_POST["programID"];
			$programName = $_POST["programName"];
			$currentLevel = $_POST["currentLevel"];
			$level_id = $_POST["level_id"];
			
			
			$output = $this->ADMSM->programModalM($programID,$programName,$currentLevel,$level_id); 

			echo $output;
		}else
			die("Access forbidden..");   
	}

	public function tagFolderV($levelID,$areaID,$programID){
		$data['user'] = $this->ADMSM->userM();
		$data['rows'] = $this->ADMSM->areaM($areaID);
		$data['folderList'] = $this->ADMSM->folderListM($levelID,$areaID,$programID);
		$data['totalUserFolder'] = $this->ADMSM->totalUserFolderM($levelID,$areaID,$programID);
		$data['j'] = 0;
		$data['areaID']= $areaID;
		$data['programID']= $programID;
		$data['levelID']= $levelID;
		$data['programName'] = $this->ADMSM->showProgramNameM($programID);
		$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);

		$this->load->view('tagFolderV',$data);
	}

	public function createTagFolderM($levelID,$areaID,$programID){
		if(isset($areaID)){
			$folderName = $_POST["folderName"];
			$this->ADMSM->createTagFolderM($levelID,$folderName,$areaID,$programID);
		}else{
			die("Access forbidden..");   
		
		}
	}

	public function renameTagFolderM($levelID,$areaID,$programID){
		if(isset($_POST["folder_name"])){
			$folderName = $_POST["folder_name"];
            $usersFolderID = $_POST['usersFolderID'];
			$this->ADMSM->renameTagFolderM($levelID,$folderName,$usersFolderID,$areaID,$programID);
		}else{
			die("Access forbidden..");   
		
		}
	}
	
	public function deleteTagFolderM($levelID,$areaID,$programID){
		if(isset($_POST['folderID'])){
			$folderID = $_POST["folderID"];
           
			$this->ADMSM->deleteTagFolderM($levelID,$folderID,$areaID,$programID);
		}else{
			die("Access forbidden..");   
		
		}
	}



	
	public function tagFolderV2($levelID,$usersFolderID,$areaID,$programID){
		$data['user'] = $this->ADMSM->userM();
		$rows = $this->ADMSM->areaM($areaID);
		$data['areaID']= $areaID;
		$data['usersFolderID']= $usersFolderID;
		$data['bread'] = $this->ADMSM->breadCrumbM($usersFolderID);
		$data['subFolderList'] = $this->ADMSM->subFolderListM($usersFolderID,$programID);
		$data['totalFiles'] = $this->ADMSM->totalFilesM($usersFolderID,$programID);
		$data['j'] = 0;
		$data['programID']= $programID;
		$data['area'] = "Area ".$rows['id']."  ".$rows['areaName'];
		$data['levelID']= $levelID;
		$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
		$data['program'] = $this->ADMSM->showProgramNameM($programID);

		$this->load->view('tagFolderV2',$data);
	}

	public function createSubFolderM($levelID,$usersFolderID,$areaID,$programID){
		if(isset($areaID) && isset($usersFolderID)){
			$folderName = $_POST["folderName"];
			$this->ADMSM->createSubFolderM($levelID,$usersFolderID,$areaID,$folderName,$programID);
			
		}else{
			die("Access forbidden..");   
		
		}
	}

	public function renameSubFolderM($levelID,$usersFolderID,$areaID,$programID){
		if(isset($_POST["folder_name"]) && isset($_POST['subID'])){
			$folderName = $_POST["folder_name"];
            $subID = $_POST['subID'];
			$this->ADMSM->renameSubFolderM($levelID,$usersFolderID,$areaID,$folderName,$subID,$programID);
			
		}else{
			die("Access forbidden..");   
		
		}
	}

	public function deleteSubFolderM($levelID,$usersFolderID,$areaID,$programID){
		if(isset($_POST["folderID"])){
			$folderID = $_POST['folderID'];

			$this->ADMSM->deleteSubFolderM($levelID,$usersFolderID,$areaID,$folderID,$programID);
			
		}else{
			die("Access forbidden..");   
		
		}
	}

	public function insideSubFolderV($levelID,$subFolderID,$folderNum,$areaID,$usersFolderID,$programID){

		$data['folderName'] = $this->ADMSM->getSubFolderM($subFolderID);
		$data['user'] = $this->ADMSM->userM();
		$data['bread'] = $this->ADMSM->breadCrumbM($usersFolderID);
		$data['rows'] = $this->ADMSM->areaM($areaID);
		$data['tagFilesList'] = $this->ADMSM->tagFilesListM($subFolderID);
		$data['folderNum'] = $folderNum;
		$data['usersFolderID'] = $usersFolderID;
		$data['areaID'] = $areaID;
		$data['subFolderID'] = $subFolderID;
		$data['i'] = 0;
		$data['j'] = 0;
		$data['numFile']= array();
		$data['programID']= $programID;
		$data['program'] = $this->ADMSM->showProgramNameM($programID);
		$data['levelID']= $levelID;
		$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);


		$this->load->view('insideSubFolderV',$data);

	}

	public function deleteComM(){
		if(isset($_POST['id']) ){
			$id = $_POST['id'];
			$this->ADMSM->deleteComM($id);
            
 		} else
			die("Access forbidden..");
	}

	public function editComModalM(){
		if(isset($_POST['comID'])){
    
			$comID = $_POST['comID'];
			
			$output = $this->ADMSM->editComModalM($comID);
			
			echo $output;


	}else
		die("Access forbidden..");
}

public function editAssessModalM(){
	if(isset($_POST['assessID'])){

		$assessID = $_POST['assessID'];
		
		$output = $this->ADMSM->editAssessModalM($assessID);
		
		echo $output;


}else
	die("Access forbidden..");
}

public function editAssessGenModalM(){
	if(isset($_POST['assessID'])){

		$assessID = $_POST['assessID'];
		
		$output = $this->ADMSM->editAssessGenModalM($assessID);
		
		echo $output;


}else
	die("Access forbidden..");
}

public function editComM(){
	if(isset($_POST['idCom']) && isset($_POST['content2'])){
			$content = $_POST['content2'];
			$comID = $_POST['idCom'];
			
			$this->ADMSM->editComM($comID,$content);
	}else
		die("Access forbidden..");
}

public function archivePageV(){
	$data['user'] = $this->ADMSM->userM();
	$data['rows'] = $this->ADMSM->showArchiveFilesM();

	$this->load->view('archivePageV',$data);

}

public function tasksV(){

	$data['user'] = $this->ADMSM->userM();
	$data['rows'] = $this->ADMSM->showAreasM();
	$data['totalAssign'] = $this->ADMSM->totalAssignedM();
	$data['showUsers'] = $this->ADMSM->showUsersM();
	$data['i'] = 0;
		
	$this->load->view('tasksV',$data);

}
 
public function areasV(){

	$data['rows'] = $this->ADMSM->showAreasM();
	$data['overAllFolder'] = $this->ADMSM->overAllFolderM();
	$data['user'] = $this->ADMSM->userM();
	$data['i'] = 0;

	$this->load->view('areasV',$data);

} 

public function insideAreaV($id){
	$data['user'] = $this->ADMSM->userM();
	$data['rows'] = $this->ADMSM->selectedAreaM($id);
	$data['row'] = $this->ADMSM->showUsersFolderM($id);
	$data['totalSubfolders'] = $this->ADMSM->totalSubfoldersM($id);
	$data['i'] = 0;
	
	$this->load->view('insideAreaV',$data);

}

public function areaFolderV($areaID,$usersFolderID){
	$data['user'] = $this->ADMSM->userM();
	$data['rows2'] = $this->ADMSM->selectedAreaM($areaID);
	$data['rows'] = $this->ADMSM->selectedUsersFolderM($usersFolderID,$programID);
	$data['row'] =  $this->ADMSM->subFolderListM($usersFolderID);
	$data['totalFiles'] = $this->ADMSM->totalFilesM($usersFolderID,$programID);
	$data['areaNum'] = $areaID;
	$data['usersFolderID'] = $usersFolderID;
	$data['i'] = 0;


	$this->load->view('areaFolderV',$data);

}

public function insideAreaFolderV($areaID,$usersFolderID,$folderNum,$subFolderID){
	$data['user'] = $this->ADMSM->userM();
	$data['areaNum'] = $areaID;
	$data['folderNum'] = $folderNum;
	$data['subFolderID'] = $subFolderID;
	$data['usersFolderID'] = $usersFolderID;
	$data['subName'] = $_GET['name'];
	$data['rows2'] = $this->ADMSM->selectedAreaM($areaID);
	$data['rows'] = $this->ADMSM->selectedUsersFolderM($usersFolderID,$programID);
	$data['tagFilesList'] = $this->ADMSM->tagFilesListM($subFolderID);
	
	$this->load->view('insideAreaFolderV',$data);

}

public function generalAssessmentV(){
	$data['user'] = $this->ADMSM->userM();

	$this->load->view('generalAssessmentV',$data);

}

public function untagM($leveleID,$subFolderID,$folderNum,$areaID,$usersFolderID,$programID){
	
	if(isset($_POST['tagID'])){
		$name = $_GET['name'];
		$tagID = $_POST['tagID'];
		$this->ADMSM->untagM($leveleID,$tagID,$subFolderID,$folderNum,$areaID,$usersFolderID,$name,$programID);
		
	}else
		die("Access forbidden..");
}

public function detailsTagM(){
	if(isset($_POST['subID']) && isset($_POST['fileID'])){
		$subID = $_POST['subID'];
		$fileID = $_POST['fileID'];
		$output = $this->ADMSM->detailsTagM($subID,$fileID);

		echo $output ;

	}else
		die("Unauthorized Access...");
}



public function deleteFileInArchiveM(){
	
	if(isset($_POST["id"])){
		
		$id = $_POST['id'];
		$this->ADMSM->deleteFileInArchiveM($id);
		
	} else
		die("Access forbidden..");  
	
}

public function editAssessM(){
	if(isset($_POST['assessID']) && isset($_POST['content2'])){
		$content = $_POST['content2'];
		$assessID = $_POST['assessID'];
		
		$this->ADMSM->editAssessM($assessID,$content);
		
	}else
		die("Access forbidden..");
}

public function editAssessGenM($assessID,$content){

	if(isset($_POST['assessID']) && isset($_POST['content2'])){
		$content = $_POST['content2'];
		$assessID = $_POST['assessID'];
		
		$this->ADMSM->editAssessGenM($assessID,$content);
		
	}else
		die("Access forbidden..");
  }

public function deleteAssessM(){
	if(isset($_POST['assessID'])){
	
		$assessID = $_POST['assessID'];
		
		$this->ADMSM->deleteAssessM($assessID);
		
	}else
		die("Access forbidden..");
}

public function totalNotifyM(){

	$this->ADMSM->totalNotifyM();

}

public function fetchNotifyM(){
	if(isset($_POST['usersID'])){
		echo $this->ADMSM->totalNotifyM();
	
	}else
		die("Access forbidden..");
}

public function fetchNotificationM(){
	if(isset($_POST['usersID'])){
		
	$this->ADMSM->fetchNotificationM();
	
	}else
		die("Access forbidden..");
	
}

public function setOpenM(){
	if(isset($_POST['noteID'])){
		$noteID = $_POST['noteID'];
		$this->ADMSM->setOpenM($noteID);
		
		}else
			die("Access forbidden..");
}

public function allNotifyV(){
	
	$data['row1'] = $this->ADMSM->allNotifyM();
	$data['user'] = $this->ADMSM->userM();
	$data['assignedArea'] = base_url()."ADMS/myAssignedAreaV";
	$data['link'] =base_url()."ADMS/foldersV";
	
	$this->load->view('allNotifyV',$data);
	
}

public function deleteNotifyM(){
	
	$this->ADMSM->deleteNotifyM();
	
}

public function markAllM(){
	
	$this->ADMSM->markAllM();
	
}

public function restoreM(){
	if(isset($_POST['folder'])){
		$folder = $_POST['folder'];
		$fileID = $_POST['file'];
		$this->ADMSM->restoreM($folder,$fileID);
		
		}else
			die("Access forbidden...");
}
public function programSelectionV($levelID){
	$data['user'] = $this->ADMSM->userM();
	$data['showPrograms'] = $this->ADMSM->showProgramsM();
	$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
	

	 $this->load->view('programSelectionV',$data);
 }

 public function programsV($levelID,$programID){
	$data['user'] = $this->ADMSM->userM();
	$data['rows'] = $this->ADMSM->showAreasM();
	$data['overAllFolder'] = $this->ADMSM->overAllFolderM($levelID,$programID);
	$data['i'] = 0;
	$data['levelID'] = $levelID;
	$data['programID'] = $programID;
	$data['programName'] = $this->ADMSM->showProgramNameM($programID);
	$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);

	 $this->load->view('programsV',$data);
 }

 

 public function insideProgramsV($levelID,$areaID, $programID){
	$data['user'] = $this->ADMSM->userM();
	$data['rows'] = $this->ADMSM->selectedAreaM($areaID);
	$data['totalSubfolders'] = $this->ADMSM->totalSubfoldersM($levelID,$areaID, $programID);
	$data['row'] = $this->ADMSM->showUsersFolderM($levelID,$areaID,$programID);
	$data['i'] = 0;
	$data['programID'] = $programID;
	$data['levelID'] = $levelID;
	$data['programName'] = $this->ADMSM->showProgramNameM($programID);
	$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
	
	
	 $this->load->view('insideProgramsV',$data);
 }

 public function programFoldersV($levelID,$areaID,$usersFolderID, $programID){
	$data['user'] = $this->ADMSM->userM();
	$data['rows2'] = $this->ADMSM->selectedAreaM($areaID);
	$data['rows'] = $this->ADMSM->selectedUsersFolderM($usersFolderID,$programID);
	$data['row'] =  $this->ADMSM->subFolderListM($usersFolderID,$programID);
	$data['totalFiles'] = $this->ADMSM->totalFilesM($usersFolderID,$programID);
	$data['areaNum'] = $areaID;
	$data['levelID'] = $levelID;
	$data['usersFolderID'] = $usersFolderID;
	$data['i'] = 0;
	$data['programID'] = $programID;
	$data['programName'] = $this->ADMSM->showProgramNameM($programID);
	$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);

	 $this->load->view('programFoldersV',$data);
 }

 public function insideProgramFoldersV($levelID,$areaID,$usersFolderID,$folderNum,$subFolderID,$programID){
	$data['user'] = $this->ADMSM->userM();
	$data['areaID'] = $areaID;
	$data['folderNum'] = $folderNum;
	$data['subFolderID'] = $subFolderID;
	$data['usersFolderID'] = $usersFolderID;
	$data['subName'] = $_GET['name'];
	$data['rows2'] = $this->ADMSM->selectedAreaM($areaID);
	$data['rows'] = $this->ADMSM->selectedUsersFolderM($usersFolderID,$programID);
	$data['tagFilesList'] = $this->ADMSM->tagFilesListM($subFolderID);
	$data['subFolder'] =  $this->ADMSM->subFolderM($subFolderID);
	$data['programID'] = $programID;
	$data['levelID'] = $levelID;
	$data['areaNum'] = $areaID;
	$data['selectedLevel'] = $this->ADMSM->selectedLevelM($levelID);
	$data['areaAssignedM'] = $this->ADMSM->areaAssignedM();
	$data['checkLevel'] = $this->ADMSM->checkLevelM();
	$data['checkTask'] = $this->ADMSM->checkTaskM();
	$data['programName'] = $this->ADMSM->showProgramNameM($programID);


	 $this->load->view('insideProgramFoldersV',$data);
 }

 	public function tagFromTagsM($levelID,$areaID,$usersFolderID,$folderNum,$subFolderID,$programID){
		$subName = $_GET['name'];
		
		if(isset($_POST["folders"])){
           $tagID = $_POST["tagID"];
		   $subID = $_POST["folders"];
		
		   
		   $this->ADMSM->tagFromTagsM($levelID,$tagID,$subID,$subName,$areaID,$usersFolderID,$folderNum,$subFolderID,$programID);
		}else{
			echo 'ERROR';
		}

	 }

	 public function saveNewPositionsM(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }

	 public function saveNewPositionsM2(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM2($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }

	 public function saveNewPositionsM3(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM3($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }

	 public function saveNewPositionsM4(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM4($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }

	 public function saveNewPositionsM5(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM5($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }

	 public function saveNewPositionsM6(){
		if(isset($_POST['update'])){
			
				$this->ADMSM->saveNewPositionsM6($_POST['positions']);

		}else{
			echo 'ERROR';
		}
	 }


	 public function viewM(){
		$fileName = $_POST["fileName"];
		echo $this->ADMSM->viewM($fileName);

	 }

	 public function manageProgramsV(){
		$data['user'] = $this->ADMSM->userM();
		$data['showPrograms'] = $this->ADMSM->showProgramsM();
		$data['checkLevel'] = $this->ADMSM->checkLevelM();
		$data['showLevels'] = $this->ADMSM->showLevelsM();
		// $data['programLevel'] = $this->ADMSM->programLevelM();
	
		$this->load->view('manageProgramsV',$data);

	 }

	public function addProgramM(){
		if(isset($_POST["submit"])){
			$programName = $_POST["programName"];
			$level = $_POST["level"];
			
			$this->ADMSM->addProgramM($programName,$level);
		
		}else
			die("Unauthorized Access...");
	}

	public function deleteProgramM(){
		if(isset($_POST["submit"])){
			$programID = $_POST["programID"];
			
			$this->ADMSM->deleteProgramM($programID);
		
		}else
			die("Unauthorized Access...");
	}
	
	public function renameProgramM(){
		if(isset($_POST["submit"])){
			$programID = $_POST["IDprogram"];
			$programName = $_POST["programName"];
			
			$this->ADMSM->renameProgramM($programID,$programName);
		
		}else
			die("Unauthorized Access...");
	}

	public function manageLevelsV(){
		$data['user'] = $this->ADMSM->userM();
		$data['showLevels'] = $this->ADMSM->showLevelsM();
		// $data['currentLevel'] = $this->ADMSM->currentLevelM();
		// $data['currentLevel2'] = $this->ADMSM->currentLevelM2();
		
	
		$this->load->view('manageLevelsV',$data);

	 }

	 public function addLevelM(){
		if(isset($_POST["submit"])){
			$levelName = $_POST["levelName"];
			
			$this->ADMSM->addLevelM($levelName);
		
		}else
			die("Unauthorized Access...");
	}

	public function deleteLevelM(){
		if(isset($_POST["submit"])){
			$levelID = $_POST["levelID"];
			
			$this->ADMSM->deleteLevelM($levelID);
		
		}else
			die("Unauthorized Access...");
	}
	
	public function renameLevelM(){
		if(isset($_POST["submit"])){
			$levelID = $_POST["IDlevel"];
			$levelName = $_POST["levelName"];
			
			$this->ADMSM->renameLevelM($levelID,$levelName);
		
		}else
			die("Unauthorized Access...");
	}

	public function setLevelM(){
		if(isset($_POST["level"])){
			$levelID = $_POST["level"];
			$program_id = $_POST["program_id"];
		$this->ADMSM->setLevelM($levelID,$program_id);
		
		}else
			die("Unauthorized Access...");
	}
	
	
	
}//End of class
