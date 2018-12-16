<?php 
error_reporting(0);
    include 'lib/Session.php';
   	Session::init();	 	
    include 'config/config.php';
    include 'lib/Database.php';
    include 'helpers/Format.php';

    $db = new Database();
    $fm = new Format();
?>
<?php
    if(isset($_GET['action']) && $_GET['action'] == "logout"){
        Session::destroy();
        header("Location:signin.php");
    }
?>
<!DOCTYPE html >
<html lang="en">
  <head>
    <title>HandiCraft</title>
    <link rel="icon"  href="images/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
  </head>
  <body>
    
    
    <!-- Start Top header -->
    <section class="container-fluid bg">
      <div class="container">
        <div class="row">
          <div class="top-header">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="top-header-contact">
                <ul class="list-inline list-unstyled">
                  <li><img src="images/phone_icon.png" alt="phone icon" class="img-responsive logo-phone"></li>
                  <li class="space">01600-000000</li>
                  <li><img src="images/email_.png" alt="email icon" class="img-responsive logo-gmail"> </li>
                  <li>info@onlineshop.com</li>
                </ul>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="search">
                
              </div>
              <div class="signup text-right">
                <ul class="list-inline list-unstyled">
                  <li>
                    <form>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                      </div>
                    </form>
                  </li>
                  <li><img src="images/h4.png" alt="email icon" class="img-responsive logo-gmail"> </li>
                  <li>
                      <?php
                      $name = Session::get('user_name');
                      if($name){
                          ?>
                          <a href="#"> <?php echo $name; ?></a> / <a href="?action=logout">Logout</a>
                          <?php
                      }else{
                          ?>
                          <a href="signin.php"> Sign In</a> / <a href="signup.php">Register</a>
                          <?php
                      }
                      ?> 
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Start  Nav -->
    <div class="container nav_text">
      <div class="row">
        <nav class="navbar ">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <ul class="list-inline logo_content">
              <li>
                <a class="navbar-brand" id="global" href="index.php">
                  <img src="images/logo.png" alt="logo" class="img-responsive">
                </a>
              </li>
              <li>
                <p>| HandiCraft</p>
              </li>
            </ul>  
          </div>
          <div class="collapse navbar-collapse navbar-right nav_space js-navbar-collapse">
            <ul class="nav navbar-nav nav_color">
                <?php
                        //$query = "select * from catagory";
                       // $category = $db->select($query);
                        //if($category){
                         //   while($result = $category->fetch_assoc()){  
                ?>
              <li><a href="index.php">Home</a></li>
              <li><a href="allproduct.php">All Product</a></li>  
              <li><a href="giftcard.php">Gift Card</a></li>
              <li><a href="painting.php">Painting</a></li>
              <li><a href="ornaments.php">Ornaments</a></li>
              <li><a href="homemade.php">Home Decorate</a></li>
                <?php
                         //   }
                        //}
                ?>
              <li><a href="offerzone.php">Offer Zone</a></li>
            </ul>
            
          </div>
        </nav>
      </div>
    </div>
      

