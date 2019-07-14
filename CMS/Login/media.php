<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
    if(!isset($_SESSION['username'])){
        header('Location: Login.php');
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
                    <h1 class="head animated fadeInUp"><i class="fa fa-database "></i> Media <small>View All Media Files</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-database"></i> Media</li>
                    </ul>
                    <?php
                        if(isset($_POST['submit'])){
                            if(count($_FILES['media']['name'])>0)
                            {
                                for($i=0;$i<count($_FILES['media']['name']);$i++)
                                {
                                    $image=$_FILES['media']['name'][$i];
                                    $tmp_name=$_FILES['media']['tmp_name'][$i];
                                    $query="insert into media (image) values('$image')";
                                    if(mysqli_query($conn,$query))
                                    {
                                        $path="media/$image";
                                        if(move_uploaded_file($tmp_name,$path)){
                                            copy($path,"../$path");
                                        }
                                    }
                                }
                            }
                        }
                    
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4 col-xs-8">
                                <input type="file" name="media[]" required multiple >
                            </div>
                            <div class="col-sm-4 col-xs-4 ">
                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Media " >
                            </div>
                        </div>
                    </form><hr/>
                    <div class="row">
                       <?php
                            $get_query="select * from media";
                            $run=mysqli_query($conn,$get_query);
                           if(mysqli_num_rows($run)>0)
                           {
                               while($getname=mysqli_fetch_array($run))
                               {
                                   $img_name=$getname['image'];
                        ?>
                        <div class="col-lg-2 col-md-4 col-sm-3 col-xs-6 thumb">
                            <a href="<?php echo $img_name;?>">
                                <img src="media/<?php echo $img_name;?>" class="thumbnail" width="100%" alt="">
                            </a>
                        </div>
                       <?php
                        
                               }
                           }
                        else
                        {
                            echo "<center><h2>No Media Available</h2></center>";
                        }
                        ?>
                    </div>                                      
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
      <?php require("include/footer.php") ?>
   