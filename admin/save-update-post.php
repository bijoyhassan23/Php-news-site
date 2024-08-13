<?php
include "config.php";


if(empty($_FILES['new-image']['name'])){
    $image = $_POST['old-image'];
}else{
    $error = [];
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_typ = $_FILES['new-image']['type'];
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
        move_uploaded_file($file_tmp, "upload/".$img_name );
    }else{
        print_r($error);
        die();
    }

    $image = $img_name;
}




if(isset($_POST['submit'])){
    $postid = mysqli_real_escape_string($conn, $_POST['post_id']);
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $oldcategory = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d M, y");
    
    $sql = "UPDATE post
            SET 
            title = '{$title}',
            description = '{$description}',
            category = '{$category}',
            post_img = '{$image}'
            WHERE post_id = {$postid};";

    if($oldcategory != $category){
        $sql .= "UPDATE category
                SET post = post + 1
                WHERE category_id = {$category};";
        $sql .= "UPDATE category
                SET post = post - 1
                WHERE category_id = {$oldcategory};";
    }
    
    
    if(mysqli_multi_query($conn, $sql)){
        header("Location: {$host_name}/admin/post.php");
    }else{
        echo "Error: Query Faild";
    }
}