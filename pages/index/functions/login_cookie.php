<?php
/* URL */
$include_url_1 = "./config/config.php";
$include_url_2 = "./matrix_library/functions/php/mixed.php";
$dashboard_url = "./dashboard.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2)){
    include_once($include_url_1);
    include_once($include_url_2);
}
/* end Includes */

if($_COOKIE){
    
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $result = array();
    $result = CheckVariables($conn, $user_name, $password);

    if(empty($result["comment"])){
        setcookie("user_name", $user_name, time() + (10 * 365 * 24 * 60 * 60), "/");
        setcookie("password", $password, time() + (10 * 365 * 24 * 60 * 60), "/");
        header("Location: $dashboard_url");
    }else{
        setcookie("user_name", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
    }
}

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