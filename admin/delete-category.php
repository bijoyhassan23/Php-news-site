<?php

include "config.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM category WHERE category_id = {$id}";
    if(mysqli_query($conn, $sql)){
        header("Location: {$host_name}/admin/category.php");
    }else{
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysquli_close($conn);
}