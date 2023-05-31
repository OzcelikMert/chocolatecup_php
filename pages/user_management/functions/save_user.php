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

if($_COOKIE && $_POST){
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $new_person_name = ClearVariable($_POST["new_person_name"], "normal");
    $new_user_name = ClearVariable($_POST["new_user_name"], "normal");
    $new_user_password = ClearVariable($_POST["new_user_password"], "normal");
    $new_user_permission = ClearVariable($_POST["new_user_permission"], "normal");
    
    $errorMessage = "";

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    if($permission_rank != "admin"){
        exit;
    }

    $errorMessage = CheckVariables($conn, $new_person_name, $new_user_name, $new_user_password, $new_user_permission);
    if(empty($errorMessage)){
        // Create Account ID
        $account_id = substr(str_shuffle(str_repeat("0123456789abcdefghıjklmnoprstuvyzxwq", 8)), 0, 6);
        while(CheckAvailableAccountID($conn, $account_id)){
            $account_id = substr(str_shuffle(str_repeat("0123456789abcdefghıjklmnoprstuvyzxwq", 8)), 0, 6);
        }
        $new_user_password = md5($new_user_password);
        if(InsertNewUser($conn, $account_id, $new_person_name, $new_user_name, $new_user_password, $new_user_permission))
            header("Location: user_management.php");
    }


}

/* Functions */
// Insert New User
function InsertNewUser($connect, $account_id, $new_person_name, $new_user_name, $new_user_password, $new_user_permission){
    $sql = "insert into accounts(row, id, user_name, password, person_name, permission, date, is_active)
    values(null, '$account_id', '$new_user_name', '$new_user_password', '$new_person_name', '$new_user_permission', '".date("Y-m-d H:i:s")."', '1')";
    if(mysqli_query($connect, $sql)){
        return true;
    }

    return false;
}
// Check Variables
function CheckVariables($connect, $new_person_name, $new_user_name, $new_user_password, $new_user_permission){
    $value = "";

    // Check Person Name
    if(strlen($new_person_name) > 30 ){
        $value .= "<p>Kişi İsimi çok uzun!</p>";
    }else if(strlen($new_person_name) < 1){
        $value .= "<p>Kişi isimi çok kısa!</p>";
    }

    // Check User Name
    if(strlen($new_user_name) > 20 ){
        $value .= "<p>Kullanıcı İsimi çok uzun!</p>";
    }else if(strlen($new_user_name) < 1){
        $value .= "<p>Kullanıcı isimi çok kısa!</p>";
    }

    // Check Password
    if(strlen($new_user_password) > 20 ){
        $value .= "<p>Şifre çok uzun!</p>";
    }else if(strlen($new_user_password) < 1){
        $value .= "<p>Şifre çok kısa!</p>";
    }

    // Check Permission
    if(empty($new_user_permission) || $new_user_permission < 2){
        $value .= "<p>Yanlış Yetki!</p>";
    }

    // Check Available Username
    if (CheckAvailableUsername($connect, $new_user_name)) {
        $value .= "<p>Kayıtlı Kullanıcı Adı!</p>";
    }

    return $value;
}
// Check Available Username
function CheckAvailableUsername($connect, $user_name){
    $sql = "select * from accounts where user_name = '$user_name'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}
// Check Account ID
function CheckAvailableAccountID($connect, $account_id){
    $sql = "select * from accounts where id = '$account_id'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}
/* end Functions */
?>
