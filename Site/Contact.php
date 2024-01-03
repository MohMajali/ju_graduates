<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

if ($S_ID) {
    $sql1 = mysqli_query($con, "select * from users where id='$S_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
    $userType = $row1['user_type_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Contact Us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="assets/img/image00001_png.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/animate/animate.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Spinner Start -->
    <div
      id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div class="spinner"></div>
    </div>
    <!-- Spinner End -->



    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <img src="assets/img/image00001_png.png" width="100px" height="100px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>

                    <?php if ($userType == 3) {?>
                        <a href="./Students.php" class="nav-item nav-link">Students</a>
                        <?php }?>

                    <a href="contact.php" class="nav-item nav-link active">Contact</a>

                    <?php if ($S_ID) {?>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $name ?></a>
                        <div class="dropdown-menu m-0">

                        <?php if ($userType != 3) {?>
                        <a href="./Profile.php" class="dropdown-item">Profile</a>
                        <?php }?>
                            <a href="./Setting.php" class="dropdown-item">Settings</a>
                            <a href="./MyPosts.php" class="dropdown-item">My Posts</a>
                            <a href="./Logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                    <?php } else {?>

                        <a href="../Login.php" class="nav-item nav-link">Login</a>

                    <?php }?>

                </div>
            </div>
        </nav>


    </div>
    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(9, 30, 62, 0.7)">
          <div class="modal-header border-0">
            <button
              type="button"
              class="btn bg-white btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div
            class="modal-body d-flex align-items-center justify-content-center"
          >
            <div class="input-group" style="max-width: 600px">
              <input
                type="text"
                class="form-control bg-transparent border-primary p-3"
                placeholder="Type search keyword"
              />
              <button class="btn btn-primary px-4">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container py-5">
        <div
          class="section-title text-center position-relative pb-3 mb-5 mx-auto"
          style="max-width: 600px"
        >
          <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
          <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
        </div>
        <div class="row g-5 mb-5">
          <div class="col-lg-4">
            <div
              class="d-flex align-items-center wow fadeIn"
              data-wow-delay="0.1s"
            >
              <div
                class="bg-primary d-flex align-items-center justify-content-center rounded"
                style="width: 60px; height: 60px"
              >
                <i class="fa fa-phone-alt text-white"></i>
              </div>
              <div class="ps-4">
                <h5 class="mb-2">Call to ask any question</h5>
                <h4 class="text-primary mb-0">+012 345 6789</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div
              class="d-flex align-items-center wow fadeIn"
              data-wow-delay="0.4s"
            >
              <div
                class="bg-primary d-flex align-items-center justify-content-center rounded"
                style="width: 60px; height: 60px"
              >
                <i class="fa fa-envelope-open text-white"></i>
              </div>
              <div class="ps-4">
                <h5 class="mb-2">Email to get free quote</h5>
                <h4 class="text-primary mb-0">info@example.com</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div
              class="d-flex align-items-center wow fadeIn"
              data-wow-delay="0.8s"
            >
              <div
                class="bg-primary d-flex align-items-center justify-content-center rounded"
                style="width: 60px; height: 60px"
              >
                <i class="fa fa-map-marker-alt text-white"></i>
              </div>
              <div class="ps-4">
                <h5 class="mb-2">Visit our office</h5>
                <h4 class="text-primary mb-0">123 Street, NY, USA</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-5">
          <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control border-0 bg-light px-4"
                    placeholder="Your Name"
                    style="height: 55px"
                  />
                </div>
                <div class="col-md-6">
                  <input
                    type="email"
                    class="form-control border-0 bg-light px-4"
                    placeholder="Your Email"
                    style="height: 55px"
                  />
                </div>
                <div class="col-12">
                  <input
                    type="text"
                    class="form-control border-0 bg-light px-4"
                    placeholder="Subject"
                    style="height: 55px"
                  />
                </div>
                <div class="col-12">
                  <textarea
                    class="form-control border-0 bg-light px-4 py-3"
                    rows="4"
                    placeholder="Message"
                  ></textarea>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100 py-3" type="submit">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
            <iframe
              class="position-relative rounded w-100 h-100"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13531.853643515153!2d35.85924591738281!3d32.016104799999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c9f765ba05b27%3A0x5a5ba049c504b635!2sUniversity%20of%20Jordan!5e0!3m2!1sen!2sjo!4v1700053550823!5m2!1sen!2sjo"
              frameborder="0"
              style="min-height: 350px; border: 0"
              allowfullscreen=""
              aria-hidden="false"
              tabindex="0"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <?php require './Footer.php'?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
