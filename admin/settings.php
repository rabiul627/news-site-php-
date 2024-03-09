<?php include "header.php"; 

?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">

                   <?php
                        include "config.php";
                        $sqli = " SELECT * FROM setting ";
                        $result = mysqli_query($conn,$sqli) or die ("Query Failed settings file");
                        if ( mysqli_num_rows($result) > 0 ){
                            while ($row = mysqli_fetch_assoc($result)){
                    ?>
                  <!-- Form -->
                  <form  action="save-setting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="website_name">Website name</label>
                          <input type="text" name="website_name" class="form-control" value= " <?php  echo $row['websitename'];?> " autocomplete="off" required>
                      </div>
                      <div class="form-group">
                           <label for="logo">website logo</label>
                           <input type="file" name="logo">
                           <img src="upload/<?php  echo $row['logo'];?>" height= "130px">
                           <input type="hidden" name="old-logo" value=<?php  echo $row['logo'];?>">
                     </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Footer</label>
                          <textarea name="footer_desc" class="form-control" rows="5"  required><?php  echo $row['descrition'];?></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                         }
                      }

                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
