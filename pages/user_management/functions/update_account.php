<?php
/* URL */
$include_url_1 = "../../../config/config.php";
$include_url_2 = "../../../matrix_library/functions/php/mixed.php";
$include_url_3 = "../../../sameparts/account_control/get_values.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2) && file_exists($include_url_3)){
    include_once($include_url_1);
    include_once($include_url_2);
    include_once($include_url_3);
}
/* end Includes */

if($_COOKIE && $_POST){
    $account_id = ClearVariable($_POST["account_id"], "normal");
    $account_name = ClearVariable($_POST["account_name"], "normal");
    $account_password = ClearVariable($_POST["account_password"], "normal");
    $account_active = ClearVariable($_POST["account_active"], "normal");

    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    $Update_Message = array();

    if($permission_rank != "admin"){
        $Update_Message["title"] = "Hata!";
        $Update_Message["comment"] = "Yetki sınırlı!";
        $Update_Message["type"] = "error";
        echo json_encode($Update_Message);
        return;
    }

    // Check Variables
    $CheckValues = CheckVariables($account_name, $account_password, $account_active);
    // end Check Variables
    
    if(!$CheckValues){
        // Create Account
        $Update_Message = UpdateAccount($conn, $account_id, $account_name, $account_password, $account_active);
    }else{
        // Set Error Message - 1
        $Update_Message["title"] = "Hata!";
        $Update_Message["comment"] = "Lütfen gerekli yerleri doldurunuz!";
        $Update_Message["type"] = "error";
    }

    echo json_encode($Update_Message);
}


/* Functions */

// Update Account
function UpdateAccount($connect, $account_id, $account_name, $account_password, $account_active){
    $values = array();
    $sql_set_password = (empty($account_password)) ? "" : ", password = '".md5($account_password)."'";
    // Update
    $sql = "update accounts set person_name = '$account_name', is_active = '$account_active' $sql_set_password where id = '$account_id'";
    if (mysqli_query($connect, $sql)) {
        // Delete is succesfully
        $values["title"] = "İşlem Başarılı!";
        $values["comment"] = "Güncelleme İşlemi Başarılı.";
        $values["type"] = "success";
        $values["account_active"] = $account_active;
    }else {
        // Error
        $values["title"] = "Hata!";
        $values["comment"] = "Hata oluştu lütfen desteğe bildiriniz.";
        $values["type"] = "error";
    }

    return $values;
}
// end Update Account

// Check Variables
function CheckVariables($account_name, $account_password, $account_active){
    $value = false;

    // Control 1
    if(strlen($account_password) > 20){
        $value = true;
    }

    // Control 2
    if(empty($account_name)){
        $value = true;
    }else if(strlen($account_name) > 30){
        $value = true;
    }

    // Control 3
    if(strlen($account_active) > 1){
        $value = true;
    }else if ($account_active != "1" && $account_active != "0"){
        $value = true;
    }

    return $value;
}
// end Check Variables

/* end Functions */
?>