<?php include 'header.php'; ?>

<?php
    if(isset($_GET['search'])){
    include "config.php";

        $limit = 4;
        $curren_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($curren_page - 1) * $limit;
        $sql =  "SELECT 
                post.post_id, 
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
                WHERE 
                post.title LIKE '%{$_GET['search']}%'
                OR
                post.description LIKE '%{$_GET['search']}%'
                ORDER BY post_id DESC
                LIMIT {$offset}, {$limit}";

        $result = mysqli_query($conn, $sql) or die("Query Fail");
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $_GET['search'] ?></h2>
                  <?php 
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
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
                                        <p class="description">
                                            <?php echo substr( $row['description'], 0, 200) . "..." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Data Found</td></tr>";
                          } ?>

                        <?php
                        $sqlPagQuery = "SELECT * FROM post 
                                        WHERE 
                                        title LIKE '%{$_GET['search']}%'
                                        OR
                                        description LIKE '%{$_GET['search']}%'";
                        $result2 = mysqli_query($conn, $sqlPagQuery) or die("Query Fail");

                        if(mysqli_num_rows($result2) > 0){
                            $pageCount = ceil(mysqli_num_rows($result2) / $limit);
                            echo "<ul class='pagination'>";
                            if($curren_page > 1){
                                echo "<li><a href='{$_SERVER['PHP_SELF']}?search={$_GET['search']}&page=".($curren_page - 1)."'>Prev</a></li>";
                            }

                            for($i = 1; $i <= $pageCount; $i++){
                                $active_class = ($i == $curren_page) ? "active" : "";
                                echo "<li class='{$active_class}'><a href='{$_SERVER['PHP_SELF']}?search={$_GET['search']}&page={$i}'>{$i}</a></li>";
                            }

                            if($pageCount > $curren_page){
                                echo "<li><a href='{$_SERVER['PHP_SELF']}?search={$_GET['search']}&page=".($curren_page + 1)."'>Next</a></li>";
                            }

                            echo "</ul>";
                        }
                        ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php  } ?>

<?php include 'footer.php'; ?>