<?php
if ($_SESSION['role'] == '0'){
  header("location: http://localhost/news_site/admin/post.php");
}

  include "./config.php";
  $userid = $_GET['id'];

  $sql = " DELETE FROM user WHERE user_id = {$userid} ";
  if (mysqli_query($conn,$sql)){
    header("location: http://localhost/news_site/admin/users.php");
  }else {
     echo "Error" .  mysqli_error($conn);
  }
?>