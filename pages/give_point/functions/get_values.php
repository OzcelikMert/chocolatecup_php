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

if($_GET){
    $contestant_id = ClearVariable($_GET["id"], "normal");
    // Admin Info
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $Values = array();
    $Values = CheckVariables($conn, $contestant_id);

    if(empty($Values["comment"])){
        $Values["title"] = GetPersonName($conn, $contestant_id, "", "");
        $defined_points = CheckDefinedPoint($conn, $id, $contestant_id);
        $Values["questions"] = GetQuestions($conn, $id, $defined_points);
        $Values["type"] = "success";
    }else{
        $Values["title"] = "Aradığınız yarışmacı bulunamadı!";
        $Values["type"] = "error";
    }
}

/* Functions */
// Get Values
function GetQuestions($connect, $id, $defined_points){
    $values = "";
    $sql = "select * from questions where is_active = '1' order by row asc";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $point_id_element = "";
        // Check Defined Point
        $index = -1;
        // Check Array Count
        if(count($defined_points["id"]) > 0)
            $index = array_search($row["row"], $defined_points["id"]);

        if($index > -1){
            $point_id_element = "<p>".$defined_points["point"][$index]."</p>";
        }else{
            $point_id_element = '
            <select>
                <option value="-1" selected>Puan Seçiniz</option>
                '.SetPoints($row["max_point"]).'
            </select>
            ';
        }

        $values .= '
        <tr id="question_'.$row["row"].'">
            <td id="text">'.$row["question"].'</td>
            <td id="point" class="nopadding">
                '.$point_id_element.'
            </td>
        </tr>
        ';
    }

    return $values;
}
// Set Points
function SetPoints($max) {
    $options = '';
    for ($i=1; $i <= $max; $i++) { 
       $options .= '<option value="'.($i).'">'.($i).'</option>';
    }

    return $options;
}
// Check Variables
function CheckVariables($connect, $contestant_id){
    $array = array();
    $array["comment"] = "";
    // Check User Name
    if(empty($contestant_id) || strlen($contestant_id) > 6 || strlen($contestant_id) < 6){
        $array["comment"] .= "Yanlış ID<br>";
    }
    // Check Account
    if(empty($array["comment"])){
        $array["comment"] = CheckAccount($connect, $contestant_id);
    }

    return $array;
}
// Check Account
function CheckAccount($connect, $contestant_id){
    $value = "";
    $sql = "select id from accounts where id = '$contestant_id' and permission > 2";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) < 1){
        $value = "Yanlış ID";
    }

    return $value;
}
// Check Defined Point
function CheckDefinedPoint($connect, $id, $contestant_id){
    $values = array();
    $index = 0;
    $sql = "select * from points where point_giver = '$id' and point_receiver = '$contestant_id' and date ='".date("Y-m")."'";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $values["id"][$index] = $row["question"];
        $values["point"][$index] = $row["point"];
        $index++;
    }

    return $values;
}
/* end Functions */
?>