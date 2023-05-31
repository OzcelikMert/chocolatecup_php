<?php
/* URL */
$include_url_1 = "./config/config.php";
$include_url_2 = "./matrix_library/functions/php/mixed.php";
$include_url_3 = "./sameparts/account_control/get_values.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2) && file_exists($include_url_3)){
    include_once($include_url_1);
    include_once($include_url_2);
    include_once($include_url_3);
}
/* end Includes */

if($_COOKIE){
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    if($permission_rank != "admin"){
        header("Location: dashboard.php");
    }
}

/* Functions */
/* end Functions */
?>
