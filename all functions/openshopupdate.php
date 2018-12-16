<?php 
error_reporting(0);
    include 'lib/Session.php';
   	Session::checkSession();	 	
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
              <li><a href="index.php">Home</a></li>
              <li><a href="giftcard.php">Gift Card</a></li>
              <li><a href="painting.php">Painting</a></li>
              <li><a href="ornaments.php">Ornaments</a></li>
              <li><a href="homemade.php">Home Decorate</a></li>
              <li><a href="offerzone.php">Offer Zone</a></li>
            </ul>
            
          </div>
        </nav>
      </div>
    </div>
      



    <!-- Start openshop -->

    <div class="container-fluid">
      <div class="row">
        <div class="shopopen">
          <div class="col-md-9">
            <div class="col-md-6">
              <div class="shopbanner">
                <div class="jumbotron">

<?php

if (isset($_POST['update'])){
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $user_name = mysqli_real_escape_string($db->link, $_POST['user_name']);
            $user_contact = mysqli_real_escape_string($db->link, $_POST['user_contact']);
            $user_reg_id = mysqli_real_escape_string($db->link, $_POST['user_reg_id']);
                
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
                
            if ($file_size >1048567) {
                echo "<span style='color:red'>Image Size should be less then 1MB!</span>";
            }elseif (in_array($file_ext, $permited) === false) {
                echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query ="UPDATE shop
                        SET 
                        name ='$name',
                        user_name ='$user_name',
                        image ='$unique_image',
                        user_contact ='$user_contact'                        
                        WHERE user_reg_id ='$user_reg_id'";
                $inserted_rows = $db->update($query);
                if ($inserted_rows) {
                    echo "<span style='color:green'>Data Update Successfully.</span>";
                }else {
                    echo "<span style='color:red'>Data Update Not Inserted !</span>";
                }
            }      
        }

?>
<?php
    $id=Session::get('id_reg');
    $query = "select * from shop where user_reg_id='$id'";
    $post = $db->select($query);
    if($post){
        while($result = $post->fetch_assoc()){
?>
            <form class="" action="openshopupdate.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name" >Shop Name:</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $result['name'];?>" id="shopname">
                        <input type="hidden" name="user_name" value="<?php echo Session::get('user_name');?>" class="medium" />
                      <input type="hidden" name="user_contact" value="<?php echo Session::get('contact_num');?>" class="medium" />
                      <input type="hidden" name="user_reg_id" value="<?php echo Session::get('id_reg');?>" class="medium" />
                    </div>
                      <label  for="exampleInputFile">Banner :</label>
                      <div class="form-group">
                        <input type="file" name="image" id="exampleInputFile">
                      </div>
                      <input type="hidden" name="update" value="<?php echo $result['user_reg_id'];?>" />

                      <input type="submit" name="update" class="btn btn-success" value="Update">
                  </form>
<?php
        }
    }
?>    
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="shopbanner">
                  <?php
                    $id=Session::get('id_reg');
                    $query = "select * from shop where user_reg_id='$id'";
                    $post = $db->select($query);
                    if($post){
                        while($result = $post->fetch_assoc()){  
                ?>
                <h2><?php echo $result['name'];?></h2>
                <div class="imageshop">
                  <img src="upload/<?php echo $result['image'];?>" class="img-thumbnail" alt="Banner" style="height: 224px; width: 100%;">
                <?php 
                        } 
                    }else{
                        ?>
                        <h2>Shope Name</h2>
                <div class="imageshop">
                  <img src="images/shop.jpg" class="img-thumbnail" alt="Banner" style="height: 224px; width: 100%;">
                    <?php
                    }
                ?>
                </div>
              </div>
            </div>
              <div class="col-md-12">
                <h2>Your Products</h2>
                <hr>
                  <?php
                        $id=Session::get('id_reg');
                        $query = "select * from product where user_reg_id='$id'";
                        $product = $db->select($query);
                        if($product){
                            while($result = $product->fetch_assoc()){  
                    ?>
                <div class="col-md-3">
                    <div class="img-thumbnail">
                        <a href="viewproduct.php?viewprotid=<?php echo $result['id_product']; ?>"><img src="upload/product/<?php echo $result['image']?>" alt="men one" class="img-responsive" style="height: 150px; width:250px;"></a>
                    </div>
            
                    <div class="price">
                    <h4 style="padding-top: 20px;"><?php 
                                echo $result['pro_name'];                                
                                ?></h4>
                    <span class="new_price">BDT <?php echo $result['pro_price'];?></span>
                  </div>
                </div>
                  <?php } }else{
                            echo "you have no product";
                        } ?>

                
               
                

                

                
               
                
                <div class="paginations">
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li>
                        <a href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
          </div>
          <div class="col-md-3">
            
            <div class="addproduct">
              <div class="shopmore">
              <h2><a href="productlist.php">Manage your products</a></h2>
            </div>
              <div class="shopmore">
                <h2>Add new products</h2>
              </div>
