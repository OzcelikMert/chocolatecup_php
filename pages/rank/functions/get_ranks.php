<?php
/* URL */
$include_url_1 = "../../../config/config.php";
/* End URL */

/* Includes */
if(file_exists($include_url_1)){
    include_once($include_url_1);
}
/* end Includes */

if($_POST["is_active"] == "1"){

    $Result = array();
    $Result["points"] = "";

    $date = date("Y-m");
    $Result["points"] = GetRanks($conn, $date);

    echo json_encode($Result);
}

/* Functions */
// Get Ranks
function GetRanks($connect, $date){
    $values = array();
    $index_giver = -1;
    $index_receiver = 0;
    $old_giver_id = "";
    $sql = "SELECT 
    accounts_receiver.row as Account_Row, 
    accounts_receiver.person_name as Person_Name, 
    accounts_giver.id as Giver_ID, 
    SUM(points.point) as Total_Point 
    FROM `points` 
    INNER JOIN accounts as accounts_receiver ON accounts_receiver.id = points.point_receiver
    INNER JOIN accounts as accounts_giver ON accounts_giver.id = points.point_giver 
    WHERE points.date = '$date' and accounts_giver.is_active = '1'
    GROUP BY point_receiver, point_giver 
    ORDER BY Giver_ID ASC, Account_Row ASC";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        if($old_giver_id != $row["Giver_ID"]){
            $index_giver++;
            $index_receiver = 0;
        }
        $values[$index_giver][$index_receiver] = array(
            "id" => intval($row["Account_Row"]),
            "title" => $row["Person_Name"],
            "point" => intval(round($row["Total_Point"]))
        );
        $index_receiver++;
        $old_giver_id = $row["Giver_ID"];
    }

    return $values;
}
/* end Functions */
?>