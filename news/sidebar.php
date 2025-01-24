
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
          <?php
                    include "config.php";
                    $sql = "SELECT post.post_id, post.title,post.post_date,category.category_name,post.category,post.post_img FROM post 
                          LEFT JOIN category ON post.category = category.category_id ORDER BY post.post_id ASC LIMIT 3";
//  print_r($sql);
// die();   
                    $result = mysqli_query($conn, $sql) or die("Connection Failed...:Recent Post");
                 
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>">
                <img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row['post_id'];?>"><?php echo $row['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row['post_id']; ?>">read more</a>
            </div>
        </div>
    <?php }}else{ ?>
    no data
    <?php } ?>
    </div>
    <div class="recent-post-container">
        <h3><i>GET QUOTE</i></h3>
        <div class="">
            <form action="sendmail.php" method="POST">
                							<div class="row">
								<div class="form-group col-md-12 mb-4">
									<input type="text" name="name" class="form-control" placeholder="Name" required >
									<div class="help-block with-errors"></div>
								</div>

								<div class="form-group col-md-12 mb-4">
									<input type="email" name ="email" class="form-control" placeholder="Email" required >
									<div class="help-block with-errors"></div>
								</div>

								<div class="form-group col-md-12 mb-4">
									<input type="tel" name="phone" class="form-control" placeholder="Phone" required >
									<div class="help-block with-errors"></div>
								</div>

								<div class="form-group col-md-12 mb-4">
									<textarea name="message" class="form-control" rows="4" placeholder="Write a Message" required></textarea>
									<div class="help-block with-errors"></div>
								</div>

								<div class="col-md-12 text-center">
									<button type="submit" name="contact_submit" class="btn btn-success tt">Submit</button>
								</div>
							</div>

            </form>
        </div>
    </div>
    <!-- /recent posts box -->
</div>
