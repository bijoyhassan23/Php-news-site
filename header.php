<?php
include "config.php";
    $page_title = "News - Home";
    $page_name = basename($_SERVER['PHP_SELF']);

    if($page_name == "index.php"){
        $page_title = "News - Home";
    }elseif($page_name == "search.php" && isset($_GET['search'])){
        $page_title = "Search Results - " . $_GET['search'];
    }elseif($page_name == 'category.php' && isset($_GET['cat-id'])){
        $sql9 =  "SELECT * FROM category WHERE category_id = '{$_GET['cat-id']}'";
        $result9 = mysqli_query($conn, $sql9);
        $row9 = mysqli_fetch_assoc($result9);
        $page_title = "Category - " . $row9['category_name'];
    }elseif($page_name == 'author.php' && isset($_GET['aut-id'])){
        $sql9 =  "SELECT * FROM user WHERE user_id = '{$_GET['aut-id']}'";
        $result9 = mysqli_query($conn, $sql9);
        $row9 = mysqli_fetch_assoc($result9);
        $page_title = "Author - " . $row9['username'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->

<?php 

 $sql7 =  "SELECT * FROM category ORDER BY category_id";

$result7 = mysqli_query($conn, $sql7) or die("Query Fail");
if(mysqli_num_rows($result7) > 0){
    
?>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                <li><a class='<?php echo(($_SERVER['PHP_SELF'] == "/news-site/index.php") ? "active" : "")  ?>' href='<?php echo $host_name ?>'>Home</a></li>
                    <?php while($row7 = mysqli_fetch_assoc($result7)){ 
                        if(isset($_GET['cat-id'])){
                            $active_status = $_GET['cat-id'] == $row7['category_id'] ? "active" : "";
                        }else{
                            $active_status = "";
                        }
                        echo "<li><a class='{$active_status}' href='category.php?cat-id={$row7['category_id']}'>{$row7['category_name']}</a></li>";

                    }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php

} else {
    echo "<tr><td colspan='7'>No Data Found</td></tr>";
  } ?>
<!-- /Menu Bar -->
