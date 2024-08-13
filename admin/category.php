<?php include "header.php"; ?>

<?php
    include "config.php";
    $limit = 3;
    $curren_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($curren_page - 1) * $limit;
    $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
    $result = mysqli_query($conn, $sql) or die("Query Fail");
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php 
                            if(mysqli_num_rows($result) > 0){
                                $post_serial = $offset;
                                while($row = mysqli_fetch_assoc($result)){
                                    $post_serial++;
                        ?>
                        <tr>
                            <td class='id'><?php echo $post_serial ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['post'] ?></td>
                            <td class='edit?'><a href='update-category.php?id="<?php echo $row['category_id'] ?>"'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id="<?php echo $row['category_id'] ?>"'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php }}else{
                            echo "<tr><td colspan='5'>No Data Found</td></tr>";
                          } ?>
                    </tbody>
                </table>
                <?php
                    $sqlPagQuery = "SELECT * FROM category";
                    $result2 = mysqli_query($conn, $sqlPagQuery) or die("Query Fail");

                    if(mysqli_num_rows($result2) > 0){
                        $pageCount = ceil(mysqli_num_rows($result2) / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($curren_page > 1){
                            echo "<li><a href='{$_SERVER['PHP_SELF']}?page=".($curren_page - 1)."'>Prev</a></li>";
                        }

                        for($i = 1; $i <= $pageCount; $i++){
                            $active_class = ($i == $curren_page) ? "active" : "";
                            echo "<li class='{$active_class}'><a href='{$_SERVER['PHP_SELF']}?page={$i}'>{$i}</a></li>";
                        }

                        if($pageCount > $curren_page){
                            echo "<li><a href='{$_SERVER['PHP_SELF']}?page=".($curren_page + 1)."'>Next</a></li>";
                        }

                        echo "</ul>";
                    }
                    
                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
