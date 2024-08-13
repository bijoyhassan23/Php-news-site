<?php include "header.php"; ?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>

                      <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new-image">
                        <img  src="upload/<?php echo $row['post_img'] ?>" height="150px">
                        <input type="hidden" name="old-image" value="<?php echo $row['post_img'] ?>">
                      </div>

                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>

                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
