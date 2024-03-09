<?php
  include "./config.php";
  if (empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old-image'];
  }else {
        $errors = array();
        
        $file_name = $_FILES['new-image'] ['name'];
        $file_size = $_FILES['new-image'] ['size'];
        $file_tmp = $_FILES['new-image'] ['tmp_name'];
        $file_type = $_FILES['new-image'] ['type'];
        $file_ext = explode('.',$file_name);
        $file_ext_another = strtolower(end($file_ext));
        $extensions = array ("jpeg","jpg","png");
        if (in_array($file_ext_another,$extensions) === false){
            $errors[] = "This extension file not allowed, please upload PNG or JPG images";
        }
        if ($file_size > 2097152){
            $errors [] = "file size must be 2mb or less";
        }
        if (empty($errors) == true){
            move_uploaded_file($file_tmp,"./upload/" .$file_name);
        }
        else {
           print_r($errors);
           die();
            
        }
   
  }
     $post_id = $_POST['post_id'];
     $post_title = $_POST['post_title'];
     $post_des = $_POST['postdesc'];
     $post_cet = $_POST['category'];

  $sql = "UPDATE post SET title='{$post_title}', description='{$post_des}', category={$post_cet}, post_img='{$file_name}'
   WHERE post_id = '{$post_id }' ";

   $result = mysqli_query($conn,$sql) or die ("Query Failed....");
   if ($result){
    header("location: http://localhost/news_site/admin/post.php");
   }else {
    echo "Not found result....";
   }



?>