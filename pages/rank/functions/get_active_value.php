<?php
/* URL */
$include_url_1 = "../../../config/config.php";
$include_url_2 = "../../../sameparts/contest_control/get_values.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2)){
    include_once($include_url_1);
    include_once($include_url_2);
}
/* end Includes */

if($_POST["is_active"] == "1"){
    
    $Result = array();
    $Result["active"] = GetActiveValues($conn);

    echo json_encode($Result);
}
?>
