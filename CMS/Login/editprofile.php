<!DOCTYPE html>
<html lang="en">
  <?php require("include/top.php");
      if(!isset($_SESSION['username'])){
        header('Location: Login.php');
    }
    $session_user=$_SESSION['username'];
    if(isset($_GET['Edit'])){
        $edit_id=$_GET['Edit'];
        $edit_query="SELECT * FROM users WHERE id=$edit_id";
        $edit_run=mysqli_query($conn,$edit_query);
        if(mysqli_num_rows($edit_run)>0){
            $edit_row=mysqli_fetch_array($edit_run);
            $e_username=$edit_row['username'];
            if($e_username==$session_user){
                $e_firstname=$edit_row['first_name'];
            $e_last=$edit_row['last_name'];
            $e_image=$edit_row['image'];
            $e_details=$edit_row['detail'];
            }
            else{
                header('Location:index.php');
            }
        }
        else{
            header('Location:index.php');
        }
    }
    else{
        header('Location:index.php');
    }
    ?>
  <body>
     <div  class="wrapper">
       <?php require("include/nav.php") ?>
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-3">
                   <?php require("include/sidebar.php") ?>
                </div>
                <div class="col-md-9">
                    <h1 class="head animated fadeInUp"><i class="fa fa-user "></i> Edit Profile <small>Edit Profile Detail</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.html"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-user"></i> Edit Profile</li>
                    </ul>
                    <?php
                        if(isset($_POST['submit'])){
                            $first_name=mysqli_real_escape_string($conn,$_POST['first-name']);
                            $last_name=mysqli_real_escape_string($conn,$_POST['last-name']);
                            $password=mysqli_real_escape_string($conn,$_POST['password']);
                            $image=$_FILES['image']['name'];
                            $image_tmp=$_FILES['image']['tmp_name'];
                            $detail=mysqli_real_escape_string($conn,$_POST['detail']);
                            if(empty($image)){
                                $image=$e_image;
                            }
                            $salt_query="SELECT * FROM users ORDER BY id DESC LIMIT 1";
                            $salt_run=mysqli_query($conn,$salt_query);
                            $salt_row=mysqli_fetch_array($salt_run);
                            $sat=$salt_row['salt'];
                            $insert_password=crypt($password,$sat);
                            
                            if(empty($first_name) or empty($last_name)  or empty($image)){
                                $error="All (*) Fields Are required";
                            }
                            else{
                                $update_query="UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `image` = '$image', `detail` = '$detail'";
                                if(isset($password)){
                                    $update_query.=", `password` = '$insert_password' ";
                                }
                                $update_query.="WHERE `users`.`id` = '$edit_id'";
                                if(mysqli_query($conn,$update_query)){
                                    $msg="User has Been Updated";
                                }
                                else{
                                    $error="User Has Not been updated";
                                }
                                
                            }
                        }
                    ?>
                   <div class="row">
                       <div class="col-md-8">
                             <form action="" method="post" enctype="multipart/form-data">
                                   <div class="form-group">
                                       <label for="first-name">First Name:*</label>
                                       <?php 
                                            if(isset($error)){
                                                echo "<span class='pull-right' style=color:red; >$error</span>";
                                            }
                                            elseif(isset($msg)){
                                                echo "<span class='pull-right' style=color:green; >$msg</span>";   
                                            }
                                       ?>
                                       <input type="text" id="first-name" name="first-name" value="<?php echo $e_firstname; ?>" class="form-control"  placeholder="First Name">
                                   </div>

                                   <div class="form-group">
                                       <label for="last-name">Last Name:*</label>
                                       <input type="text" id="last-name" name="last-name" value="<?php echo $e_last; ?>" class="form-control" placeholder="Last Name">
                                   </div>

                                   <div class="form-group">
                                       <label for="Password">Password:*</label>
                                       <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                   </div>

                                   <div class="form-group">
                                       <label for="image">Profile Picture:*</label>
                                       <input type="file" id="image" name="image">
                                   </div>
                                    
                                    <div class="form-group">
                                       <label for="detail">Details:*</label>
                                        <textarea name="detail" id="detail" cols="30" class="form-control" rows="5">
                                            <?php echo $e_details; ?>
                                        </textarea>
                                   </div>

                                   <input type="submit" value="Add User" name="submit" class="btn btn-primary">
                           </form>
                           <br>
                           <br>
                           <br>
                       </div>
                       <div class="col-md-4">
                           <?php
                                    echo "<img src='img/$e_image' width='100%' >";
                                
                           ?>
                       </div>
                   </div>
                </div>     
                  
            </div>
        </div>
        <?php require("include/footer.php") ?>
  