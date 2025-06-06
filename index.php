<?php
session_start();
include '../project/admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style.css">
  <?php include 'links.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>
  <style>
    .nav-link:hover i {
      color: #0d6efd;
      transform: scale(1.1);
      transition: all 0.3s ease;
    }

    .map-card iframe {
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
    }

    .team-card {
      transition: transform 0.3s ease;
    }

    .team-card:hover {
      transform: scale(1.05);
    }

    .about-img {
      transition: transform 0.3s ease;
    }

    .about-img:hover {
      transform: scale(1.03);
    }
  </style>

  <?php include 'header.php'; ?>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/img-3.jpg" class="d-block w-100" height="500px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Drive Your Dream Car Today</h5>
          <p>Explore a wide range of luxury and budget-friendly cars – all in one place.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./images/big-car.jpg" class="d-block w-100" height="500px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Performance Meets Style</h5>
          <p>Find cars that match your lifestyle – from SUVs to sports models with cutting-edge technology.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./images/img-2.jpg" class="d-block w-100" height="500px" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Unbeatable Deals & Offers</h5>
          <p>Grab the best deals, EMI options, and free test drives. Start your journey with us!</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- About Section -->
  <section class="py-5 bg-light" id="about">
    <div class="container">
      <div class="row align-items-center">

        <!-- About Image -->
        <div class="col-md-6 mb-4 mb-md-0 about-img" data-aos="fade-right" data-aos-duration="1500">
          <img src="./images/car-1.webp" alt="About Us - Car" class="img-fluid rounded shadow">
        </div>

        <!-- About Content -->
        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1500">
          <h2 class="mb-4">About Us</h2>
          <p class="lead">At Wheel & Deal, we’re passionate about delivering premium vehicles that combine performance, comfort, and style. With years of experience in the automobile industry, we bring you the latest models from top brands.</p>
          <p>Whether you're looking for a sleek sedan, a powerful SUV, or a luxury sports car, we’ve got you covered. Our team is committed to helping you find the perfect ride with easy financing and exceptional customer service.</p>
          <a href="#contact" class="btn btn-primary animate__animated animate__pulse mt-3">Contact Us</a>
        </div>

      </div>
    </div>
  </section>


  <div class="container mt-5 mb-3">
    <div class="row">
      <?php
      $sql = "select * from products";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {

          $productId = $data['id'];
      ?>
          <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up" data-aos-duration="800">
            <div class="card">
              <img src="admin/uploads/<?php echo $data['image']; ?>" class="card-img-top" alt="car" height="250px">
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['name']; ?></h5>
                <p><strong>Model : </strong><?php echo $data['model']; ?></p>
                <p><strong>Color : </strong><?php echo $data['color']; ?></p>
                <p><strong>Price : </strong>₹<?php echo $data['price']; ?></p>
                <button type="button"
                  class="btn btn-primary"
                  onclick="addToCart('<?php echo $productId; ?>', '<?php echo $data['name']; ?>', '<?php echo $data['model']; ?>', '<?php echo $data['color']; ?>', '<?php echo $data['image']; ?>', '<?php echo $data['price']; ?>', '1')">
                  Add to Cart <i class="fa-solid fa-cart-shopping"></i>
                </button>
              </div>
            </div>
          </div>
      <?php }
      }
      ?>
    </div>
  </div>

  <!-- Why Choose Us Section -->
  <section class="bg-light py-5" id="choose-us">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="zoom-in-up" data-aos-duration="1200">Why Choose Us</h2>
      <div class="row text-center">
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="0">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/quality.png" class="rounded-circle border border-primary p-1" width="75" height="75">
            <h5 class="pt-2">Top Quality Cars</h5>
            <p>All our cars are inspected and certified for performance and quality.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/affordable-price.webp" class="rounded-circle border border-primary p-1" width="75" height="75">
            <h5 class="pt-2">Affordable Pricing</h5>
            <p>We offer competitive prices to suit every budget and lifestyle.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/24hrs.avif" class="rounded-circle border border-primary p-1" width="75" height="75">
            <h5 class="pt-2">24/7 Support</h5>
            <p>Our expert support team is here to help you anytime, anywhere.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Services Section -->
  <section id="services" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="zoom-in-up" data-aos-duration="1200">Our Services</h2>
      <p class="text-center mb-5" data-aos="zoom-in-up" data-aos-duration="1200">We offer a wide range of car-related services to make your journey smooth and convenient.</p>
      <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
          <div class="p-4 shadow rounded h-100 bg-white">
            <img src="./images/loan.jpg" alt="Finance" class="rounded-circle border border-primary p-1" width="60" height="60">
            <h5 class="pt-2">Easy Financing</h5>
            <p>Flexible car loan options to help you get your dream car without stress.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
          <div class="p-4 shadow rounded h-100 bg-white">
            <img src="./images/wheel.jpg" alt="Test Drive" class="rounded-circle border border-primary p-1" width="60" height="60">
            <h5 class="pt-2">Test Drive</h5>
            <p>Book a test drive at your convenience to experience your car before buying.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
          <div class="p-4 shadow rounded h-100 bg-white">
            <img src="./images/wrenches.jpg" alt="Car Servicing" class="rounded-circle border border-primary p-1" width="60" height="60">
            <h5 class="pt-2">Car Servicing</h5>
            <p>Get quality maintenance and servicing from our certified mechanics.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
          <div class="p-4 shadow rounded h-100 bg-white">
            <img src="./images/car-exchange.png" alt="Car Exchange" class="rounded-circle border border-primary p-1" width="60" height="60">
            <h5 class="pt-2">Car Trade-In</h5>
            <p>Exchange your old car and upgrade to a new model with the best value.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Testimonials Section -->
  <section id="testimonials" class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="zoom-in-up" data-aos-duration="1200">What Our Customers Say</h2>
      <div class="row text-center">

        <!-- Testimonial 1 -->
        <div class="col-md-4 mb-4" data-aos="fade-up-right" data-aos-duration="1000">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/s4.jpg" class="rounded-circle border border-primary p-1" width="80" height="80" alt="Customer 1">
            <p class="mb-2 mt-1">"Amazing experience! Got my dream car at a great price. Highly recommend Wheel & Deal."</p>
            <h6 class="mb-0">Amit Sharma</h6>
            <small class="text-muted">Kolkata</small>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="col-md-4 mb-4" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/s3.jpg" class="rounded-circle border border-primary p-1" width="80" height="80" alt="Customer 2">
            <p class="mb-2 mt-1">"Excellent customer service. They guided me throughout the whole process smoothly."</p>
            <h6 class="mb-0">Priya Das</h6>
            <small class="text-muted">Delhi</small>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="col-md-4 mb-4" data-aos="fade-up-left" data-aos-duration="1000">
          <div class="p-4 shadow rounded h-100">
            <img src="./images/s2.jpg" class="rounded-circle border border-primary p-1" width="80" height="80" alt="Customer 3">
            <p class="mb-2 mt-1">"Very professional team and top-quality cars. I'm extremely happy with my purchase."</p>
            <h6 class="mb-0">Rahul Verma</h6>
            <small class="text-muted">Mumbai</small>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Meet Our Team Section -->
  <section id="team" class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="zoom-in-up" data-aos-duration="1200">Meet Our Team</h2>
      <p class="text-center mb-5" data-aos="zoom-in-up" data-aos-duration="1200">Our experienced and friendly team is here to assist you every step of the way.</p>
      <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="0">
          <div class="card shadow border-0 h-100 team-card">
            <img src="./images/manager.avif" class="card-img-top" alt="Team Member 1">
            <div class="card-body">
              <h5 class="card-title">Rohit Sharma</h5>
              <p class="card-text">Sales Manager</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
          <div class="card shadow border-0 h-100 team-card">
            <img src="./images/women.avif" class="card-img-top" alt="Team Member 2">
            <div class="card-body">
              <h5 class="card-title">Priya Mehta</h5>
              <p class="card-text">Customer Support</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
          <div class="card shadow border-0 h-100 team-card">
            <img src="./images/man.avif" class="card-img-top" alt="Team Member 3">
            <div class="card-body">
              <h5 class="card-title">Arjun Verma</h5>
              <p class="card-text">Finance Advisor</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
          <div class="card shadow border-0 h-100 team-card">
            <img src="./images/women-2.avif" class="card-img-top" alt="Team Member 4">
            <div class="card-body">
              <h5 class="card-title">Sneha Roy</h5>
              <p class="card-text">Marketing Head</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Contact Section -->
  <section id="contact" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="0">Get In Touch</h2>
      <p class="text-center mb-5" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">Have questions? Our team is here to help you 24/7. Fill out the form and we’ll get back to you soon!</p>

      <div class="row justify-content-center">
        <div class="col-md-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
          <form action="contact.php" method="POST" autocomplete="off" class="p-4 shadow rounded bg-white">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="name" required placeholder="Enter your name">
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" required placeholder="example@gmail.com">
              </div>
            </div>

            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" name="subject" class="form-control" id="subject" required placeholder="Message subject">
            </div>

            <div class="mb-3">
              <label for="message" class="form-label">Your Message</label>
              <textarea name="message" class="form-control" id="message" rows="5" required placeholder="Write your message here..."></textarea>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Send Message <i class="fas fa-paper-plane ms-1"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Location Map Section -->
  <section class="py-5 bg-white" id="location">
    <div class="container">
      <h2 class="text-center mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="0">Visit Our Showroom</h2>
      <p class="text-center mb-5" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">Come see our cars in person at our main showroom. We'd love to meet you!</p>

      <div class="row justify-content-center align-items-center">
        <!-- Contact Info Box -->
        <div class="col-md-5 mb-4" data-aos="fade-right" data-aos-duration="1500">
          <div class="bg-light p-4 shadow rounded h-100">
            <h5 class="mb-3"><i class="fa-solid fa-location-dot text-primary me-2"></i>Our Address</h5>
            <p>123 Wheel & Deal Avenue, Kolkata, West Bengal 700001</p>

            <h5 class="mt-4 mb-3"><i class="fa-solid fa-phone text-primary me-2"></i>Phone</h5>
            <p>+91 98765 43210</p>

            <h5 class="mt-4 mb-3"><i class="fa-solid fa-envelope text-primary me-2"></i>Email</h5>
            <p>support@wheelanddeal.com</p>
          </div>
        </div>

        <!-- Map Embed -->
        <div class="col-md-7" data-aos="fade-left" data-aos-duration="1500">
          <div class="map-card shadow rounded overflow-hidden" style="height: 350px;">
            <iframe class="w-100 h-100 border-0"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.6604528884983!2d88.36389541541728!3d22.57264698517798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277b81611d17f%3A0x1f9bd0f0113d7e79!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1616148806101!5m2!1sen!2sin"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include './footer.php' ?>

  <script>
    AOS.init({
      duration: 1000, // Animation duration
      disable: function() {
        // Disable AOS on small screens
        return window.innerWidth < 1024;
      }
    });

    function addToCart(productId, name, model, color, image, price, qty) {
      $.ajax({
        type: "post",
        url: "ajax.php",
        dataType: "json",
        data: {
          action: "addtocart",
          product_id: productId,
          name: name,
          model: model,
          color: color,
          image: image,
          price: price,
          qty: qty
        },
        success: function(response) {
          if (response.code === 200) {
            $("#cart-count").text(response.count);
            alert(response.message);
          } else if (response.code === 409) {
            alert(response.message);
          }
        }
      });
    };
  </script>
</body>

</html>