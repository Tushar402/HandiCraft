<?php include("inc/header.php"); ?>

   <!-- Start Shop one-->

    <section class="container-fluid" id="men">
      <div class="col-md-12">

        <h2>All collection</h2>
        <hr>
          <?php
    $query = "select * from product ORDER BY RAND()";
    $pages = $db->select($query);
    if($pages){
        while($presult = $pages->fetch_assoc()){
?>
        <div class="col-md-3">
          <div class="img-thumbnail">
            <a href="viewproduct.php?viewprotid=<?php echo $presult['id_product']; ?>"><img src="upload/product/<?php echo $presult['image']?>" alt="men one" class="img-responsive" style="height: 150px; width:250px;"></a>
          </div>
            
          <div class="price">
            <h4 style="padding-top: 20px;"><?php echo $presult['pro_name'];?></h4>
            <span class="new_price">BDT <?php echo $presult['pro_price'];?></span>
          </div>
        </div>
<?php
        }
    }
?>
      </div>
    </section>

    <!-- Start footer -->

<?php include("inc/footer.php"); ?>