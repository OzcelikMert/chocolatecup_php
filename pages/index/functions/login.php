<?php
/* URL */
$include_url_1 = "../../../config/config.php";
$include_url_2 = "../../../matrix_library/functions/php/mixed.php";
$dashboard_url = "./dashboard.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2)){
    include_once($include_url_1);
    include_once($include_url_2);
}
/* end Includes */
$result = array();

if($_POST){
    $user_name = ClearVariable($_POST["user_name"], "normal");
    $password = ClearVariable($_POST["password"], "normal");
    $password = VariableEncrypt($password, "md5");
    
    $result = CheckVariables($conn, $user_name, $password);

    if(empty($result["comment"])){
        setcookie("user_name", $user_name, time() + (10 * 365 * 24 * 60 * 60), "/");
        setcookie("password", $password, time() + (10 * 365 * 24 * 60 * 60), "/");
        $result["type"] = "success";
        $result["location"] = $dashboard_url;
    }else{
        $result["type"] = "error";
    }
}

echo json_encode($result);

/* Functions */
// Check Variables
function CheckVariables($connect, $user_name, $password){
    $array = array();
    $array["comment"] = "";
    // Check User Name
    if(empty($user_name) || strlen($user_name) > 20){
        $array["comment"] .= "Lütfen Kullanıcı adını 1 ve 20 karakter arasında giriniz!<br>";
    }
    // Check Password
    if(empty($password) || strlen($password) > 50){
        $array["comment"] .= "Lütfen Şifreyi 1 ve 20 karakter arasında giriniz!<br>";
    }
    // Check Account
    if(empty($array["comment"])){
        $array["comment"] .= CheckAccount($connect, $user_name, $password);
    }

    return $array;
}
// Check Account
function CheckAccount($connect, $user_name, $password){
    $value = "";
    $sql = "select id from accounts where user_name = '$user_name' and password = '$password' and permission < 3 and is_active = 1";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) < 1){
        $value = "Girdiğiniz kullanıcı adı veya şifre yanlıştır!";
    }

    return $value;
}
/* end Functions */
?>