<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                             
                    <?php
                    include"./config.php";
                            $post_id = $_GET['id'];
                            $sql = " SELECT * FROM post  
                          LEFT JOIN category ON post.category = category.category_id 
                          LEFT JOIN user ON post.author = user.user_id
                          WHERE post_id = {$post_id}";
                          $result = mysqli_query($conn,$sql) or die ("Query Unsuccessful");
                          if (mysqli_num_rows($result) > 0){
                           while ( $row = mysqli_fetch_assoc($result)){
                    ?>

                        <div class="post-content single-post">
                            <h3><?php  echo $row['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid= <?php  echo $row['category'];?>"> <?php  echo $row['category_name'];?></a>
                                    
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php  echo $row['author'];?>'> <?php  echo $row['username'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php  echo $row['post_date'];?>
                                </span>
                            </div>
                           
                            <a class="single-feature-image" href="single.php?id=<?php  echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                            <p class="description">
                            <?php  echo $row['description'];?>
                            </p>
                        </div>

                        <?php
                           }
                        }else {
                            echo "result not found";
                        }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
