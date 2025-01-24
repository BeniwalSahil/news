<?php include "header.php"; 
include "config.php";
if(isset($_POST['save'])){
    $category_name = mysqli_real_escape_string($conn, $_POST['cat']);
    $sql1 = "SELECT category_name FROM category WHERE category_name = ('{$category_name}')";
    $result = mysqli_query($conn, $sql1) or die("Connection failed");
    if(mysqli_num_rows($result) > 0 ){
        echo "<p style='color:red; text-align:center; border:10px 0px;'>This category already exsits</p>";
    }else{
        $sql = " INSERT INTO category(category_name) VALUES('{$category_name}') ";
        if(mysqli_query($conn, $sql)){
                 echo '<script>
                            window.location.href ="https://advertindia.co.in/vin_ecom/news-site/admin/category.php";
                        </script>';
        }
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
