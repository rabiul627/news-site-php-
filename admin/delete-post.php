<?php
include "./config.php";

$userid = mysqli_real_escape_string($conn, $_GET['id']);
$cat_id = mysqli_real_escape_string($conn, $_GET['catID']);

// Fetch the post image path before deleting the post
$sql_fetch_image = "SELECT post_img FROM post WHERE post_id = '{$userid}'";
$result_fetch_image = mysqli_query($conn, $sql_fetch_image);
if ($result_fetch_image && mysqli_num_rows($result_fetch_image) > 0) {
    $row = mysqli_fetch_assoc($result_fetch_image);
    $post_img_path = "./upload/" . $row['post_img'];

    // Delete the post image file from the server
    if (file_exists($post_img_path)) {
        unlink($post_img_path);
    }

    // Delete the post from the database
    $sql_delete_post = "DELETE FROM post WHERE post_id = '{$userid}'";

    // Update the category post count
    $sql_update_category = "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";

    if (mysqli_query($conn, $sql_delete_post) && mysqli_query($conn, $sql_update_category)) {
        header("location: http://localhost/news_site/admin/post.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Post not found.";
}

mysqli_close($conn);
?>
