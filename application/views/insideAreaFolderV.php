<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpeg" href="<?=base_url()?>/cit.jpg">
    <title>List of Files</title>
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


    <!--  <script src="jquery.min.js"></script>-->
    <style>
    .upload {
        background-color: darkgreen;
        color: white
    }

    .upload:hover {
        background-color: transparent;
        color: darkgreen;
        border-color: darkgreen;
    }

    a {
        color: black;
    }

    a:hover {
        color: blue;
    }
    </style>
    <?php $this->load->view('headerV'); ?>
</head>

<body style="background-color:powderblue">


    <div id="wrapper">

        <?php $this->load->view('sideBarAccreditor'); ?>

        <div id="content-wrapper">
            <div class="container-fluid">

                <ol class="breadcrumb mrgnTop">
                    <li class="breadcrumb-item">
                        <strong style="color:blue">ACCREDITOR</strong>
                    </li>
                    <li class="breadcrumb-item active"><strong>Area <?=$areaNum?> <?=$rows2['areaName']?> /
                            <?=$rows['letter']?>. <?=$rows['name']?> / <?=$rows['letter']?>.<?=$folderNum?>
                            <?=$subName?></strong></li>
                </ol>

                <div style="margin-bottom: 10px">
                    <a href="<?=base_url()?>ADMS/areaFolderV/<?= $areaNum?>/<?= $usersFolderID?>"
                        class="btn cstm-btn-red"><i class="fa fa-arrow-left"></i> Back</a>


                </div>

                <div class="card mb-3">
                    <div class="card-header color13">
                        <strong> <i class="fas fa-fw fa-th-list"></i> List Of Files</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="color13 text-light" style="text-align: center">
                                    <tr>
                                        <th></th>
                                        <th style="text-align:left"><i class="fas fa-fw fa-file"></i> File Name</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                      foreach($tagFilesList as $row){ 
                         
                    ?>

                                    <tr>
                                        <td style="width:5%"><span <?php
                                          if($row['tagNum'] == 500){?> style="color:transparent" <?php
                                          }else{?> style="color:black" <?php   
                                          }

                                        ?>><?=$row['tagNum']?>.</span></td>
                                        <td><a
                                                href="<?=base_url()?>ADMS/viewV3/<?= $row['fileID'] ?>/<?=$areaNum?>/<?=$usersFolderID?>/<?=$folderNum?>/<?=$subFolderID?>?name=<?=$subName?>"><?= $row['fileName'] ?></a>
                                        </td>


                                    </tr>
                                    <?php
                        
                    
                  }
                   
                   
                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('footerV'); ?>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>



<!--delete file Modal-->
<div id="deleteFile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color6">
                <h4 class="modal-title" style="text-align:center"><span>Are you sure you wanna delete this tagged file
                        <i class="fa fa-trash"></i> ?</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white"
                    aria-label="Close">&times;</button>

            </div>
            <div class="modal-body cstmSky">
                <form method="post" action="deleteFileInTagFolder.php">
                    <input type="hidden" name="id" id="id">

                    <div class="control-group">
                        <div align="center" class="controls">
                            <button name="submit" type="submit" class="btn cstm-btn-navy"><i class="fa fa-check"></i>
                                Yes</button>
                            <button type="button" class="btn cstm-btn-red" data-dismiss="modal"><i
                                    class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of delete Modal-->

<!--details Modal-->
<div id="details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color5">
                <h4 class="modal-title"><span id="change_title">Details</span></h4>
                <button type="button" class="close" data-dismiss="modal" style="color:white"
                    aria-label="Close">&times;</button>

            </div>
            <div class="modal-body cstmSky">
                <div id="detailsInfo" style="background-color:cornsilk">

                </div>

            </div>
            <div class="modal-footer cstmSky">
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
<!--End of details Modal-->


<script>
$(document).ready(function() {

    $(document).on('click', '.delete', function() {
        var id = $(this).attr("id");
        $('#id').val(id);
    });


    $(document).on('change', '#num', function() {
        var value = $(this).val();



        $(document).on('click', '.ok', function() {
            var fileID = $(this).attr("id");


            $.ajax({
                url: "numFile.php",
                method: "post",
                data: {
                    value: value,
                    fileID: fileID
                },
                success: function(data) {
                    location.reload();
                }
            });
        });




    });

    $(document).on('click', '.details', function() {
        var id = $(this).attr("id");
        var fileID = $(this).attr("name");
        $.ajax({
            url: "detailsTag.php",
            method: "post",
            data: {
                id: id,
                fileID: fileID
            },
            success: function(data) {
                $('#detailsInfo').html(data);
                $('#details').modal("show");
                console.log(data);
            }
        });
    });
});
</script>