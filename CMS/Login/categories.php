<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
      if(!isset($_SESSION['username'])){
        header('Location: Login.php');
      }
      elseif(isset($_SESSION['username']) && $_SESSION['role']=='author'){
        header('Location: index.php'); 
    }
    if(isset($_GET['del'])){
        $del_id=$_GET['del'];
       if(isset($_SESSION['username']) and $_SESSION['role']=='admin'){
            $del_query="DELETE FROM categories WHERE id='$del_id'";
        if(mysqli_query($conn,$del_query)){
            $del_msg="Category has been Deleted";
        }
        else{
            $del_error="Category Has Not Been Deleted";
        }
       }
    }
    
    if(isset($_POST['submit'])){
        $cat_name=mysqli_real_escape_string($conn,strtolower($_POST['cat_name']));
        if(empty($cat_name)){
            $error="Category Name Required";
        }
        else{
            $check_query="SELECT * FROM categories WHERE category='$cat_name'";
        $check_run=mysqli_query($conn,$check_query);
        if(mysqli_num_rows($check_run)>0){
            $error="Category Already Exist";
        }                                   
        else{
            $insert_query="INSERT INTO categories (category) VALUES ('$cat_name') ";
            if(mysqli_query($conn,$insert_query)){
                $msg="Category Added";
            }
            else{
                $error="Category Has Not Been Added";
            }
        }
        }
    }
    
    if(isset($_GET['edit'])){
        $edit_id=$_GET['edit'];
    }
    
     if(isset($_POST['update'])){
        $cat_name=mysqli_real_escape_string($conn,strtolower($_POST['cat_name']));
        if(empty($cat_name)){
            $up_error="Category Name Required";
        }
        else{
            $check_query="SELECT * FROM categories WHERE category='$cat_name'";
        $check_run=mysqli_query($conn,$check_query);
        if(mysqli_num_rows($check_run)>0){
            $up_error="Category Already Exist";
        }                                   
        else{
            $update_query="UPDATE `categories` SET `category` = '$cat_name' WHERE `categories`.`id` =$edit_id";
            if(mysqli_query($conn,$update_query)){
                $up_msg="Category Updated";
            }
            else{
                $up_error="Category Has Not Been Updated";
            }
        }
        }
    }
    
    ?>
  <body>
     <div  id="wrapper">
       <?php require("include/nav.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                   <?php require("include/sidebar.php") ?>
                </div>
                <div class="col-md-9">
                    <h1 class="head animated fadeInUp"><i class="fa fa-folder "></i> Categories <small>Different Categories</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.html"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li ><i class="fa fa-folder"></i> Categories</li>
                    </ul>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <?php
                                        if(isset($msg)){
                                            echo "<span class='pull-right' style='color:green';>$msg</span>";
                                        }
                                        elseif(isset($error)){
                                            echo "<span class='pull-right' style='color:red';>$error</span>";
                                        }
                                    ?>
                                    <input type="text" placeholder="Category Name" name="cat_name" class="form-control">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
                            </form>
                            <?php
                                if(isset($_GET['edit'])){
                                    $edit_check_query="SELECT * FROM categories WHERE id='$edit_id'";
                                    $edit_run=mysqli_query($conn,$edit_check_query);
                                    if(mysqli_num_rows($edit_run)>0){
                                        
                                   $edit_row=mysqli_fetch_array($edit_run);
                                    $up_category=$edit_row['category'];
                            ?>
                            
                            <hr/>
                             <form action="" method="post">
                                <div class="form-group">
                                    <label for="category">Update Name</label>
                                    <?php
                                        if(isset($up_msg)){
                                            echo "<span class='pull-right' style='color:green';>$up_msg</span>";
                                        }
                                        elseif(isset($up_error)){
                                            echo "<span class='pull-right' style='color:red';>$up_error</span>";
                                        }
                                    ?>
                                    <input type="text" value="<?php echo $up_category; ?>" placeholder="Category Name" name="cat_name" class="form-control">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update Category" name="update">
                            </form>
                            <?php 
                                    }
                                }
                            ?>
                        </div>
                        <div class="col-md-6">
                           <?php
                                $show_query="SELECT * FROM categories ORDER BY id DESC";
                                $show_run=mysqli_query($conn,$show_query);
                                if(mysqli_num_rows($show_run)>0){
                                     if(isset($del_msg)){
                                            echo "<span class='pull-right' style='color:green';>$del_msg</span>";
                                        }
                                        elseif(isset($del_error)){
                                            echo "<span class='pull-right' style='color:red';>$del_error</span>";
                                        }
                            ?>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr #</th>
                                        <th>Category Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                    while($row=mysqli_fetch_array($show_run)){
                                        $cat_id=$row['id'];
                                        $cat_name=$row['category'];
                                    ?>
                                    <tr>
                                        <td><?php echo $cat_id; ?></td>
                                        <td><?php echo ucfirst($cat_name); ?> </td>
                                        <td><a href="categories.php?edit=<?php echo $cat_id; ?>"><i class="fa fa-pencil"></i></a></td>
                                        <td><a href="categories.php?del=<?php echo $cat_id; ?>"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                 <?php  } ?>
                                  
                                </tbody>
                            </table>
                            <?php
                                 }
                                else{
                                    echo "<center><h3>No category Found</h3></center>";
                                }
                            ?>
                        </div>
                    </div>
                   
                </div>     
                  
            </div>
        </div>
      <?php require("include/footer.php") ?>
      </div>    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>