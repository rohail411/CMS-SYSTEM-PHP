<!DOCTYPE html>
<html lang="en">
  <?php require("include/top.php");
      if(!isset($_SESSION['username'])){
        header('Location: Login.php');
        }
        elseif(isset($_SESSION['username']) && $_SESSION['role']=='author'){
            header('Location:index.php');
        }
    ?>
  <?php
        if(isset($_GET['del'])){
            $del_id=$_GET['del'];
            $del_query="DELETE FROM `users` WHERE `users`.`id` = '$del_id'";
            if(isset($_SESSION['username']) && $_SESSION['role']=='admin'){
                $del_run=mysqli_query($conn,$del_query);
                if($del_run){
                    $msg="User Has Been Deleted";
                }
                else{
                    $error="User Has Not Been Deleted";
                }
            }
        }
    
    if(isset($_POST['checkboxes'])){
        foreach($_POST['checkboxes'] as $user_id){
            $bulk_option=$_POST['bulk-options'];
            if($bulk_option=='delete'){
                $bulk_del_query="DELETE FROM `users` WHERE `users`.`id` = '$user_id'";
                mysqli_query($conn,$bulk_del_query);
            }
            elseif($bulk_option=='author'){
                $bulk_author_query="UPDATE `users` SET `role` = 'author' WHERE `users`.`id` = '$user_id'";
                mysqli_query($conn,$bulk_author_query);
            }
            elseif($bulk_option=='admin'){
                $bulk_admin_query="UPDATE `users` SET `role` = 'admin' WHERE `users`.`id` = '$user_id'";
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
                    <h1 class="head animated fadeInUp"><i class="fa fa-users "></i> Users <small>View All Users</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.html"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-users"></i> Users</li>
                    </ul>
                    <?php
                        $query="SELECT * FROM users ORDER BY id DESC";
                        $run=mysqli_query($conn,$query);
                        if(mysqli_num_rows($run)>0){
                            
                    ?>
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <select name="bulk-options" id="" class="form-control">
                                                <option value="delete">Delete</option>
                                                <option value="author">Change to Author</option>
                                                <option value="admin">Change to Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="submit" class="btn btn-success" value="Apply">
                                        <a href="adduser.php" class="btn btn-primary">Add New</a>
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                while($row=mysqli_fetch_array($run)){
                                    $id=$row['id'];
                                    $firstname=$row['first_name'];
                                    $lastname=ucfirst($row['last_name']);
                                    $username=ucfirst($row['username']);
                                    $email=$row['email'];
                                    $image=$row['image'];
                                    $role=ucfirst($row['role']);
                                    $date=getdate($row['date']);
                                    $day=$date['mday'];
                                    $month=substr($date['month'],0,3);
                                    $year=$date['year'];
                            
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>" ></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo "$day $month $year"; ?></td>
                                <td><?php echo "$firstname $lastname"; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><img src="img/<?php echo $image; ?>" alt="" width="30px"></td>
                                <td>**********</td>
                                <td><?php echo $role; ?></td>
                                <td><a href="edituser.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="user.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
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
  