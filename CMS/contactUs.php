<!DOCTYPE html>
<html lang="en">
   <?php require("include/top.php") ?>
  <body>
    <?php require("include/nav.php") ?>
    <div class="jumbotron">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>Contact<span> US</span></h1>
                <p>I am Available for every Time. So Feel free and contact Us.</p>
            </div>
        </div>
        <img src="img/top-image.jpg" alt="Top Image">
    </div> 
   
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                          <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:400px;width:100%;'><div id='gmap_canvas' style='height:400px;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://addmap.net/'> </a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=64242ddc70ab36b043e34f5ba43601c16a0ff051'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(31.55460609999999,74.35715809999999),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(31.55460609999999,74.35715809999999)});infowindow = new google.maps.InfoWindow({content:'<strong>Daroghwala Lahore,</strong><br>Office 6, St # 1, Hajipura, Salamat pura<br>54000 Lahore<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                        </div>
                        <div class="col-md-12 contactform">
                           <h2>Contact Us</h2>
                           <hr/>
                           <?php
                                if(isset($_POST['submit'])){
                                    $name=mysqli_real_escape_string($conn,$_POST['name']);
                                    $email=mysqli_real_escape_string($conn,$_POST['email']);
                                    $website=mysqli_real_escape_string($conn,$_POST['website']);
                                    $comment=mysqli_real_escape_string($conn,$_POST['comment']);
                                    $to="rohailbutt411@gmail.com";
                                    $header="From $name<$email>";
                                    $subject="Message From $name";
                                    $message="<b>Name: </b>$name <br/><br/>
                                                <b>Email: </b>$email <br/><br/>
                                                <b>Website: </b>$website <br/><br/>
                                                <b>Messgae: </b>$comment <br/><br/>";
                                    if(empty($name) or empty($email) or empty($comment)){                                       $error="All (*) Fields Are required";
                                }
                                else{
                                   if( mail($to,$subject,$message,$header)){
                                       $msg="Message Has Been Sent";
                                   }
                                    else{
                                        $error="Message Has Not Been Sent";
                                    }
                                    }
                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="full-name">Full Name*:</label>
                                    <?php
                                        if(isset($error)){
                                            echo "<span class='pull-right' style='color:red'>$error</span>";
                                        }
                                    elseif(isset($msg)){
                                            echo "<span class='pull-right' style='color:green'>$msg</span>";
                                        }
                                    ?>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="full-name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Enter Email*:</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
                                </div>
                                
                                <div class="form-group">
                                    <label for="website">Website:</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="website" id="website">
                                </div>
                                
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea name="comment" class="form-control" id="message"  placeholder="Message" cols="30" rows="10"></textarea>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                     <?php require("include/sidebar.php") ?>                         
                </div>
            </div>
        </div>
    </section> 
    <?php  require("include/footer.php") ?>
