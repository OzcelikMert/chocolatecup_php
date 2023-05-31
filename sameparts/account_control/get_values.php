<?php
/* Functions */
// Get Person Name
function GetPersonName($connect, $id, $user_name, $password){
    $sql_where = (empty($id)) ? "user_name = '$user_name' and password = '$password'" : "id = '$id'";
    $value = "";
    $sql = "select person_name from accounts where $sql_where";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $value = $row["person_name"];
    }

    return $value;
}
// Get Account ID
function GetAccountID($connect, $user_name, $password){
    $value = "";
    $sql = "select id from accounts where user_name = '$user_name' and password = '$password'";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $value = $row["id"];
    }

    return $value;
}
// Get Account Permission Rank
function GetPermissionRank($connect, $id, $user_name, $password){
    $sql_where = (empty($id)) ? "user_name = '$user_name' and password = '$password'" : "id = '$id'";
    $value = "";
    $sql = "select 
    permissions.seo_name as Permission_SeoName 
    from accounts 
    inner join permissions on permissions.rank = accounts.permission
    where $sql_where";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $value = $row["Permission_SeoName"];
    }

    return $value;
}
/* end Functions */
?>