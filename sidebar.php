<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <div class="recent-post">
               <?php
                          include"./config.php";
                          $limit = 3;
                          $sql = " SELECT * FROM post  
                          LEFT JOIN category ON post.category = category.category_id 
                          ORDER BY post.post_id DESC LIMIT {$limit} ";
                           $result = mysqli_query($conn,$sql) or die ("Query Unsuccessful recent post.....");
                           if (mysqli_num_rows($result) > 0){
                            while ( $row = mysqli_fetch_assoc($result)){
                    ?>


            <a class="post-img" href="">
            <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" />
            </a>
            <div class="post-content">
                <h5><a href="single.php"><?php  echo $row['title'];?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php'> <?php  echo $row['category_name'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php  echo $row['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php  echo $row['post_id'];?>">read more</a>
            </div>
            <?php
                }
              }
            ?>
        </div>
    </div>
    <!-- /recent posts box -->
</div>
