<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <table>
        <tr>
            <th>No.</th>
            <th>Girl</th>
            <th>Lover</th>
        </tr>
        <!-- <tr>
            <td>1</td>
            <td><?=$userArr['girl']?></td>
            <td><?=$userArr['lover']?></td>
        </tr> -->
        <?php
            foreach($userArr as $key => $value){
                echo '<tr>
                        <td>'.$value->id.'</td>
                        <td>'.$value->girl.'</td>
                        <td>'.$value->lover.'</td>
                      </tr>
                ';
            }
        ?>
    </table>
</body>
</html>