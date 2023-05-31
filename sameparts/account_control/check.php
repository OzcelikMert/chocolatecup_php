<?php
/* Functions */
// Check Account
function CheckAccount($connect, $id, $user_name, $password){
    $sql_where = (empty($id)) ? "user_name = '$user_name' and password = '$password'" : "id = '$id'";
    $value = false;
    $sql = "select person_name from accounts where $sql_where";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        $value = true;
    }

    return $value;
}
/* end Functions */
?>