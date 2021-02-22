<?php

include('inc/header.php');
include('inc/navbar.php');

?>
<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Portolio</h2>
      <ol>
        <li><a href="index.php">Home</a></li>
        <li>Offices</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
  <div class="container">

  <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-rent">Rent</li>
              <li data-filter=".filter-sale">Buy</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
          <?php
      include('database/dbconnection.php');
      $query = "SELECT * FROM offices WHERE status='available'";
      $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
      if(mysqli_num_rows($query_run)>0){
        while($row=mysqli_fetch_assoc($query_run)){

        ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $row['category']; ?>">
              <img src="company/officeimages/<?php echo $row['image']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo $row['name']; ?></h4>
                <p><?php echo $row['location']; ?></p>
                <a href="company/officeimages/<?php echo $row['image']; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="Zoom in"><i class="bx bx-plus"></i></a>
                <a href="office-details.php?id=<?php echo $row['id']; ?>" name="details_button" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
            <?php
}
}
else{
  
}
?>
          </div>

    

  </div>
</section><!-- End Portfolio Section -->

</main><!-- End #main -->

<?php

include('inc/scripts.php');
include('inc/footer.php');

?>