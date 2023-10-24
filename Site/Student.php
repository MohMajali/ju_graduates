<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$student_id = $_GET['student_id'];

if ($student_id) {
    $sql1 = mysqli_query($con, "select * from users where id='$student_id'");
    $row1 = mysqli_fetch_array($sql1);

    $student_name = $row1['name'];
    $student_email = $row1['email'];
    $phone = $row1['phone'];
    $password = $row1['password'];
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
    <link href="assets/img/favicon.png" rel="icon">

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
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./assets/css/site.css" rel="stylesheet" />
  </head>

  <body class="bg-light bg-gradient">
    <!-- Spinner Start -->
    <div
      id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
      <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            <small class="me-3 text-light"
              ><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York,
              USA</small
            >
            <small class="me-3 text-light"
              ><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small
            >
            <small class="text-light"
              ><i class="fa fa-envelope-open me-2"></i>info@example.com</small
            >
          </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href=""
              ><i class="fab fa-twitter fw-normal"></i
            ></a>
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href=""
              ><i class="fab fa-facebook-f fw-normal"></i
            ></a>
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href=""
              ><i class="fab fa-linkedin-in fw-normal"></i
            ></a>
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href=""
              ><i class="fab fa-instagram fw-normal"></i
            ></a>
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle"
              href=""
              ><i class="fab fa-youtube fw-normal"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
      <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
          <img src="assets/img/favicon.png" alt="">
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <a href="contact.php" class="nav-item nav-link">Contact</a>

            <?php if ($S_ID) {?>

            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
                ><?php echo $student_name ?></a
              >
              <div class="dropdown-menu m-0">
                <a href="./Profile.php" class="dropdown-item">Profile</a>
                <a href="./Logout.php" class="dropdown-item">Logout</a>
              </div>
            </div>

            <?php } else {?>

            <a href="../Login.php" class="nav-item nav-link">Login</a>
            <a href="./Students.php" class="nav-item nav-link active">Students</a>

            <?php }?>
          </div>
        </div>
      </nav>

      <div
        id="header-carousel"
        class="carousel slide carousel-fade"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="w-100" src="img/carousel-1.jpg" alt="Image" />
            <div
              class="carousel-caption d-flex flex-column align-items-center justify-content-center"
            >
              <div class="p-3" style="max-width: 900px">
                <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                  Meet up with students
                </h5>
                <h1 class="display-1 text-white mb-md-4 animated zoomIn">
                  Creative & Innovative Digital Solution
                </h1>
                <a
                  href=""
                  class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight"
                  >Contact Us</a
                >
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="w-100" src="img/carousel-2.jpg" alt="Image" />
            <div
              class="carousel-caption d-flex flex-column align-items-center justify-content-center"
            >
              <div class="p-3" style="max-width: 900px">
                <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                  Meet up with students
                </h5>
                <h1 class="display-1 text-white mb-md-4 animated zoomIn">
                  Creative & Innovative Digital Solution
                </h1>
                <a
                  href=""
                  class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight"
                  >Contact Us</a
                >
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#header-carousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#header-carousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- Navbar End -->

    <main id="main" class="main">
      <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
          <div
            class="section-title text-center position-relative pb-3 mb-5 mx-auto"
            style="max-width: 600px"
          >
            <h5 class="fw-bold text-primary text-uppercase">Profile Account</h5>
          </div>

          <div class="row justify-content-center g-5">
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">


              <div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">Experience</h5>

                  </div>




                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_experinces WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $exper_id = $row1['id'];
    $company_id = $row1['company_id'];
    $job_id = $row1['job_id'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $description = $row1['description'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from companies WHERE id = '$company_id'");
    $row2 = mysqli_fetch_array($sql2);

    $company_name = $row2['name'];
    $comapny_image = $row2['image'];

    $sql3 = mysqli_query($con, "SELECT * from jobs WHERE id = '$job_id'");
    $row3 = mysqli_fetch_array($sql3);

    $job_name = $row3['name'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2"
                  >
                    <img
                      src="../Admin_Dashboard/<?php echo $comapny_image ?>"
                      alt="Profile"
                      height="100px"
                      width="100px"
                    />
                    <div>
                      <div class="exper-data">
                      <h2 class=""><?php echo $company_name ?></h2>
                      </div>
                      <h3><?php echo $job_name ?></h3>
                      <h5><?php echo $start_date ?> - <?php echo $end_date ?></h5>
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>


              <div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">Courses</h5>
                    <div class="icon">
                    </div>
                  </div>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_courses WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $course_student_id = $row1['id'];
    $course_id = $row1['course_id'];
    $course_start_date = $row1['start_date'];
    $course_end_date = $row1['end_date'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from courses WHERE id = '$course_id'");
    $row2 = mysqli_fetch_array($sql2);

    $course_name = $row2['name'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2 justify-content-center"
                  >
                    <!-- <img
                      src="../Admin_Dashboard/<?php echo $comapny_image ?>"
                      alt="Profile"
                      height="100px"
                      width="100px"
                    /> -->
                    <div>
                      <div class="exper-data">
                      <h2 class=""><?php echo $course_name ?></h2>
                      </div>
                      <h5><?php echo $course_start_date ?> - <?php echo $course_end_date ?></h5>
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>



<!-- Researches START -->

              <div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">Projects</h5>

                  </div>




                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_projects WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $project_id = $row1['id'];
    $title = $row1['title'];
    $project_description = $row1['description'];
    $main_image = $row1['main_image'];
    $project_file = $row1['project_file'];
    $created_at = $row1['created_at'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2 justify-content-center"
                  >
                    <img
                      src="./<?php echo $main_image ?>"
                      alt="Profile"
                      height="100px"
                      width="100px"
                    />
                    <div>
                      <div class="exper-data">
                        <a href="<?php echo $project_file ?>" target="_blank"><h2 class=""><?php echo $title ?></h2></a>
                      </div>
                      <p><?php echo $project_description ?></p>
                      <!-- <h5><?php echo $course_start_date ?> - <?php echo $course_end_date ?></h5> -->
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>

<!-- Projects END -->








<!-- Researches START -->

<div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">Researches</h5>
                  </div>



                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_researches WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $research_id = $row1['id'];
    $research_title = $row1['title'];
    $research_description = $row1['description'];
    $research_image = $row1['research_image'];
    $research_file = $row1['research_file'];
    $created_at = $row1['created_at'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2 justify-content-center"
                  >
                    <img
                      src="./<?php echo $research_image ?>"
                      alt="Profile"
                      height="100px"
                      width="100px"
                    />
                    <div>
                      <div class="exper-data">
                        <a href="<?php echo $research_file ?>" target="_blank"><h2 class=""><?php echo $research_title ?></h2></a>
                      </div>
                      <p><?php echo $research_description ?></p>
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>

<!-- Researches END -->




<!-- CV START -->

<div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">CV</h5>
                  </div>





                  <?php
$sql1 = mysqli_query($con, "SELECT * from students_cvs WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $cv_id = $row1['id'];
    $cv_file = $row1['cv_file'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2 justify-content-center"
                  >

                    <div>
                      <div class="exper-data-cv">
                        <a href="<?php echo $cv_file ?>" target="_blank"><h2 class="">Student CV</h2></a>
                      </div>
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>

<!-- CV END -->






            </div>
          </div>
        </div>
      </div>
    </main>

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
