<?php
include('inc/header.php');
include('inc/navbar.php');
?>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Contact</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Contact</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Contact Section ======= -->
  <div class="map-section">
    <iframe style="border:0; width:100%; height:350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4462442036456!2d30.042181414758186!3d-1.975817837324266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca5c01092cb1d%3A0x8cf8d2b604ce329e!2sKN%20235%20St%2C%20Kigali!5e0!3m2!1sen!2srw!4v1613554801177!5m2!1sen!2srw" frameborder="0" allowfullscreen></iframe>

  </div>

  <section id="contact" class="contact">
    <div class="container">

      <div class="row justify-content-center" data-aos="fade-up">

        <div class="col-lg-10">

          <div class="info-wrap">
            <div class="row">
              <div class="col-lg-4 info">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>KN 235 Street<br>Kigali, Rwanda</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>info@irakoze.com<br>contact@irakoze.com</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+250788622754</p>
              </div>
            </div>
          </div>

        </div>

      </div>

      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">
          <form action="contact_code.php" method="POST" class="user">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" id="contact-name" class="form-control form-control-user" name="name" placeholder="Your Name">
              </div>
              <div class="form-group col-md-6">
                <input type="email" id="contact-email" class="form-control form-control-user" name="email" placeholder="Your Email">
              </div>
            </div>
            <div class="form-group">
              <input type="text" id="contact-subject" class="form-control form-control-user" name="subject" placeholder="Subject">
            </div>
            <div class="form-group">
              <textarea name="message" id="contact-message" class="form-control form-control-user" placeholder="Message"></textarea>
            </div>
            <div class="text-center">
              <button type="submit" id="contact-submit" name="send" class="btn" style="background-color: #f03c02; color:white;">Send Message</button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php

include('inc/scripts.php');
include('inc/footer.php');

?>