<?php
  include "./config.php";
  if (empty($_FILES['logo']['name'])){
    $file_name = $_POST['old-logo'];
  }else {
        $errors = array();
        
        $file_name = $_FILES['logo'] ['name'];
        $file_size = $_FILES['logo'] ['size'];
        $file_tmp = $_FILES['logo'] ['tmp_name'];
        $file_type = $_FILES['logo'] ['type'];
        $file_exp = explode('.',$file_name);
        $file_ext = strtolower(end($file_exp));
        $extensions = array ("jpeg","jpg","png");
        if (in_array($file_ext,$extensions) === false){
            $errors[] = "This extension file not allowed, please upload PNG or JPG images";
        }
        if ($file_size > 2097152){
            $errors [] = "file size must be 2mb or less";
        }
        if (empty($errors) == true){
            move_uploaded_file($file_tmp,"./images/" .$file_name);
        }
        else {
           print_r($errors);
           die();
            
        }
   
  }

    $sql = "UPDATE setting SET websitename='{$_POST["website_name"]}', logo='{$file_name}', descrition='{$_POST["footer_desc"]}'";
  
   $result = mysqli_query($conn,$sql) ;
   if ($result){
    header("location: http://localhost/news_site/admin/settings.php");
   }else {
    echo "Query Failed...." . mysqli_error($conn);
   }



?>