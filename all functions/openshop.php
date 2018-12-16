<?php
include("inc/header.php");
Session::checkSession();
?>
<?php
    $id=Session::get('id_reg');
    $query = "select * from shop where user_reg_id='$id'";
    $post = $db->select($query);
        if($post){
             echo "<script>window.location = 'openshopupdate.php';</script>";           
        }
?>

    <!-- Start openshop -->

    <div class="container-fluid">
      <div class="row">
        <div class="shopopen">
          <div class="col-md-9">
            <div class="col-md-6">
              <div class="shopbanner">
                <div class="jumbotron">
  
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
                
            if($name == "" || $user_name == "" || $user_contact == "" || $file_name == ""){
                echo "<span style='color:red'>Field must not be empty !!</span>";
            }elseif ($file_size >1048567) {
                echo "<span style='color:red'>Image Size should be less then 1MB!</span>";
            }elseif (in_array($file_ext, $permited) === false) {
                echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO shop(name, user_name, user_contact, image, user_reg_id) VALUES('$name', '$user_name', '$user_contact', '$unique_image', '$user_reg_id')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                    echo "<script>alert('Data Inserted Successfully!');</script>";
                    echo "<script>window.location = 'openshopupdate.php';</script>";
                }else {
                    echo "<script>alert('Data Not Inserted !');</script>";
                    echo "<script>window.location = 'openshop.php';</script>";
                }
            }      
        }

?>
                  <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name" >Shop Name:</label>
                      <input type="text" class="form-control" name="name" id="shopname">
                      <input type="hidden" name="user_name" value="<?php echo Session::get('user_name');?>" class="medium" />
                      <input type="hidden" name="user_contact" value="<?php echo Session::get('contact_num');?>" class="medium" />
                      <input type="hidden" name="user_reg_id" value="<?php echo Session::get('id_reg');?>" class="medium" />
                    </div>
                      <label  for="exampleInputFile">Banner :</label>
                      <div class="form-group">
                        <input type="file" name="image"  id="exampleInputFile">
                      </div>

                      <input type="submit" class="btn btn-success" value="Submit">
                  </form>


    
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
              
          </div>
          <div class="col-md-3">
            
            <div class="addproduct">
              <div class="shopmore">
              <h2><a href="#">Edit your products</a></h2>
            </div>
              <div class="shopmore">
                <h2>Add new products</h2>
              </div>
              <div>
                <label for="name" >Product Name:</label>
                    <input type="text" class="form-control" id="shopname">
              </div>

                   <label for="name" >Product Price:</label>
                    <input type="text" class="form-control" id="shopname">
                  </div>

              <div class="addpro">
                <div class="imageload">
                  <form>
                    <label for="exampleInputFile">Image input</label>
                    <div class="form-group">
                      <input type="file" id="exampleInputFile">
                    </div>
                  </form>
                </div>

                <div class="procatagory">
                   <form>
                    <label>Product catagory</label><br>
                    <input type="radio" name="cagagory" value="" checked>Gift Card<br>
                    <input type="radio" name="cagagory" value="">Painting<br>
                    <input type="radio" name="cagagory" value="">Ornaments<br>
                    <input type="radio" name="cagagory" value="">Home Decorate<br>
                    <input type="radio" name="cagagory" value="">Offer Zone<br>
                  </form>
                </div>
                <div class="prodetails">
                  <label>Product details</label></br>
                  <textarea rows="4" cols="35" name="comment" form="usrform">Prodect deteles here...</textarea>
                </div>

                <button type="button" class="btn btn-success">Add Product</button>
                
                <button type="button" class="btn btn-success">Order List</button>
                
                 
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    




     <!-- Start footer -->
<?php include("inc/footer.php"); ?>