<?php include "header.php"; ?>
<?php
// session_start();
ob_start();
include "config.php"; 
if($_SESSION['role'] == '0'){
    header("Location: {$hostname}/admin/post.php");
}
if(isset($_POST['submit'])){
  
  $userid  = mysqli_real_escape_string($conn, $_POST['user_id']);
  $fname  = mysqli_real_escape_string($conn, $_POST['f_name']);
  $lname  = mysqli_real_escape_string($conn, $_POST['l_name']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  
   $sql = "UPDATE user SET first_name = '{$fname}',last_name = '{$lname}',username = '{$username}',password = '{$password}',role='{$role}' WHERE user_id ={$userid}";
   
  $result = mysqli_query($conn, $sql) or die("query failed");exit;
  

  if($result){
      header("Location:{$hostname}/admin/users.php");
  }
  
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <?php
              
                  $user_id= $_GET['id'];
                  $sql="SELECT * FROM user WHERE user_id= {$user_id}";
                  $run = mysqli_query($conn, $sql) or die("Query Failed");
                  if(mysqli_num_rows($run) > 0){
                      while($row = mysqli_fetch_assoc($run)){
              
              ?>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                             <?php
                             if($row['role'] == 1)
                             {
                                 echo "<option value='0'>normal User</option>
                                 <option value='1' Selected>Admin</option>";
                             }else{
                                 echo"echo <option value='0' Selected>normal User</option>
                                 <option value='1'>Admin</option>;";
                             }
                             ?>
                              
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit" required />
                  </form>
                  <?php }} ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
