<?php include "header.php"; 
include"config.php";
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                $i = 1;
                $limit = 3; 
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                $sql = "SELECT * FROM category ORDER BY category_id ASC LIMIT {$offset} ,{$limit}";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0 ){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while($cat_row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td class='id'><?php echo $offset+$i ?></td>
                            <td><?php echo $cat_row['category_name']; ?></td>
                            <td><?php echo $cat_row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $cat_row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo  $cat_row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php $i++;  } ?>
                    </tbody>
                    <?php } ?>
                </table>
                <?php
                
                $sql3 = "SELECT * FROM category";
                $result2 = mysqli_query($conn, $sql3) or die('connection failed...');
                
                if(mysqli_num_rows($result2) > 0){
                    $total_records = mysqli_num_rows($result2);
                    $total_page = ceil($total_records / $limit );
                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                        echo "<li><a href='category.php?page=".($page - 1)."'>Prev</a></li>";
                    }
                    for($i = 1; $i <= $total_page; $i++){
                        if($i == 1){
                          $active = 'active';  
                        }else{
                            $active = ' ';
                        }
                        echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_page > $page){
                        echo "<li><a href='category.php?page=".($page + 1)."'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
