<?php
include "config.php";
// $web_post = $_GET['gid'];

if(isset($_FILES['logo']['name'])){
    $file_name = $_POST['logo'];
}else{
    $errors = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $file_ext = strtolower(end(explode('.',$file_name)));
    $extensions = array("jpeg","png","jpg");
    if(in_array($file_ext,$extensions) === false){
        $errors[] = "This extension file not allowed,Please choose a JPG or PNG format are only allowed";
    } 
    if($file_size > 2097152){
        $errors[] = "File size must be 2MB or Lower";
    }
    if(empty($errors) == true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }
}

    $sql = "UPDATE settings SET websitename='{$_POST['website_name']}',logo='{$file_name}',footerdesc='{$_POST['footer_desc']}'";
    // print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: {$hostname}/admin/settings.php");
    }else{
       echo "Query failed..."; 
    }

?>