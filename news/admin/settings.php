<?php 
include "header.php";
include "config.php";
?>
 
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading web">Website Logo & Website Footer Update</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php

                    $sql = "SELECT * FROM settings";
                    $result = mysqli_query($conn, $sql) or die("Query failed....");
                    if(mysqli_num_rows($result) > 0){
                    while($roes = mysqli_fetch_assoc($result)){
                  ?>
                  <!-- Form -->
                  <form  action="save-settings.php" method="POST" enctype="multipart/form-data">
                      <!--<div class="form-group">-->
                           <!--<input type="hidden" name="web"  class="form-control" value="<?php echo $roes['web_id']; ?>" placeholder="" >-->
                      <!--</div>-->
                      <div class="form-group">
                          <label for="website_name">Website Name</label>
                          <input type="text" name="website_name" class="form-control" value="<?php echo $roes['websitename']; ?>" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Website image</label>
                          <input type="file" name="logo" required>
                          <img src="upload/<?php echo $roes['logo']; ?>" alt="" style="height:100px"/>
                          <input type="hidden" name="logo" value="<?php echo $roes['logo']; ?>"/>
                      </div>
                       <div class="form-group">
                          <label for="description">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5"  required><?php echo $roes['footerdesc']; ?></textarea>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <?php }
                  }else{
                      echo"file not yet....";
                  }?>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>