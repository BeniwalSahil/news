<?php
include "config.php";

if (isset($_FILES['new-image']['name'])) {
    $target = $_POST['old-image'];
} else {
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extensions = array("jpeg", "png", "jpg");
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension file not allowed,Please choose a JPG or PNG format are only allowed...";
    }
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2MB or Lower";
    }
    $new_name = time() . "-" . basename($file_name);
    $target = "upload" . $new_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $target);
    } else {
        print_r($errors);
        die();
    }
}

$sql = "UPDATE post SET title='{$_POST['post_title']}',description='{$_POST['postdesc']}',
            category={$_POST['category']},post_img='{$target}' WHERE post_id={$_POST['post_id']};";
if ($_POST['old_category'] != $_POST['category']) {
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']}; ";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']};";
}
// echo $sql;
// die();
$result = mysqli_multi_query($conn, $sql);
if ($result) {
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "Query failed...";
}

?>