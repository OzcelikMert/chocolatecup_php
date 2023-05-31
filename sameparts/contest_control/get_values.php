<?php
/* Functions */
// Get Contest Values
function GetActiveValues($connect){
    $value = "";
    $sql = "SELECT settings.is_active as Contest_Active FROM `settings`";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $value = $row["Contest_Active"];
    }

    return $value;
}
/* end Functions */
?>