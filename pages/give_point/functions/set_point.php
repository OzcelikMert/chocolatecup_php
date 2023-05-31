<?php
/* URL */
$include_url_1 = "../../../config/config.php";
$include_url_2 = "../../../matrix_library/functions/php/mixed.php";
$include_url_3 = "../../../sameparts/account_control/get_values.php";
$include_url_4 = "../../../sameparts/account_control/check.php";
$include_url_5 = "../../../sameparts/contest_control/get_values.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2) && file_exists($include_url_3) && file_exists($include_url_4) && file_exists($include_url_5)){
    include_once($include_url_1);
    include_once($include_url_2);
    include_once($include_url_3);
    include_once($include_url_4);
    include_once($include_url_5);
}
/* end Includes */

if($_POST){
    
    // Contestant Info
    $contestant_id = ClearVariable($_POST["contestant_id"], "normal");
    $question_id = $_POST["question_id"];
    $question_point = $_POST["question_point"];
    // Admin Info
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $Result = array();

    $is_wrong = CheckVariables($conn, $question_id, $question_point, $contestant_id, $id);

    if(!$is_wrong){
        $is_wrong = (GetActiveValues($conn) == "1") ? false : true;
    }
    
    if(!$is_wrong){
        $permission_rank = GetPermissionRank($conn, $id, "", "");
        if($permission_rank == "jury"){
            $is_wrong = (SetPoints($conn, $id, $contestant_id, $question_id, $question_point)) ? false : true;
            $Result["title"] = "İşlem Başarılı";
            $Result["comment"] = "Verdiğiniz puanlar başarı ile kayıt edildi.";
            $Result["type"] = "success";
        }else{
            $Result["title"] = "Hata!";
            $Result["comment"] = "Yetkiniz puan verme işleminde geçersiz olduğundan işlem başarısız oldu!";
            $Result["type"] = "error";
        }
    }

    if ($is_wrong){
        $Result["title"] = "Hata!";
        $Result["comment"] = "Puan verilirken bir hata meydana geldi!";
        $Result["type"] = "error";
    }

    echo json_encode($Result);
}

/* Functions */
// Set Points
function SetPoints($connect, $id, $contestant_id, $question_id, $question_point) {
    $value = true;
    // Select
    $sql = "select * from points where point_giver = '$id' and point_receiver = '$contestant_id' and date ='".date("Y-m")."'";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $index = array_search($row["question"], $question_id);
        if($index > -1){
            unset($question_id[$index]);
            $question_id = array_values($question_id);
            unset($question_point[$index]);
            $question_point = array_values($question_point);
        }
    }
    // Insert
    if(count($question_id) > 0 && count($question_point) > 0 && count($question_id) == count($question_point)){
        $question_id_count = count($question_id);
        $sql = "insert into points(row, point_giver, point_receiver, point, question, date) values";
        for ($i=0; $i < $question_id_count; $i++) { 
            $sql .= "(null, '$id', '$contestant_id', ".$question_point[$i].", ".$question_id[$i].", '".date("Y-m")."')";
            if(($i+1) == $question_id_count)
                $sql .= ";";
            else
                $sql .= ",";
        }
        if(mysqli_query($connect, $sql)){
            $value = true;
        }else{
            $value = false;
        }
    }

    return $value;
}
// Check Variables
function CheckVariables($connect, $question_id, $question_point, $contestant_id, $id){
    $is_wrong = false;
    
    // Check Question ID and Point COUNT
    if(count($question_id) != count($question_point)){
        $is_wrong = true;
    }
    // Check Question ID and Point Values
    if(!$is_wrong){
        for ($i=0; $i < count($question_id); $i++) {
            // Clear ID and Point
            $question_id_clear = ClearVariable($question_id[$i], "normal+number");
            $question_point_clear = ClearVariable($question_point[$i], "normal+number");
            // Check ID and Point
            if(empty($question_id_clear) || strlen($question_id_clear) > 11 || empty($question_point_clear) || strlen($question_point_clear) > 11 || $question_point_clear <= 0)
                $is_wrong = true;
        }
    }
    // Check Accounts ID Values
    if(empty($contestant_id) || strlen((string)$contestant_id) != 6 || empty($id)){
        $is_wrong = true;
    }
    // Check Question Defined
    if(!$is_wrong){
        $is_wrong = CheckQuestion($connect, $question_id, $question_point);
    }
    // Check Account Defined
    if(!$is_wrong){
        $is_wrong = (CheckAccount($connect, $contestant_id, "", "")) ? false : true;
    }

    return $is_wrong;
}
// Check Question
function CheckQuestion($connect, $question_id, $question_point){
    $value = false;
    $question_id_count = count($question_id);
    $sql_where = "";
    for ($i=0; $i < $question_id_count; $i++) { 
        $sql_where .= "(row = ".(int)$question_id[$i]." and max_point >= ".(int)$question_point[$i].")";
        if(($i+1) == $question_id_count)
            $sql_where .= "";
        else
            $sql_where .= " or ";
    }

    $sql = "select count(*) as question_count from questions where $sql_where and is_active = 1";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $value = ($question_id_count != $row["question_count"]) ? true : false;
    }
    
    return $value;
}
/* end Functions */
?>