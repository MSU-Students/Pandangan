<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>Sample</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
     <!-- myStyle CSS-->
    <link href="<?=base_url()?>/css/myStyle.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/css/sb-admin.css" rel="stylesheet">
      <!-- Bootstrap core JavaScript-->
      <script src="<?=base_url()?>/vendor/jquery/jquery.min.js"></script>
      <script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                  
                      <!-- Core plugin JavaScript-->
     <script src="<?=base_url()?>/vendor/jquery-easing/jquery.easing.min.js"></script>
                  
                      <!-- Custom scripts for all pages-->
      <script src="<?=base_url()?>/js/sb-admin.min.js"></script>
      <script src="<?=base_url()?>/vendor/jquery/jquery.js"></script>
     
</head>
<body style="background-color: white">

<div id="wrapper">
    
   
    <div id="content-wrapper" >
    <div class="container-fluid">
    
   
  
   
   
      <?php
      foreach($areaAssignedM as $area){
         echo '<strong><p class="upper area navy">AREA '.$area->id.' - '.$area->areaName.'</p></strong>';
         $totalFolder = $this->ADMSM->totalFolderM2($area->id);
            while($totalFolder > 0){
               
                     $folder = $usersFolderM[$i++];
                     echo '<strong><p class="indent navy usersFolder">'.$folder->letter.' - '.$folder->name.'</p></strong>';

                            $totalSubFolder = $this->ADMSM->subFolderNumM($folder->usersFolderID);
                            while($totalSubFolder > 0){
                                  $subFolder = $usersSubFolderM[$j++];
                                  echo '<div class="indent2 navy usersSubFolder"><input type="checkbox" name="folders[]" value="'.$subFolder->subID.'"><strong > '.$subFolder->letter.'.'.$subFolder->folderNum.' - '.$subFolder->subName.'</strong></div><br>';
                                  $totalSubFolder--;
                          }
                          
                     $totalFolder--;
                     
            
            }
            echo '<br>';
   }
      ?>



       
    </div>
    </div>
    </div>
    <br><br><br>
 
  
    
    <script src="<?=base_url()?>/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- <script src="../js/demo/datatables-demo.js"></script> -->
</body>
</html>



<?php
                    //   foreach($areaAssignedM as $area){
                    //         echo '<strong><p class="indent upper area navy">AREA '.$area->id.' - '.$area->areaName.'</p></strong>';
                    //         $totalFolder = $this->ADMSM->totalFolderM2($area->id);
                    //             while($totalFolder > 0){
                                
                    //                     $folder = $usersFolderM[$i++];
                    //                     echo '<strong><p class="indent2 navy usersFolder">'.$folder->letter.' - '.$folder->name.'</p></strong>';

                    //                             $totalSubFolder = $this->ADMSM->subFolderNumM($folder->usersFolderID);
                    //                             while($totalSubFolder > 0){
                    //                                 $subFolder = $usersSubFolderM[$j++];
                    //                                 echo '<td><div class="indent3 navy usersSubFolder"><input type="checkbox" name="folders[]" value="'.$subFolder->subID.'"><strong > '.$subFolder->letter.'.'.$subFolder->folderNum.' - '.$subFolder->subName.'</strong></div></td><br>';
                    //                                 $totalSubFolder--;
                    //                         }
                                            
                    //                     $totalFolder--;
                                        
                                
                    //             }
                    //             echo '<br>';
                    //     }
                  ?>