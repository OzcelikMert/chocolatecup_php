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

if($_POST){
    $post_date = ClearVariable($_POST["date"], "normal");
    $date = ($post_date == "onload") ? date("Y-m") : date("Y-m", strtotime($post_date));
    $user_name = ClearVariable($_COOKIE["user_name"], "normal");
    $password = ClearVariable($_COOKIE["password"], "normal");

    $id = GetAccountID($conn, $user_name, $password);

    $permission_rank = GetPermissionRank($conn, $id, "", "");

    $is_wrong = CheckVariables($date);

    $Result = array();
    $Result["dates"] = "";
    $Result["saved_points"] = "";

    if(!$is_wrong){
        if($post_date == "onload")
            $Result["dates"] = GetDates($conn, $id, $permission_rank);
        $Result["saved_points"] = GetSavedPoints($conn, $id, $date, $permission_rank);
    }

    echo json_encode($Result);
}
/* Functions */
// Get Saved Points
function GetSavedPoints($connect, $id, $date, $permission_rank){
    $sql_where = ($permission_rank != "admin") ? "and points.point_giver = '$id'" : "";
    $values = "";
    $count = 0;
    $sql = "SELECT
    giver_accounts.person_name AS GiverPerson_Name,
    receiver_accounts.person_name AS ReceiverPerson_Name,
    questions.question AS Question,
    questions.max_point AS Max_Point,
    points.point AS Point
    FROM points
    INNER JOIN accounts AS receiver_accounts ON receiver_accounts.id = points.point_receiver
    INNER JOIN accounts AS giver_accounts ON giver_accounts.id = points.point_giver
    INNER JOIN questions ON questions.row = points.question
    WHERE points.date = '$date' $sql_where
    ORDER BY GiverPerson_Name";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $count++;
        $values .= '
        <tr>
            <th scope="row">'.$count.'</th>
            <td>'.$row["GiverPerson_Name"].'</td>
            <td>'.$row["ReceiverPerson_Name"].'</td>
            <td>'.$row["Question"].'</td>
            <td>'.$row["Max_Point"].'</td>
            <td><b>'.$row["Point"].'</b></td>
        </tr>
        ';
    }

    return $values;
}
// Get Dates
function GetDates($connect, $id, $permission_rank){
    $sql_where = ($permission_rank != "admin") ? "WHERE point_giver = '$id'" : "";
    $values = "";
    $sql = "SELECT 
    date as Date 
    FROM `points`
    $sql_where
    GROUP BY date
    ORDER BY date DESC";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $values .= '
        <option value="'.$row["Date"].'">'.date("m-Y", strtotime($row["Date"])).'</option>
        ';
    }

    return $values;
}
// Check Variables
function CheckVariables($date){
    $is_wrong = false;

    // Check Date
    if(strlen($date) > 7 || !preg_match("([0-9]{4}-[0-9]{2})", $date)){
        $is_wrong = true;
    }

    return $is_wrong;
}
/* end Functions */
?>