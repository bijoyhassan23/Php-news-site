<?php include "header.php"; ?>
<?php 
include "config.php";
if(isset($_GET['id'])){
    $sql = "SELECT * FROM user where user_id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql) or die("Query Fail");
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['submit'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $sql2 = "UPDATE user 
    SET 
    first_name = '{$f_name}', 
    last_name = '{$l_name}', 
    username = '{$username}'
    where user_id = {$user_id}";
    if(mysqli_query($conn, $sql2)){
        header("Location: {$host_name}/admin/users.php");
    }
}
?>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                              <option value="0" <?php echo $row['role'] == 0 ?  "selected" : "" ?>>Normal User</option>
                              <option value="1" <?php echo $row['role'] == 1 ?  "selected" : "" ?>>Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
