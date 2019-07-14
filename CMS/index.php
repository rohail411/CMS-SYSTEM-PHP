<?php require("include/db.php")?>
<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php") ?>
 <?php
    
        if(isset($_GET['page'])){
            $page_id=$_GET['page'];
        }
        else{
            $page_id=1;
        }
        if(isset($_GET['cat'])){
            $cat_id=$_GET['cat'];
            $cat_query="SELECT * FROM categories WHERE id= $cat_id";
            $cat_run=mysqli_query($conn,$cat_query);
            $cat_row=mysqli_fetch_array($cat_run);
            $cat_name=$cat_row['category'];
        }
        $page_of_post=3;
        if(isset($_POST['Search'])){
            $search=$_POST['Search-title'];
            $all_of_post="SELECT * FROM posts WHERE status='publish'";
            $all_of_post.=" and tags LIKE '%$search%'";
        $all_of_run=mysqli_query($conn,$all_of_post);
        $all_of_row=mysqli_num_rows($all_of_run);
        $total_post=ceil($all_of_row/$page_of_post);
        $post_start=($page_id-1)*$page_of_post;
        }else{
            $all_of_post="SELECT * FROM posts WHERE status='publish'";
        if(isset($cat_name)){
            $all_of_post.=" and category ='$cat_name'";
        }
        $all_of_run=mysqli_query($conn,$all_of_post);
        $all_of_row=mysqli_num_rows($all_of_run);
        $total_post=ceil($all_of_row/$page_of_post);
        $post_start=($page_id-1)*$page_of_post;
        }
    ?>
  <body>
  <?php require("include/nav.php")?>
    <div class="jumbotron">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>Rohail Butt<span> Blog</span></h1>
                <p>This is an online Tutorial Huge Portal. So now Shine With Us</p>
            </div>
        </div>
        <img src="img/top-image.jpg" alt="Top Image">
    </div> 
   
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <?php
                    $squery="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 5";
                    $run=mysqli_query($conn,$squery);
                    if(mysqli_num_rows($run)>0){
                         $count=mysqli_num_rows($run);
                    ?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <?php
                            for($i=0;$i<$count;$i++){
                                if($i==0){
                                    echo "<li data-target='carousel-example-generic' data-slide-to='".$i."' class='active'></li>";
                                }
                                else
                                {
                                    echo "<li data-target='#carousel-example-generic' data-slide-to='".$i."' ></li>";
                                }
                            }  
                          
                          ?>
                            
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                       <?php
                            $check=0;
                            while($row=mysqli_fetch_array($run)){
                                $s_id=$row['id'];
                                $s_image=$row['image'];
                                $s_title=$row['title'];
                                $check=$check+1;
                                if($check==1){
                                    echo "<div class='item active'>";
                                }
                                else{
                                    echo "<div class='item '>";
                                }  
                        ?>
                        
                          <a href="post.php?post_id=<?php echo $s_id; ?>"><img src="img/<?php echo $s_image; ?>" alt="Slider 1"></a>
                          <div class="carousel-caption">
                              <h4><?php echo $s_title; ?></h4>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                        
                             
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                     <?php
                        }
                       if(isset($_POST['Search'])){
                           $search=$_POST['Search-title'];
                            $q="SELECT * FROM posts WHERE status ='publish'";
                            $q.=" and tags LIKE '%$search%'";
                        $q.=" ORDER BY id DESC LIMIT $post_start,$page_of_post";
                       }
                        else{
                             $q="SELECT * FROM posts WHERE status ='publish'";
                        if(isset($cat_name)){
                            $q.=" and category ='$cat_name'";
                        }
                        $q.=" ORDER BY id DESC LIMIT $post_start,$page_of_post";
                        }
                        $run=mysqli_query($conn,$q);
                        if(mysqli_num_rows($run)>0){
                            while($row=mysqli_fetch_array($run)){
                                $id=$row['id'];
                                $date=getdate( $row['date']);
                                $day=$date['mday'];
                                $month=$date['month'];
                                $year=$date['year'];
                                $title=$row['title'];
                                $author=$row['author'];
                                $author_image=$row['author_img'];
                                $image=$row['image'];
                                $categories=$row['category'];
                                $tag=$row['tags'];
                                $post_data=$row['post_date'];
                                $views=$row['views'];
                                $status=$row['status'];
                    ?>
                        <div class="post">
                        <div class="row">
                            <div class="col-md-2 post-date">
                                <div class="day"><?php echo $day ?></div>
                                <div class="month"><?php echo $month ?></div>
                                <div class="year"><?php echo $year ?></div>
                            </div>
                            <div class="col-md-8 post-title">
                                <a href="post.php?post_id=<?php echo $id ?>"><h2><?php echo $title ?></h2></a>
                                <p>Written By: <span><?php echo $author ?></span></p>
                            </div>
                            <div class="col-md-2 profile-pic">
                                <img src="img/<?php echo $author_image ?>" class="img-circle" alt="profile">
                            </div>

                        </div>
                        <a href="post.php?post_id=<?php echo $id ?>"><img src="img/<?php echo $image ?>" alt=""></a>
                        <div class="desc"> <?php echo substr($post_data,0,500)."..."; ?></div>
                        <a href="post.php?post_id=<?php echo $id ?>" class="btn btn-primary ">Read More</a>
                        <div class="bottum">
                            <span class="fspan"><i class="fa fa-folder"></i><a href=""><?php echo ucfirst(" ".$categories)  ?></a></span>|
                            <span class="lspan"><i class="fa fa-comment"></i><a href=""> Comment</a></span>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                        else{
                            echo "<center><h2>No Post Availabe</h2</center>";     
                        }
                    
                    ?>
                    
                    <nav id="pagination">
                        <ul class="pagination">
                            <li><a href="" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a></li>
                           <?php 
                                for($i=1;$i<=$total_post;$i++){
                                    echo "<li class='".($page_id==$i ? 'active':'')."'><a href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li>";
                                }
                            ?>
                            <li><a href="" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-4">
                    <?php require("include/sidebar.php") ?>       
                </div>
            </div>
        </div>
    </section> 
    <?php require("include/footer.php") ?>