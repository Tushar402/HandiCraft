<?php include("inc/header.php"); ?>

   <!-- Start Shop one-->

    <section class="container-fluid" id="men">
      <div class="col-md-12">

        <h2>All Shop</h2>
        <hr>
          <?php
    $query = "select * from shop";
    $pages = $db->select($query);
    if($pages){
        while($presult = $pages->fetch_assoc()){
?>
        <div class="col-md-3">
            <h2><?php echo $presult['name'];?></h2>
          <div class="img-thumbnail">
            <a href="#"><img src="upload/<?php echo $presult['image']?>" alt="men one" class="img-responsive" style="height: 200px; width:200px;padding-bottom:60px"></a>
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