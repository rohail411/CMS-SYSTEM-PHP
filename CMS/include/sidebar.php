                 <div class="side">
                       <form action="index.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ..." name="Search-title">
                            <span class="input-group-btn">
                                <input type="submit" value="GO!" class="btn btn-default" name="Search">
                            </span>
                        </div>
                        </form>
                    </div><!-- side Close-->
                    <div class="side">
                    <div class="pupolar">
                       <h4>Pupolar Post</h4>
                       <?php 
                        $q="SELECT *FROM posts WHERE status='publish' ORDER BY views DESC LIMIT 5";
                        $run=mysqli_query($conn,$q);
                        if(mysqli_num_rows($run)>0){
                            while($row=mysqli_fetch_array($run)){
                                $p_id=$row['id'];
                                $p_date=getdate($row['date']);
                                $day=$p_date['mday'];
                                 $month=$p_date['month'];
                                 $year=$p_date['year'];
                                $p_title=$row['title'];
                                $p_image=$row['image'];
                                
                        ?>
                       <hr/>
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="post.php?post_id=<?php echo $p_id; ?>"> <img src="img/<?php echo $p_image; ?>" alt="Image1"></a>
                            </div>
                            <div class="col-xs-8 sdetail" >
                                <a href="post.php?post_id=<?php echo $p_id; ?>"> <h4><?php echo $p_title; ?></h4></a>
                                <p><i class="fa fa-clock-o"></i> <?php echo $day." ".$month." ".$year  ?></p>
                            </div>
                        </div>
                        <?php 
                                }
                            }
                            else{
                            echo "<h4>No Post Available</h4>";
                            }
                        ?>
                        <hr/>
                       
                       
                    </div>                
                </div>    
                         <div class="side">
                    <div class="pupolar">
                       <h4>Recent Post</h4>
                       <?php 
                        $q="SELECT *FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 5";
                        $run=mysqli_query($conn,$q);
                        if(mysqli_num_rows($run)>0){
                            while($row=mysqli_fetch_array($run)){
                                $p_id=$row['id'];
                                $p_date=getdate($row['date']);
                                $day=$p_date['mday'];
                                 $month=$p_date['month'];
                                 $year=$p_date['year'];
                                $p_title=$row['title'];
                                $p_image=$row['image'];
                                
                        ?>
                       <hr/>
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="post.php?post_id=<?php echo $p_id; ?>"> <img src="img/<?php echo $p_image; ?>" alt="Image1"></a>
                            </div>
                            <div class="col-xs-8 sdetail" >
                                <a href="post.php?post_id=<?php echo $p_id; ?>"> <h4><?php echo $p_title; ?></h4></a>
                                <p><i class="fa fa-clock-o"></i> <?php echo $day." ".$month." ".$year  ?></p>
                            </div>
                        </div>
                        <?php 
                                }
                            }
                            else{
                            echo "<h4>No Post Available</h4>";
                            }
                        ?>
                        <hr/>
                       
                       
                    </div>                
                </div> 
                    <div class="side">
                    <div class="pupolar">
                       <h4>Categories</h4>
                       <hr/>
                       <div class="row">
                           <div class="col-xs-6">
                               <ul>
                                   <?php 
                                        $cquery="SELECT * FROM categories ";
                                        $c_run=mysqli_query($conn,$cquery);
                                        if(mysqli_num_rows($c_run)>0){
                                            $count=2;
                                            while($row=mysqli_fetch_array($c_run)){
                                                $c_id=$row['id'];
                                                $c_category=ucfirst( $row['category']);
                                                $count=$count+1;
                                                if(($count%2)==1){
                                                    echo "<li><a href='index.php?cat=$c_id'> $c_category</a></li>";
                                                }
                                            }
                                        }
                                        else{
                                            echo "<p>No Category Available</p>";
                                        }
                                   
                                   ?>
                               </ul> <!--ADD php Function into echo Statement eg echo ".(ucfirst($count))." -->
                           </div>
                           <div class="col-xs-6">
                               <ul>
                                     <?php 
                                        $cquery="SELECT * FROM categories ";
                                        $c_run=mysqli_query($conn,$cquery);
                                        if(mysqli_num_rows($c_run)>0){
                                            $count=2;
                                            while($row=mysqli_fetch_array($c_run)){
                                                $c_id=$row['id'];
                                                $c_category=ucfirst( $row['category']);
                                                $count=$count+1;
                                                if(($count%2)==0){
                                                    echo "<li><a href='index.php?cat=$c_id'> $c_category</a></li>";
                                                }
                                            }
                                        }
                                        else{
                                            echo "<p>No Category Available</p>";
                                        }
                                   
                                   ?>
                               </ul>
                           </div>
                       </div>
                       
                    </div>        
                </div>
                    <div class="side">
                    <div class="social">
                           <h4>Social Icons</h4>
                           <hr/>
                           <div class="row">
                               <div class="col-xs-4">
                                   <a href=""><img src="img/facebook.png" alt="facebook"></a>
                               </div>
                               <div class="col-xs-4">
                                   <a href=""><img src="img/twitter.png" alt="twitter"></a>
                               </div>
                               <div class="col-xs-4">
                                   <a href=""><img src="img/googleplus.png" alt="google"></a>
                               </div>
                           </div>
                           <hr/>
                           <div class="row">
                               <div class="col-xs-4">
                                   <a href=""><img src="img/linkedin.png" alt="linkdin"></a>
                               </div>
                               <div class="col-xs-4">
                                   <a href=""><img src="img/skype.png" alt="skype"></a>
                               </div>
                               <div class="col-xs-4">
                                   <a href=""><img src="img/youtube.gif" alt="youtube"></a>
                               </div>
                           </div>
                        </div>        
                    </div>  