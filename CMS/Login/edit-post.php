<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
    if(!isset($_SESSION['username'])){
        header('Location: Login.php');
    }
    $Session_username=$_SESSION['username'];
    $Session_image=$_SESSION['author_image'];
    $Session_role=$_SESSION['role'];
    
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        if($Session_role=='admin'){
            $query="select * from posts where id='$id'";
            $get_run=mysqli_query($conn,$query);
        }
        elseif($Session_role=='author'){
             $query="select * from posts where id='$id' and author='$Session_username'";
            $get_run=mysqli_query($conn,$query);
            
        }
        if(mysqli_num_rows($get_run)>0){
            $get_row=mysqli_fetch_array($get_run);
            $title=$get_row['title'];
            $post_data=$get_row['post_date'];
            $tags=$get_row['tags'];
            $image=$get_row['image'];
            $status=$get_row['status'];
            $category=$get_row['category'];
        }
        else{
            header('location:posts.php');
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
                    <h1 class="head animated fadeInUp"><i class="fa fa-pencil "></i> Edit Post <small>Update Post</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-pencil"></i> Edit Post</li>
                    </ul>
                    <?php
                        if(isset($_POST['update'])){
                            $up_title=mysqli_real_escape_string($conn,$_POST['title']);
                            $up_post_data=mysqli_real_escape_string($conn,$_POST['post-data']);
                            $up_category=$_POST['category'];
                            $up_tags=mysqli_real_escape_string($conn,$_POST['tags']);
                            $up_status=$_POST['status'];
                            $up_image=$_FILES['image']['name'];
                            $up_tmp_name=$_FILES['image']['tmp_name'];
                            if(empty($up_image)){
                                $up_image=$image;
                            }
                            if(empty($title) or empty($post_data) or empty($tags) or empty($image) or empty($up_image)){
                                $error="All (*) Fields Required";
                            }
                            else{
                                $up_query="update posts set title='$up_title',image='$up_image',category='$up_category',tags='$up_tags',post_date='$up_post_data',status='$up_status' where id='$id'";
                                if(mysqli_query($conn,$up_query)){
                                    $msg="Post Updated";
                                    $path="img/$up_image";
                                    $title="";
                                    $post_data="";
                                    $tags="";
                                    $status="";
                                    $category="";
                                    if(!empty($up_image)){
                                        if(move_uploaded_file($up_tmp_name,$path)){
                                            copy($path,"../$path");
                                        }
                                    }
                                    header('location:posts.php');
                                    
                                }
                                else{
                                    $error="Post Not Updated";
                                }
                            }
                        }
                    
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="title">Title:*</label>
                                    <?php
                                        if(isset($msg)){
                                            echo "<span class='pull-right' style='color:green'; >$msg</span>";
                                        }
                                        elseif(isset($error)){
                                            echo "<span class='pull-right' style='color:red' >$error</span>";
                                        }
                                    ?>
                                    <input type="text" name="title" value="<?php if(isset($title)){echo $title;}?>" placeholder="Enter Title" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <a href="" class="btn btn-primary" >Add Media</a>
                                </div>
                                <div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control textarea" >
                                        <?php if(isset($post_data)){echo $post_data;}?>
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Post-image">Post Image:*</label>
                                            <input type="file" name="image" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="Post-image">Category:*</label>
                                            <select name="category" id="category" class="form-control" >
                                                <?php
                                                    $cat_query="SELECT * FROM categories ORDER BY id DESC";
                                                    $cat_run=mysqli_query($conn,$cat_query);
                                                    if(mysqli_num_rows($cat_run)>0)
                                                    {
                                                        while($row=mysqli_fetch_assoc($cat_run))
                                                        {
                                                            $cat_name=$row['category'];
                                                            echo "<option value='".$cat_name."' ".((isset($category) and $category==$cat_name)?"Selected":"")." >".ucfirst($cat_name)."</option>";
                                                            
                                                        }
                                                    }
                                                    else{
                                                        echo "<center><h2>No category Available</h2></center>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Post-image">Tags:*</label>
                                            <input type="text" class="form-control" value="<?php if(isset($tags)){echo $tags;}?>" name="tags" placeholder="Your Tags here" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="Status">Status:*</label>
                                            <select name="status" id="status" class="form-control" >
                                                <option value="publish" <?php if(isset($status) and $status=='publish'){echo "selected";}?> >Publish</option>
                                                <option value="draft" <?php if(isset($status) and $status=='draft'){echo "selected";}?> >Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="update" value="Update Post" class="btn btn-primary ">
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
      <?php require("include/footer.php") ?>
   