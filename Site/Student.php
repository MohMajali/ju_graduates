<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

$student_id = $_GET['student_id'];

if ($student_id) {
    $sql1 = mysqli_query($con, "select * from users where id='$S_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
    $userType = $row1['user_type_id'];



    $sql2 = mysqli_query($con, "select * from users where id='$student_id'");
    $row2 = mysqli_fetch_array($sql2);
  
    $student_name = $row2['name'];
    $student_email = $row2['email'];
    $phone = $row2['phone'];
    $password = $row2['password'];
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

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
      <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
          <img src="assets/img/image00001_png.png" alt="" width="150px" height="150px">
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
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>

                    <?php if ($userType == 3) {?>
                        <a href="./Students.php" class="nav-item nav-link">Students</a>
                        <?php }?>

                    <a href="contact.php" class="nav-item nav-link">Contact</a>

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
                    <h5 class="card-title w-25">Majors</h5>
                    
                  </div>














                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_majors WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $student_major_id = $row1['id'];
    $major_id = $row1['major_id'];
    $gpa = $row1['gpa'];
    $major_start_date = $row1['start_date'];
    $major_end_date = $row1['end_date'];

    $sql2 = mysqli_query($con, "SELECT * from majors WHERE id = '$major_id'");
    $row2 = mysqli_fetch_array($sql2);

    $major_name = $row2['name'];

    ?>
                  <div
                    class="card-body profile-card pt-4 d-flex flex-row align-items-center gap-2"
                  >
                    <div>
                      <div class="exper-data">
                      <h2 class=""><?php echo $major_name ?></h2>
                      </div>
                      <h3><?php echo $gpa ?></h3>
                      <h5><?php echo date("Y-m-d", strtotime($major_start_date)); ?> - <?php echo date("Y-m-d", strtotime($major_end_date)); ?></h5>
                    </div>
                  </div>
                  <hr />
<?php }?>
                </div>
              </div>

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
