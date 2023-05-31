<?php
/* URL */
$include_url_1 = "../../../config/config.php";
$include_url_2 = "../../../matrix_library/functions/php/mixed.php";
$include_url_3 = "../../../sameparts/contest_control/get_values.php";
$include_url_4 = "../../../sameparts/account_control/get_values.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1) && file_exists($include_url_2) && file_exists($include_url_3) && file_exists($include_url_4)){
    include_once($include_url_1);
    include_once($include_url_2);
    include_once($include_url_3);
    include_once($include_url_4);
}
/* end Includes */

if($_COOKIE && $_POST){
    $onload = ClearVariable($_POST["is_onload"], "normal");
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");
    
    $Result = array();
    $Result["active_button"] = "";
    $Result["title"] = "";
    $Result["comment"] = "";
    $Result["type"] = "";

    // Check Onload
    if($onload != "1"){
        $id = GetAccountID($conn, $user_name, $password);
        $error_message = CheckAllDefinedPoints($conn);
        if(empty($error_message)){
            ChangeContestActive($conn, $id);
            $Result["title"] = "Başarılı";
            $Result["comment"] = "Yarışma durumu başarı ile değiştirildi!";
            $Result["type"] = "success";
        }else{
            $Result["title"] = "Hata";
            $Result["comment"] = "Aşağıda isimleri belirtilen jurilerin sorularını tamamını puanlandırmadığı yarışmacılar vardır: <br>".$error_message;
            $Result["type"] = "error";
        }
    }

    // Check Contest Active
    $is_active = GetActiveValues($conn);

    if($is_active == "1")
        $Result["active_button"] = '<button onClick="javascript:ChangeActive();" id="active-button" class="active-button pulsate">Yarışmayı Bitir</button>';
    else if($is_active == "0")
        $Result["active_button"] = '<button onClick="javascript:ChangeActive();" id="active-button" class="active-button active-button-disable">Yarışmayı Başlat</button>';

    echo json_encode($Result);
}

/* Functions */
// Check is All Defined Points
function CheckAllDefinedPoints($connect){
    $date = date("Y-m");
    $value = "";
    
    $sql_question_count = "SET @Question_Count = (select count(*) from questions where questions.is_active = '1');";
    $sql_contestant_count = "SET @Contestant_Count = (select count(*) from accounts inner join permissions on permissions.rank = accounts.permission where permissions.seo_name='contestant' and accounts.is_active = '1');";
    $sql = "
    SELECT 
    (CASE
    WHEN (COUNT(points.point_giver)) = (@Question_Count * @Contestant_Count) THEN 1
    ELSE 0
    END) as Gived_Status,
    Giver_Accounts.person_name as Giver_Name
    FROM points 
    INNER JOIN accounts as Giver_Accounts ON Giver_Accounts.id = points.point_giver
    INNER JOIN accounts as Receiver_Accounts ON Receiver_Accounts.id = points.point_receiver
    WHERE points.date = '$date' and Giver_Accounts.is_active = '1' and Receiver_Accounts.is_active = '1'
    GROUP BY points.point_giver";
    mysqli_query($connect, $sql_question_count);
    mysqli_query($connect, $sql_contestant_count);
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        if($row["Gived_Status"] == 0){
            $value .= "<b>'".$row["Giver_Name"]."'</b><br>";
        }
    }

    return $value;
}
// Change Contest Active
function ChangeContestActive($connect, $id){
    $sql_permission_range = "SET @Permission_Range = (SELECT accounts.permission FROM accounts WHERE accounts.id = '$id' and accounts.is_active = '1');";
    $sql = "
    UPDATE settings 
    set is_active = 
    CASE
        WHEN (@Permission_Range) < 2 AND is_active = 0  THEN 1
        WHEN (@Permission_Range) < 2 AND is_active = 1 THEN 0
        ELSE is_active
    END";
    mysqli_query($connect, $sql_permission_range);
    if(mysqli_query($connect, $sql)){
        return true;
    }else{
        return false;
    }
}
/* end Functions */
?>
