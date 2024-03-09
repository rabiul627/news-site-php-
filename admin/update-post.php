<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">

        <?php
        include "./config.php";
        $getId = $_GET['id'];
        $sql = "SELECT * FROM post  
                LEFT JOIN category ON post.category = category.category_id 
                LEFT JOIN user ON post.author = user.user_id
                WHERE post.post_id = {$getId} ";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <!-- Form for show edit-->
            <form action="./save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
              <div class="form-group">
                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control" required rows="5">
                    <?php echo $row['description']; ?>
                </textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <?php
                  $catSql = "SELECT * FROM category";
                  $catResult = mysqli_query($conn, $catSql) or die("Category Query Failed");
                  while ($catRow = mysqli_fetch_assoc($catResult)) {
                    if ($catRow['category_id'] == $row['category']) {
                      $selected = "selected";
                    } else {
                      $selected = "";
                    }
                    echo "<option value='{$catRow['category_id']}' {$selected}>{$catRow['category_name']}</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
              </div>
              <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            </form>
            <!-- Form End -->
        <?php
          }
        } else {
          echo "Result not found.";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
