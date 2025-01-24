<?php 
ob_start();
session_start();
include "header.php";
include "config.php";
if($_SESSION['role'] == '0'){
    header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['update'])){
    $categoryid = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    
    $sql = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = {$categoryid}";
    $result = mysqli_query($conn, $sql) or die("query wrong...");
    
        if($result){
          header("Location:{$hostname}/admin/category.php");exit;
        }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <?php
              $categoryid = $_GET['id'];
              $sql1 = "SELECT * FROM category WHERE category_id = {$categoryid}";
              $result1 = mysqli_query($conn, $sql1) or die("query failed");
             if(mysqli_num_rows($result1) > 0){
                 while($predw = mysqli_fetch_assoc($result1)){
              ?>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php  $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $predw['category_id'];  ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $predw['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Submit" required />
                  </form>
                </div>
                <?php }} ?>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
