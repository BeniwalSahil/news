<?php
include "config.php";
$pagew = basename($_SERVER['PHP_SELF']);
switch($pagew){
    case "single.php":
        if(isset($_GET['id'])){
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $result_title = mysqli_query($conn,$sql_title) or die('title_query failed..');;
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title']. "News";
        }else{
            $page_title = "No Page Found...";
        }
    break;
    case "category.php":
      if(isset($_GET['cid'])){
            $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $result_title = mysqli_query($conn, $sql_title) or die('title_query failed..');;
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['category_name']. "News";
        }else{
            $page_title = "No Page Found...";
        }
    break;
  
    case "author.php":
      if(isset($_GET['aid'])){
            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $result_title = mysqli_query($conn,$sql_title) or die('title_query failed..');;
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = "News By ".$row_title['first_name'] . " " . $row_title['last_name'];
        }else{
            $page_title = "No Page Found...";
        }
    break;
    case "search.php":
      if(isset($_GET['search'])){
          $page_title = $_GET['search'];
        }else{
            $page_title = "No Page Found...";
        }
    break;
    default:
      $page_title = " NEWS SITE";
    break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--<title>NEws</title>-->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!--bootstrap 5.3.3-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <?php
                        include "config.php";
                        $sql ="SELECT * FROM settings";
                        $result= mysqli_query($conn, $sql) or die("Query failed :header");
                        if(mysqli_num_rows($result) > 0){
                            while($roww = mysqli_fetch_assoc($result)){
                                if($row['logo'] = ''){
                                    echo '<a href="index.php"><h1>'.$roww['websitename'].'</h1><a/>';
                                }else{
                                    echo'<a href="index.php" id="logo"><img src="admin/images/'. $roww['logo'].'"></a>';
                                }
                ?>
                <?php 
                            }
                        }
                ?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }
                // $cat_id = $_GET['cid'];
                $sql = "SELECT * FROM category WHERE post > 0";
                //  die("query faied");
                $result = mysqli_query($conn, $sql) or die("query failed..");
                if(mysqli_num_rows($result) > 0){
                $active = '';
                ?>
                    <ul class='menu'>
                        <li><a class='{$active}' href='<?php echo $hostname ?>'>Home</a></li>
                        <?php while($row = mysqli_fetch_assoc($result)){
                            if(isset($_GET['cid'])){
                                if($row['category_id'] == $cat_id){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }                            
                            }
                            
                            // die("query failed..");
                        echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                         } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
