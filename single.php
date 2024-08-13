<?php include 'header.php'; ?>
<?php 
include "config.php";
if(isset($_GET['id'])){
    $sql = "SELECT 
            post.title, 
            category.category_name,
            category.category_id,  
            post.post_date,
            post.post_img,
            post.description,
            post.author,
            user.username
            FROM post
            LEFT JOIN user
            ON post.author = user.user_id
            LEFT JOIN category
            ON post.category = category.category_id
            WHERE post.post_id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql) or die("Query Fail");
    $row = mysqli_fetch_assoc($result);
}else{
    die("there is no post");
}
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cat-id=<?php echo $row['category_id']?>'><?php echo $row['category_name'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aut-id=<?php echo $row['author']?>'><?php echo $row['username'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'] ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description'] ?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
