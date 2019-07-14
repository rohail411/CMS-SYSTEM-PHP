<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
    if(!isset($_SESSION['username'])){
        header('Location: Login.php');
    }
    $Session_username=$_SESSION['username'];
    $Session_image=$_SESSION['author_image'];
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
                    <h1 class="head animated fadeInUp"><i class="fa fa-plus-square "></i> Add Post <small>Add New Post</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-plus-square"></i> Add Post</li>
                    </ul>
                    <?php
                        if(isset($_POST['submit'])){
                            $date=time();
                            $title=mysqli_real_escape_string($conn,$_POST['title']);
                            $post_data=mysqli_real_escape_string($conn,$_POST['post-data']);
                            $category=$_POST['category'];
                            $tags=mysqli_real_escape_string($conn,$_POST['tags']);
                            $status=$_POST['status'];
                            $image=$_FILES['image']['name'];
                            $tmp_name=$_FILES['image']['tmp_name'];
                            if(empty($title) or empty($post_data) or empty($tags) or empty($image)){
                                $error="All (*) Fields Required";
                            }
                            else{
                                $insert_query="insert into posts(date,title,author,author_img,image,category,tags,post_date,views,status) values('$date','$title','$Session_username','$Session_image','$image','$category','$tags','$post_data','0','$status')";
                                if(mysqli_query($conn,$insert_query)){
                                    $msg="Post Added to Database";
                                    $path="img/$image";
                                    $title="";
                                    $post_data="";
                                    $tags="";
                                    $status="";
                                    $category="";
                                    if(move_uploaded_file($tmp_name,$path)){
                                        copy($path,"../$path");
                                    }
                                    
                                }
                                else{
                                    $error="Post Not Added to Database";
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
                        <input type="submit" name="submit" value="Add Post" class="btn btn-primary ">
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
      <?php require("include/footer.php") ?>
   