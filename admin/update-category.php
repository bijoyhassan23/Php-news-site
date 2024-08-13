<?php include "header.php"; ?>
<?php 
include "config.php";
if(isset($_GET['id'])){
    $sql = "SELECT * FROM category where category_id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql) or die("Query Fail");
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['submit'])){
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $sql2 = "UPDATE category 
    SET 
    category_name = '{$cat_name}'
    where category_id = {$cat_id}";
    if(mysqli_query($conn, $sql2)){
        header("Location: {$host_name}/admin/category.php");
    }

}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
