<?php
    $session_role=$_SESSION['role'];
    $get_query="select * from comments where status='pending'";
    $get_run=mysqli_query($conn,$get_query);
    $get_rows=mysqli_num_rows($get_run);

?>
                       

                               <div class="list-group">
                        <a href="index.php" class="list-group-item active">
                            <i class="fa fa-tachometer"></i> DashBoard</a>
                        <a href="posts.php" class="list-group-item">
                            <i class="fa fa-file-text"></i> All Posts</a>
                            <a href="media.php" class="list-group-item">
                            <i class="fa fa-database"></i> Media</a>
                        <?php  
                            if($session_role=='admin'){
                            ?>
                            <a href="comment.php" class="list-group-item">
                            <?php 
                                if($get_rows>0){
                                    echo " <span class='badge'>$get_rows</span>";         
                                }
                                ?>
                           
                            <i class="fa fa-comment"></i> Comments
                        </a>
                        <a href="categories.php" class="list-group-item">
                            <i class="fa fa-folder-open"></i> Categories</a>
                        <a href="user.php" class="list-group-item">
                            <i class="fa fa-users"></i> Users</a>
                          <?php } ?>
                    </div>