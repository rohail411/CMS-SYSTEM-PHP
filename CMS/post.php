<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php") ?>
  <body>
   <?php require("include/nav.php") ?>
 
   <?php
      if(isset($_GET['post_id'])){
         $post_id=$_GET['post_id'];
          $view_query="UPDATE `posts` SET `views` = views+1 WHERE `posts`.`id` = $post_id";
          mysqli_query($conn,$view_query);
          $q="SELECT * FROM posts WHERE status='publish' and id=$post_id";
          $run=mysqli_query($conn,$q);
          if(mysqli_num_rows($run)>0){
              $row=mysqli_fetch_array($run);
              $id=$row['id'];
              $date=getdate($row['date']);
              $day=$date['mday'];
              $month=$date['month'];
              $year=$date['year'];
              $title=$row['title'];
              $author=$row['author'];
              $author_img=$row['author_img'];
              $image=$row['image'];
              $categories=$row['category'];
              $data=$row['post_date'];
          }
          else{
              header('Location : index.php');
          }
      }
      
      
      ?>
   
    <div class="jumbotron">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>Custom<span> Post</span></h1>
                <p>This Is the post</p>
            </div>
        </div>
        <img src="img/top-image.jpg" alt="Top Image">
    </div> 
   
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="post post-margin">
                        <div class="row">
                            <div class="col-md-2 post-date">
                                <div class="day"><?php echo $day; ?></div>
                                <div class="month"><?php echo $month; ?></div>
                                <div class="year"><?php echo $year; ?></div>
                            </div>
                            <div class="col-md-8 post-title">
                                <a href=""><h2><?php echo $title; ?></h2></a>
                                <p>Written By: <span><?php echo ucfirst($author); ?></span></p>
                            </div>
                            <div class="col-md-2 profile-pic">
                                <img src="img/<?php echo $author_img; ?>" class="img-circle" alt="profile">
                            </div>

                        </div>
                        <a href="img/<?php echo $image; ?>"><img src="img/<?php echo $image; ?>" alt=""></a>
                        <div class="desc">
                        <?php echo $data; ?>
                        <br/><br/>
                        
                        </div>
                        <div class="bottum">
                            <span class="fspan"><i class="fa fa-folder"></i><a href=""> <?php echo ucfirst($categories); ?></a></span>|
                            <span class="lspan"><i class="fa fa-comment"></i><a href=""> Comment</a></span>
                        </div>
                    </div>
                    <div class="related-post">
                       <h3>Related Post</h3>
                       <hr/>
                        <div class="row">
                           <?php 
                                $r_query="SELECT * FROM posts WHERE status='publish' AND title LIKE '%$title%' LIMIT 3";
                                $r_run=mysqli_query($conn,$r_query);
                                while($row=mysqli_fetch_array($r_run)){
                                    $r_id=$row['id'];
                                    $r_title=$row['title'];
                                    $r_image=$row['image'];
                                
                            ?>
                            <div class="col-sm-4">
                               <a href="post.php?post_id=<?php echo $r_id; ?>">
                                <img src="img/<?php echo $r_image; ?>" alt="">
                                <h4><?php echo $title; ?></h4>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="aurthor">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="img/<?php echo $author_img; ?>" alt="profile" class="img-circle" >
                            </div>
                            <div class="col-sm-9">
                                <h4><?php echo ucfirst($author); ?></h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $c_query="SELECT * FROM comments WHERE status='approved' AND post_id='$post_id' ORDER BY id DESC";
                        $c_run=mysqli_query($conn,$c_query);
                        if(mysqli_num_rows($c_run)>0){
                            
                    ?>
                    <div class="comment">
                        <h3>Comments</h3>
                        <?php 
                            while($row=mysqli_fetch_array($c_run)){
                                $c_id=$row['id'];
                                $c_name=$row['name'];
                                $c_username=$row['username'];
                                $c_image=$row['image'];
                                $c_comment=$row['comment'];
                        ?>
                        <hr/>
                        <div class="row single-comment">
                            <div class="col-sm-2">
                                <img src="img/<?php echo $c_image; ?>" alt="unknown" class="img-circle">
                            </div>
                            <div class="col-sm-10">
                                <h4><?php echo ucfirst($c_name); ?></h4>
                                <p><?php echo $c_comment; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                   <?php } 
                    
                        if(isset($_POST['submit'])){
                            $cs_name=$_POST['name'];
                            $cs_email=$_POST['email'];
                            $cs_website=$_POST['website'];
                            $cs_comment=$_POST['comment'];
                            $cs_date=time();
                            if(empty($cs_name) or empty($cs_email) or empty($cs_comment)){
                                $error_msg="All (*) feilds are Required";
                            }
                            else{
                                $cs_query="INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'unknown-picture.png', '$cs_comment', 'pending')";
                                if(mysqli_query($conn,$cs_query)){
                                    $msg="Comment Submitted and waiting for Approval";
                                        $cs_name="";
                                        $cs_email="";
                                        $cs_website="";
                                        $cs_comment="";
                                }
                                else{
                                    $error_msg="Comment Has not Been Submitted";
                                }
                            }
                        }
                    
                    
                    ?>
                    <div class="comment-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="name">Full Name:*</label>
                                        <input type="text" id="name" value="<?php if(isset($cs_name)){ echo $cs_name;} ?>" name="name" class="form-control" placeholder="Full Name">
                                    </div>
                                      <div class="form-group">
                                        <label for="email">Email:*</label>
                                        <input type="text" id="email" value="<?php if(isset($cs_email)){ echo $cs_email;} ?>" name="email" class="form-control" placeholder="Email">
                                    </div>
                                      <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" id="website" name="website" value="<?php if(isset($cs_website)){ echo $cs_website;} ?>" class="form-control" placeholder="Website URL">
                                    </div>
                                      <div class="form-group">
                                        <label for="comment">Comment:*</label>
                                        <textarea  id="comment" name="comment" placeholder="Message" class="form-control" cols="30" rows="10">
                                            <?php if(isset($cs_comment)){ echo $cs_comment;} ?>
                                        </textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="submit" Value="Submit">
                                    <?php
                                        if(isset($error_msg)){
                                            echo "<span style='color:red;' class='pull-right'>$error_msg</span>";
                                        }
                                        else if(isset($msg)){
                                         echo "<span style='color:green;' class='pull-right'>$msg</span>";
                                    }
                                    
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                 <?php require("include/sidebar.php") ?>                       
                </div>
            </div>
        </div>
    </section> 
   <?php require("include/footer.php") ?>
  