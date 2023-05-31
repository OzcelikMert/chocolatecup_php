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

    $Values = array();
    $Values["permission_name"] = "";
    $Values["permission_rank"] = 0;


    // Set Values
    $Values = GetPermissionValues($conn, $id);
    $Values["person_name"] = GetPersonName($conn, $id, "", "");
    $Values["sidebar_links"] = SetSidebarLinks($Values["permission_rank"]);
}

/* Functions */
// Get Saved Points
function GetPermissionValues($connect, $id){
    $values = array();
    $sql = "SELECT
    accounts.permission as Permission_Rank,
    permissions.name as Permission_Name
    FROM `accounts` 
    INNER JOIN permissions ON permissions.rank = accounts.permission
    WHERE accounts.id = '$id'";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $values["permission_name"] = $row["Permission_Name"];
        $values["permission_rank"] = $row["Permission_Rank"];
    }

    return $values;
}
// Set Sidebar Links
function SetSidebarLinks($permission_rank){
    $values = "";
    switch($permission_rank){
        case 1:
            $values .= '
            <li><a href="./contest_management.php">Yarışmayı Yönet</a></li>  
            <li><a href="./user_management.php">Kulanıcıları Yönet</a></li>
            ';
        break;
        case 2:
            $values .= '';
        break;
    }

    return $values;
}
/* end Functions */
?>