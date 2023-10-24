<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$search = $_POST['search'];
$majorId = $_GET['major_id'];
$department_id = $_GET['department_id'];

if ($S_ID) {
    $sql1 = mysqli_query($con, "select * from users where id='$S_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
}

$response = array();

if ($search) {

    $sqlSearch = mysqli_query($con, "SELECT id from courses WHERE name LIKE '%$search%' AND active = 1");
    $searchRow = mysqli_fetch_array($sqlSearch);
    $course_id = $searchRow['id'];

    $sql2 = mysqli_query($con, "SELECT DISTINCT student_id from student_courses WHERE course_id = '$course_id' ORDER BY id DESC");

    while ($searchRow2 = mysqli_fetch_array($sql2)) {

        $student_id_search = $searchRow2['student_id'];

        $students_search = mysqli_query($con, "SELECT * from users WHERE id = '$student_id_search' AND active = 1 ORDER BY id DESC");
        $students_search_array = mysqli_fetch_array($students_search);

        $rows = array(
            'student_id' => $students_search_array['id'],
            'student_image' => $students_search_array['image'],
            'student_name' => $students_search_array['name'],
        );

        $response[] = $rows;

    }

} else if ($majorId) {

    $sql2 = mysqli_query($con, "SELECT DISTINCT student_id from student_majors WHERE major_id = '$majorId' ORDER BY id DESC");

    while ($filterhRow2 = mysqli_fetch_array($sql2)) {

        $student_id_filter = $filterhRow2['student_id'];

        $students_filter = mysqli_query($con, "SELECT * from users WHERE id = '$student_id_filter' AND active = 1 ORDER BY id DESC");
        $students_filter_array = mysqli_fetch_array($students_filter);

        $rows = array(
            'student_id' => $students_filter_array['id'],
            'student_image' => $students_filter_array['image'],
            'student_name' => $students_filter_array['name'],
        );

        $response[] = $rows;

    }

} else if ($department_id) {

    $sqldep = mysqli_query($con, "SELECT id from majors WHERE department_id = '$department_id'");

    while ($depsRow = mysqli_fetch_array($sqldep)) {

        $major_id = $depsRow['id'];

        $sql2 = mysqli_query($con, "SELECT DISTINCT student_id from student_majors WHERE major_id = '$major_id' ORDER BY id DESC");
        $depRow2 = mysqli_fetch_array($sql2);

        $student_id_dep = $depRow2['student_id'];

        $students_dep = mysqli_query($con, "SELECT * from users WHERE id = '$student_id_dep' AND active = 1 ORDER BY id DESC");
        $students_dep_array = mysqli_fetch_array($students_dep);

        $rows = array(
            'student_id' => $students_dep_array['id'],
            'student_image' => $students_dep_array['image'],
            'student_name' => $students_dep_array['name'],
        );

        $response[] = $rows;

    }

} else {
    $sqlNormal = mysqli_query($con, "SELECT * from users WHERE user_type_id = 2 AND active = 1 ORDER BY id DESC");

    while ($rowNormal = mysqli_fetch_array($sqlNormal)) {

        $rows = array(
            'student_id' => $rowNormal['id'],
            'student_image' => $rowNormal['image'],
            'student_name' => $rowNormal['name'],
        );

        $response[] = $rows;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Students</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>

                    <?php if ($S_ID) {?>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $name ?></a>
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
        class="container-fluid bg-primary py-5 bg-header"
        style="margin-bottom: 90px"
      >
        <div class="row py-5">
          <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">Students</h1>
            <a href="" class="h5 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h5 text-white">Students</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Navbar End -->


    <!-- Students Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">

      <div class="container py-5">
        <div
          class="section-title text-center position-relative pb-3 mb-5 mx-auto"
          style="max-width: 600px"
        >
          <h5 class="fw-bold text-primary text-uppercase">Students</h5>


<form action="./Students.php">

<div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Filter by Majors</label
                    >
                    <div class="col-sm-4">
                      <!-- <input type="text" class="form-control" name="name" required/> -->
                      <select class="form-select" aria-label="Default select example" name="major_id">
                        <option selected>Select Major</option>
                        <?php
$sql1 = mysqli_query($con, "SELECT * from majors ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $major_id_select = $row1['id'];
    $major_name_select = $row1['name'];
    ?>
                          <option value="<?php echo $major_id_select ?>"><?php echo $major_name_select ?></option>
                        <?php }?>



                    </select>
                    </div>
          </div>
          <div class="row mb-3">
                    <div class="text-center">
                      <button type="submit" name="filter" class="btn btn-primary">
                        Filter
                      </button>
                    </div>
                  </div>
</form>



<form action="./Students.php">

<div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Filter by Departments</label
                    >
                    <div class="col-sm-4">
                      <!-- <input type="text" class="form-control" name="name" required/> -->
                      <select class="form-select" aria-label="Default select example" name="department_id">
                        <option selected>Select Department</option>
                        <?php
$sql1 = mysqli_query($con, "SELECT * from departments ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $department_id_select = $row1['id'];
    $department_name_select = $row1['name'];
    ?>
                          <option value="<?php echo $department_id_select ?>"><?php echo $department_name_select ?></option>
                        <?php }?>



                    </select>
                    </div>
          </div>
          <div class="row mb-3">
                    <div class="text-center">
                      <button type="submit" name="filter" class="btn btn-primary">
                        Filter
                      </button>
                    </div>
                  </div>
</form>


        </div>
        <div class="row g-5">


          <?php

foreach ($response as &$row) {?>

<a class="col-lg-4 wow slideInUp" data-wow-delay="0.3s" href="./Student.php?student_id=<?php echo $row['student_id'] ?>">

              <!-- <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s"> -->
                <div class="team-item bg-light rounded overflow-hidden">
                <div class="team-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="<?php echo $row['student_image'] ?>" alt="" />
                </div>
                  <div class="text-center py-4">
                    <h4 class="text-primary"><?php echo $row['student_name'] ?></h4>
                  </div>
                </div>
              <!-- </div> -->

            </a>
       <?php }?>



        </div>
      </div>
    </div>
    <!-- Students End -->

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
