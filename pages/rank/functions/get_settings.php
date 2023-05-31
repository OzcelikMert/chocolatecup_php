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
    $Result["interval"] = 0;
    $Result["sort"] = "";
    $Result["max"] = 0;
    
    $date = date("Y-m");
    $Result = GetSettings($conn, $date);

    echo json_encode($Result);
}

/* Functions */
// Get Ranks
function GetSettings($connect, $date){
    $values = array();
    $sql = "SELECT
    (
     SELECT COUNT(DISTINCT points.point_receiver) FROM points 
     WHERE points.date = '$date'
    ) as max_count,
    settings.interval,
    settings.sort
    FROM settings";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $values["interval"] = intval($row["interval"]);
        $values["sort"] = $row["sort"];
        $values["max"] = intval($row["max_count"]);
    }

    return $values;
}
/* end Functions */
?>