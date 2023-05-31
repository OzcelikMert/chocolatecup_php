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
    
    $Values = array();
    $Values["Permissions"] = "";
    $Values["Users"] = "";

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    if($permission_rank != "admin"){
        header("Location: dashboard.php");
    }

    $Values["Permissions"] = GetPermissions($conn);
    $Values["Users"] = GetUsers($conn);
}

/* Functions */
// Get Permissions
function GetPermissions($connect){
    $values = "";
    $sql = "SELECT * FROM `permissions` WHERE permissions.rank > 1 ORDER BY permissions.rank ASC";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values .= '
        <option value="'.$row["rank"].'">'.$row["name"].'</option>
        ';
    }

    return $values;
}
// Get Users
function GetUsers($connect){
    $values = "";
    $sql = "SELECT
    accounts.id AS Account_ID,
    accounts.person_name AS Person_Name,
    accounts.is_active AS Account_Active,
    permissions.name AS Permission_Name
    FROM accounts 
    INNER JOIN permissions ON permissions.rank = accounts.permission
    WHERE accounts.permission > 1
    ORDER BY accounts.permission DESC";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $active_bg = "";

        if($row["Account_Active"] != "1")
            $active_bg = 'style="background-color: #ff7777;"';

        $values .= '
        <tr '.$active_bg.' id="Account_'.$row["Account_ID"].'" name="'.$row["Person_Name"].'" is_active="'.$row["Account_Active"].'">
            <td align="center">
                <a class="btn btn-danger" href="javascript:AccountDelete(\''.$row["Account_ID"].'\');"><em class="mdi mdi-delete"></em></a>
            </td>
            <td align="center">
                <a class="btn btn-primary" href="javascript:AccountUpdate(\''.$row["Account_ID"].'\');"><em class="mdi mdi-update"></em></a>
            </td>
            <td id="Account_'.$row["Account_ID"].'_Name">'.$row["Person_Name"].'</td>
            <td>'.$row["Permission_Name"].'</td>
        </tr>
        ';
    }

    return $values;
}
/* end Functions */
?>