<?php
if (isset($_POST['submit_product'])){
    $pro_name = mysqli_real_escape_string($db->link, $_POST['pro_name']);
    $pro_price = mysqli_real_escape_string($db->link, $_POST['pro_price']);
    $catagory = mysqli_real_escape_string($db->link, $_POST['catagory']);
    $pro_details = mysqli_real_escape_string($db->link, $_POST['pro_details']);
    $user_contact = mysqli_real_escape_string($db->link, $_POST['user_contact']);
    $user_reg_id = mysqli_real_escape_string($db->link, $_POST['user_reg_id']);
    $user_name = mysqli_real_escape_string($db->link, $_POST['pro_user']);
         
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/product/".$unique_image;
                
    if ($file_size >1048567) {
        echo "<span style='color:red'>Image Size should be less then 1MB!</span>";
    }elseif (in_array($file_ext, $permited) === false) {
        echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";
    }else{
        move_uploaded_file($file_temp, $uploaded_image);
        $query="INSERT INTO product(pro_name, pro_price, image, catagory, pro_details, pro_user, pro_user_contact, user_reg_id) VALUES('$pro_name', '$pro_price', '$unique_image', '$catagory', '$pro_details', '$user_name', '$user_contact', '$user_reg_id')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
            echo "<span style='color:green'>Data Update Successfully.</span>";
        }else {
            echo "<span style='color:red'>Data Update Not Inserted !</span>";
        }
    }      
}
?>
                <form action="" method="post" enctype="multipart/form-data">
              <div>
                <label for="name" >Product Name:</label>
                    <input type="text" name="pro_name" required class="form-control" id="shopname">
              </div>

                   <label for="name" >Product Price:</label>
                    <input type="text" name="pro_price" required class="form-control" id="shopname">
                  

              <div class="addpro">
                <div class="imageload">
                  
                    <label for="exampleInputFile">Image input</label>
                    <div class="form-group">
                      <input type="file" name="image" required id="exampleInputFile">
                        <input type="hidden" name="pro_user" value="<?php echo Session::get('user_name');?>" class="medium" />
                      <input type="hidden" name="user_contact" value="<?php echo Session::get('contact_num');?>" class="medium" />
                      <input type="hidden" name="user_reg_id" value="<?php echo Session::get('id_reg');?>" class="medium" />
                    </div>
                  
                </div>

                <div class="procatagory">
                   
                    <label>Product catagory</label><br>
                       <?php
                        $query = "select * from catagory";
                        $category = $db->select($query);
                        if($category){
                            while($result = $category->fetch_assoc()){  
                    ?>
                    <input type="radio" name="catagory" value="<?php echo $result['id_cat'];?>" required><?php echo $result['cat_name'];?><br>
                      <?php
                            }
                        }
                    ?> 
                 
                </div>
                <div class="prodetails">
                  <label>Product details</label></br>
                  <textarea rows="4" cols="32" name="pro_details" required form="usrform" placeholder="Prodect deteles here..."></textarea>
                </div>

                <input type="submit" name="submit_product" class="btn btn-success" value="Add Product">              
                <a href="orderlist.php" class="btn btn-success">
                    Order List
                </a>
                
                 
              </div>
              </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    




     <!-- Start footer -->
<?php include("inc/footer.php"); ?>