<?php
// Clear Variable
function ClearVariable($variable, $clearRange){
    $variable = isset($variable) ? $variable : "";
    // Clear Value
    switch ($clearRange) {
        // 1
        case "normal":
            $variable = htmlspecialchars(trim(strip_tags($variable)));
            $variable = str_replace("'", '', $variable);
        break;
        // 2
        case "replace-no":
            $variable = htmlspecialchars(trim(strip_tags($variable)));
        break;
        // 3
        case "replace-space":
            $variable = str_replace(" ", '', $variable);
        break;
        // 4
        case "replace-slash":
            $variable = str_replace("/", '', $variable);
        break;
        // 5
        case "replace-percent":
            $variable = str_replace("%", '', $variable);
        break;
        // 6
        case "normal+email":
            $variable = htmlspecialchars(trim(strip_tags($variable)));
            $variable = str_replace("'", '', $variable);
            $variable = filter_var($variable, FILTER_VALIDATE_EMAIL);
        break;
        // 7
        case "normal+number":
            $variable = htmlspecialchars(trim(strip_tags($variable)));
            $variable = str_replace("'", '', $variable);
            $variable = filter_var($variable, FILTER_SANITIZE_NUMBER_INT);
        break;
        case "replace-quotation-mark":
            $variable = str_replace("'", '', $variable);
        break;
        // 0
        default:
            $variable = "Wrong Range"; 
        break;
    }

    return $variable;
}
// Javascript Alert Function
function AlertPHP($message){
    echo "<script>alert('".$message."');</script>";
}
// Get User IP Address
function GetUserIPAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}
// Variable Encryption
function VariableEncrypt($variable, $type){
    if(!empty($variable)){
        switch($type){
            case "md5":
                $variable = hash("md5", $variable);
            break;
            case "sha-256":
                $variable = hash("sha256", $variable);
            break;
            case "full":
                $variable = hash("md5", $variable);
                $variable = hash("sha256", $variable);
            break;
        }
    }

    return $variable;
}
// Matrix Encrypt
function MatrixEncrypt($variable){
    $variable = str_replace("([1])", "q4");

    $variable = substr(str_shuffle(str_repeat("0123456789bcdfghjklmnprstvyzwx", 3)), 0, 3).$variable.substr(str_shuffle(str_repeat("0123456789bcdfghjklmnprstvyzwx", 3)), 0, 3);
}
?>