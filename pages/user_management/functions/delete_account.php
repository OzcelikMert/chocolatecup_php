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

    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    $Delete_Message = array();

    if($permission_rank != "admin"){
        $Delete_Message["title"] = "Hata!";
        $Delete_Message["comment"] = "Yetki sınırlı!";
        $Delete_Message["type"] = "error";
        echo json_encode($Delete_Message);
        return;
    }

    $Delete_Message = DeleteAccount($conn, $account_id);

    echo json_encode($Delete_Message);
}


/* Functions */
// Delete Account
function DeleteAccount($connect, $account_id){
    $values = array();
    $sql = "delete from accounts where id = '$account_id'";
    if (mysqli_query($connect, $sql)) {
        // Delete is succesfully
        $values["title"] = "İşlem Başarılı!";
        $values["comment"] = "Silme işlemi başarı ile tamamlandı.";
        $values["type"] = "success";
        return $values;
    }else {
        // Error
        $values["title"] = "Hata!";
        $values["comment"] = "Hata oluştu lütfen desteğe bildiriniz.";
        $values["type"] = "error";
        return $values;
    }
}
/* end Functions */
?>