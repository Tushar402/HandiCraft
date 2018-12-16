<?php include("inc/header.php"); ?>


    <!-- Start proveiw -->



<?php
if(!isset($_GET['viewprotid']) || $_GET['viewprotid'] == NULL){
    echo "<script>window.location = 'index.php';</script>";
    //header("Location:catlist.php");
}else{
    $proid = $_GET['viewprotid'];
}
?>

    <div class="container">
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
            
<?php
    $query = "select * from product where id_product='$proid'";
    $getpro = $db->select($query);
    while($proresult = $getpro->fetch_assoc()){
?>
          <div class="preview col-md-6">
            
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img src="upload/product/<?php echo $proresult['image'];?>" class="img-responsive" /></div>
            </div>
          </div>
          <div class="details col-md-6">
            <h3 class="product-title"><?php
                            $cat = $proresult['catagory'];
                            if($cat == 1){
                                echo "Gift Card";
                            }elseif($cat == 2){
                                echo "Painting";
                            }elseif($cat == 3){
                                echo "Ornaments";
                            }elseif($cat == 4){
                                echo "Home Decorate";
                            }else{
                                echo "Nothing";
                            }?></h3>
            <h4 class="product-title">Shop Name:<?php echo $proresult['shop_name'];?></h4>
            <h5 class="product-title">Product Name:<?php echo $proresult['pro_name'];?></h5>
            <h6 class="product-title">Contact Number:<?php echo $proresult['pro_user_contact'];?></h6>
            <div class="rating">
              <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
              <span class="review-no">21 reviews</span>
            </div>
            <div>
          
            <h4 class="price">current price: <span><?php echo $proresult['pro_price'];?> BDT</span></h4>
            <form action="" method="post">
            <h5 class="colors">quantity:
              <span>
                <select name="quantity">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    
                </select>
              </span>
                <input type="hidden" class="form-control" name="toorder_id" value="<?php echo $proresult['user_reg_id'];?>" id="shopname">
                <input type="hidden" class="form-control" name="product_it" value="<?php echo $proresult['id_product'];?>" id="shopname">
                <input type="hidden" name="user_reg_id" value="<?php echo Session::get('id_reg');?>" class="medium" />
                <input type="hidden" name="status" value="0" class="medium" />
            </h5>
            <div class="action">
              <input type="submit" class="add-to-cart btn btn-default" name="order" value="Order Product">
            </div>
            </form>

          </div>
        </div>
<?php } ?>
            
      </div>
      </div>
    </div>
  </div>






    <!-- Start footer -->
<?php include("inc/footer.php"); ?>