<?php include("inc/header.php"); ?>

<!-- Start  Shop one -->

    <section class="container-fluid">
      <div class="col-md-12">        
       <div class="col-md-4">
          <div class="product-holder">
            <div class="product-item-2">
              <div class="product-thumb">
                <a href="painting.php">
                  <img src="images/painting.jpg" alt="Product Title">
                </a>
              </div> 
            </div> 
            <div class="product-item-2">
              <div class="product-thumb">
              <a href="giftcard.php">
                <img src="images/gift.jpg" alt="Product Title">
              </a>
              </div>                 
            </div>
          </div>
        </div>



         <div class="col-md-4">
            <div class="product-holder">
              <div class="product-item-1">
                <div class="product-thumb">
                <a href="openshop.php">
                  <img src="images/openshop.jpg" alt="Product Title">
                </a>
                </div>
              </div>
              <div class="product-item-2">
                <div class="product-thumb">
                <a href="offerzone.php">
                  <img src="images/offer.jpg" alt="Product Title">
                </a>
                </div>            
              </div>
            </div>
          </div>



          <div class="col-md-4">
            <div class="product-holder">
              <div class="product-item-2">
                <div class="product-thumb">
                <a href="ornaments.php">
                  <img src="images/ornaments.jpg" alt="Product Title">
                </a>
                </div>
              </div> 
              <div class="product-item-2">
                <div class="product-thumb">
                <a href="homemade.php">
                  <img src="images/homemade.jpg" alt="Product Title">
                </a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>




    <!-- Start Shop Three-->



<div class="container">
      <div class="row" id="slider-text">
        <div class="col-md-6" >
          <h2>Popular Shop</h2>
        </div>
      </div>
    </div>
    <!-- Item slider-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="carousel carousel-showmanymoveone slide" id="itemslider">
            <div class="carousel-inner">
<?php
    $query = "select * from shop limit 6";
    $post = $db->select($query);
    if($post){
        $counter = 1;
        while($result = $post->fetch_assoc()){  
?>
              <div class="item<?php if($counter <= 1){echo " active"; } ?>">
                  
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <h2 style="padding-left:50px"><?php echo $result['name'];?></h2>
                  <a href="shopproduct.php?viewshopid=<?php echo $result['name']; ?>"><img src="upload/<?php echo $result['image'];?>" class="img-responsive center-block" style="height: 200px; width:250px;"></a>
                </div>
              </div>
<?php
    $counter++;
        }
    }
?>
            </div>
            
          </div>
        </div>
      </div>
    </div>




   <!-- Start Shop more-->



    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5"></div>
          <div class="col-md-3">
            <div class="shopmore">
              <h2><a href="view_shop.php">View More Shop</a></h2>
            </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </div>

 <!--Start footer-->           

<?php include("inc/footer.php"); ?>