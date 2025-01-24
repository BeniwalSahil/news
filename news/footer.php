<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include "config.php";
                $sql = "SELECT * FROM settings";
                $result = mysqli_query($conn,$sql) or die("query failed. :footer");
                if(mysqli_num_rows($result)){
                    while($rws = mysqli_fetch_assoc($result)){
                ?>
                <span><?php echo $rws['footerdesc']?></span>
                <?php           
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
