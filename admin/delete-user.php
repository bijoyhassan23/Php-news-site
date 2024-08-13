<?php

include "config.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE user_id = {$id}";
    if(mysqli_query($conn, $sql)){
        header("Location: {$host_name}/admin/users.php");
    }else{
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysquli_close($conn);
}