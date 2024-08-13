<?php
session_start();
include "config.php";

if(isset($_FILES['fileToUpload'])){
    $error = [];
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_typ = $_FILES['fileToUpload']['type'];
    $file_ext_arr = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_arr));
    $extentions = ["jpeg", "jpg", "png"];


    if(!in_array($file_ext, $extentions)){
       $error[] = "Error: Please select a valid file. (jpeg, jpg, png)";
    }
    if($file_size > 2097152){
        $error[] = "Error: File size cannot exceed 2MB";
    }
    
    $img_name = time() . "-" .$file_name;
    if(empty($error)){
        move_uploaded_file($file_tmp, "upload/" .$img_name);
    }else{
        print_r($error);
        die();
    }


}

$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post(title, description, category, post_date, author, post_img)
        VALUES('{$title}', '{$description}', '{$category}', '{$date}', {$author}, '{$img_name}');";
$sql .= "UPDATE category
        SET post = post + 1
        WHERE category_id = {$category};";


if(mysqli_multi_query($conn, $sql)){
    header("Location: {$host_name}/admin/post.php");
}else{
    echo "Error: Query Faild";
}