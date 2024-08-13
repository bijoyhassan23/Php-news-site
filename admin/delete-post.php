<?php

include "config.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $catid = $_GET['catid'];

    $sql1 = "SELECT * FROM post WHERE post_id = '$id'";
    $result1 = mysqli_query($conn, $sql1) or die('query Faild');
    $row = mysqli_fetch_assoc($result1);

    unlink("upload/".$row['post_img']);

    $sql = "DELETE FROM post WHERE post_id = {$id};";
    $sql .= "UPDATE category
                SET post = post - 1
                WHERE category_id = {$catid};";
    if(mysqli_multi_query($conn, $sql)){
        header("Location: {$host_name}/admin/post.php");
    }else{
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysquli_close($conn);
}