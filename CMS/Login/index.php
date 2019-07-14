<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
    if(!isset($_SESSION['username'])){
        header('Location: Login.php');
    }
    $get_comment="select * from comments where status='pending'";
    $get_post="select * from posts";
    $get_user="select * from users";
    $get_category="select * from categories";
    $run_comment=mysqli_query($conn,$get_comment);
    $run_post=mysqli_query($conn,$get_post);
    $run_user=mysqli_query($conn,$get_user);
    $run_category=mysqli_query($conn,$get_category);
    $row_comment=mysqli_num_rows($run_comment);
    $row_post=mysqli_num_rows($run_post);
    $row_user=mysqli_num_rows($run_user);
    $row_category=mysqli_num_rows($run_category);
    ?>
  <body>
     <div  class="wrapper">
       <?php require("include/nav.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                <?php require("include/sidebar.php") ?>
                </div>
                <div class="col-md-9">
                    <h1 class="head animated fadeInUp"><i class="fa fa-tachometer "></i> DashBoard <small>Statistics Overview</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><i class="fa fa-tachometer"></i> DashBoard</li>
                    </ul>
                    <div class="row tag-boxes animated zoomInUp">
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right huge"><?php echo $row_comment;?></div>
                                            <div class="text-right ">New Comments </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comment.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Comments</span>
                                        <span class="pull-right">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right huge"><?php echo $row_post;?></div>
                                            <div class="text-right ">All Posts </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Posts</span>
                                        <span class="pull-right">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-orange">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right huge"><?php echo $row_user;?></div>
                                            <div class="text-right ">View All Users </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="user.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Users</span>
                                        <span class="pull-right">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-folder-open fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right huge"><?php echo $row_category;?></div>
                                            <div class="text-right ">Categories </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Categories</span>
                                        <span class="pull-right">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <h3>New Users</h3>
                    <?php
                        $get_user="select * from users order by id DESC limit 5";
                        $get_user_run=mysqli_query($conn,$get_user);
                        if(mysqli_num_rows($get_user_run)>0){
                    ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row=mysqli_fetch_array($get_user_run)){
                                $user_id=$row['id'];
                                $user_date=getdate($row['date']);
                                $day=$user_date['mday'];
                                $month=substr($user_date['month'],0,3);
                                $year=$user_date['year'];
                                $first_name=$row['first_name'];
                                $last_name=$row['last_name'];
                                $username=$row['username'];
                                $user_role=$row['role'];
                                
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $user_id;?></td>
                                <td><?php echo "$day-$month-$year";?></td>
                                <td><?php echo "$first_name $last_name";?></td>
                                <td><?php echo ucfirst($username);?></td>
                                <td><?php echo $user_role;?></td>
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                    <a href="user.php" class="btn btn-primary">View All users</a>
                    <?php } ?>
                      <?php
                        $get_post="select * from posts order by id DESC limit 5";
                        $get_post_run=mysqli_query($conn,$get_post);
                        if(mysqli_num_rows($get_post_run)>0){
                    ?>
                    <table class="table table-striped table-hover">
                        <h3>New Posts</h3>
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Post Title</th>
                                <th>Categories</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                           <?php 
                            while($row=mysqli_fetch_array($get_post_run)){
                                $post_id=$row['id'];
                                $post_date=getdate($row['date']);
                                $p_day=$post_date['mday'];
                                $p_month=substr($post_date['month'],0,3);
                                $p_year=$post_date['year'];
                                $p_title=$row['title'];
                                $p_category=ucfirst($row['category']);
                                $p_views=$row['views'];
                                
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $post_id;?></td>
                                <td><?php echo "$p_day-$p_month-$p_year";?></td>
                                <td><?php echo $p_title;?></td>
                                <td><?php echo $p_category;?></td>
                                <td><i class="fa fa-eye"></i> <?php echo $p_views;?></td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                    <a href="posts.php" class="btn btn-primary">View All Posts</a>
                    <?php }?>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
      <?php require("include/footer.php") ?>
   