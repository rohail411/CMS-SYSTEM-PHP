<!DOCTYPE html>
<html lang="en">
  <?php require("include/top.php");
      if(!isset($_SESSION['username'])){
        header('Location: Login.php');
        }
    ?>
  <?php
        if(isset($_GET['del'])){
            $del_id=$_GET['del'];
            if($_SESSION['role']=='admin')
            {
                $del_query="DELETE FROM `posts` WHERE `posts`.`id` = '$del_id'";
                $del_run=mysqli_query($conn,$del_query);
            }
            else if($_SESSION['role']=='author')
            {
                $del_query="DELETE FROM `posts` WHERE `posts`.`id` = '$del_id' AND author='$username'";
                $del_run=mysqli_query($conn,$del_query);
            }
                if($del_run){
                    $msg="Post Has Been Deleted";
                }
                else{
                    $error="Post Has Not Been Deleted";
                }
            
        }
    $username=$_SESSION['username'];
    if(isset($_POST['checkboxes'])){
        foreach($_POST['checkboxes'] as $user_id){
            $bulk_option=$_POST['bulk-options'];
            if($bulk_option=='delete'){
                $bulk_del_query="DELETE FROM `posts` WHERE `posts`.`id` = '$user_id'";
                mysqli_query($conn,$bulk_del_query);
            }
            elseif($bulk_option=='publish'){
                $bulk_author_query="UPDATE `posts` SET `status` = 'publish' WHERE `posts`.`id` = '$user_id'";
                mysqli_query($conn,$bulk_author_query);
            }
            elseif($bulk_option=='draft'){
                $bulk_admin_query="UPDATE `posts` SET `status` = 'draft' WHERE `posts`.`id` = '$user_id'";
                mysqli_query($conn,$bulk_admin_query);
            }
        }
    }
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
                    <h1 class="head animated fadeInUp"><i class="fa fa-file "></i> Posts <small>View All Posts</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.html"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-file"></i> Posts</li>
                    </ul>
                    <?php
                        if($_SESSION['role']=='admin'){$query="SELECT * FROM posts ORDER BY id DESC";
                        $run=mysqli_query($conn,$query);}
                        else if($_SESSION['role']=='author'){$query="SELECT * FROM posts WHERE author='$username' ORDER BY id DESC";
                        $run=mysqli_query($conn,$query);}
                        if(mysqli_num_rows($run)>0){
                            
                    ?>
                    <form action="posts.php" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <select name="bulk-options" id="" class="form-control">
                                                <option value="delete">Delete</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="submit" class="btn btn-success" value="Apply">
                                        <a href="add-post.php" class="btn btn-primary">Add New</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <?php
                        if(isset($error)){
                            echo "<span class='pull-right' style='color:red'; >$error</span>";
                        }
                        elseif(isset($msg)){
                             echo "<span class='pull-right' style='color:green'; >$msg</span>";
                        }
                    ?>
                    <div class="table-responsive-md">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                               <th><input type="checkbox" id="selectallboxes"></th>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Categories</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                while($row=mysqli_fetch_array($run)){
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $author=ucfirst($row['author']);
                                    $views=$row['views'];
                                    $categories=$row['category'];
                                    $image=$row['image'];
                                    $date=getdate($row['date']);
                                    $day=$date['mday'];
                                    $month=substr($date['month'],0,3);
                                    $year=$date['year'];
                                    $status=$row['status'];
                            
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>" ></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo "$day $month $year"; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $author; ?></td>
                                <td><img src="img/<?php echo $image; ?>" alt="" width="30px"></td>
                                <td><?php echo $categories;?></td>
                                <td><?php echo $views; ?></td>
                                <td><span style="color:<?php if($status=='publish'){echo 'green';}else{echo 'red';} ?>;" ><?php echo ucfirst($status);?></span></td>
                                <td><a href="edit-post.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="posts.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <?php
                        }
                        else{
                            echo "<center><h2>No User Available</h2><center>";
                        }
                    ?>
                    </form>
                </div>     
                  
            </div>
          
        </div>
        <?php require("include/footer.php") ?>
  