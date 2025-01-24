<?php 
include "config.php";
session_start();
if($_SESSION['role'] == '0'){
    header("Location: {$hostname}/admin/post.php");
}
$categoryid = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id = {$categoryid}";
if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/category.php");
}else{
    echo '<p style="color:red; text-align:center; border:10px 0px"> Can not delete the category.</p>';
}
mysqli_close($conn);
?>