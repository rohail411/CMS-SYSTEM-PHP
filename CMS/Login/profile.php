<!DOCTYPE html>
<html lang="en">
 <?php require("include/top.php");
    if(!isset($_SESSION['username'])){
        header('Location: Login.php');
    }
    
    $session_user=$_SESSION['username'];
    $query="SELECT * FROM users WHERE username='$session_user'";
    $run=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($run);
    $image=$row['image'];
    $id=$row['id'];
    $date= getdate( $row['date']);
    $day=$date['mday'];
    $month=substr($date['month'],0,3);
    $year=$date['year'];
    $firstname=$row['first_name'];
    $lastname=$row['last_name'];
    $username=$row['username'];
    $email=$row['email'];
    $role=$row['role'];
    $details=$row['detail'];
    
    
    
    ?>
  <body id="profile">
     <div  class="wrapper">
       <?php require("include/nav.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                <?php require("include/sidebar.php") ?>
                </div>
                <div class="col-md-9">
                    <h1 class="head animated fadeInUp"><i class="fa fa-user "></i> Profile <small>Personal Details</small></h1>
                    <hr/>
                    <ul class="breadcrumb">
                        <li ><a href=""><i class="fa fa-tachometer"></i> DashBoard</a></li>
                        <li class="active"><i class="fa fa-user"> Users</i></li>
                    </ul>
                   <div class="row">
                           <div class="col-xs-12">
                               <center><img src="img/<?php echo $image; ?>" width="200px" class="img-circle img-thumbnail" alt="" id="profile-image"></center>
                            <br>
                              <a href="editprofile.php?Edit=<?php echo $id; ?>" class="btn btn-primary pull-right">Edit Profile</a>
                               <br>
                               <br>
                           <center>
                               <h3>Profile Details</h3>
                           </center>
                           <br>
                           <table class="table table-hover table-bordered">
                               <tr>
                                   <td width="20%" >User ID:</td>
                                   <td width="30%" ><?php echo $id; ?></td>
                                   <td width="20%" >Signup Date:</td>
                                   <td width="30%" ><?php echo "$day $month $year"; ?></td>
                               </tr>
                               <tr>
                                   <td width="20%" ><b>First Name</b></td>
                                   <td width="30%" ><?php echo $firstname; ?></td>
                                   <td width="20%" ><b>Last Name</b></td>
                                   <td width="30%" ><?php echo $lastname; ?></td>
                               </tr>
                               <tr>
                                   <td width="20%" ><b>User Name</b></td>
                                   <td width="30%" ><?php echo $username; ?></td>
                                   <td width="20%" ><b>Email:</b></td>
                                   <td width="30%" ><?php echo $email; ?></td>
                               </tr>
                               <tr>
                                   <td width="20%" ><b>Role</b></td>
                                   <td width="30%" ><?php echo $role; ?></td>
                                   <td width="20%" ></td>
                                   <td width="30%" ></td>
                               </tr>
                           </table>
                           <div class="row">
                               <div class="col-lg-8 col-sm-12">
                                   <b>Details</b>
                                   <div><?php echo $details; ?></div>
                               </div>
                               
                           </div>
                       </div>
                       <br>
                   </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
      <?php require("include/footer.php") ?>
   