   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar "></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
              <div class="col-xs-3"><img src="img/logo.png" alt="Logo" width="30px"></div>
              <div class="col-xs-9">Rohail Butt </div>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> Categories <span class="caret"></span></a>
              <ul class="dropdown-menu">
               <?php 
                    $q="SELECT * FROM categories ORDER BY id DESC";
                    $qu=mysqli_query($conn,$q);
                    if(mysqli_num_rows($qu)>0){
                        while($run=mysqli_fetch_array($qu)){
                            $category=ucfirst($run['category']);
                            $id=$run['id'];
                            echo "<li><a href='index.php?cat=".$id."'>$category</a></li>";
                        }
                    }
                        else{
                            echo "<li><a href='#'>No Category Available</a></li>";
                        }
                  
                ?>
              </ul>
            </li>
            <li><a href="contactUs.php"><i class="fa fa-phone"></i> Contact Us</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav> 