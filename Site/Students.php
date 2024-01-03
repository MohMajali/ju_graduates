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

$response = array();

if (isset($_POST['filter']) || isset($_POST['filter_2'])) {

    $majorId = $_POST['major_id'];
    $department_id = $_POST['department_id'];
    $course_filter_id = $_POST['course_id'];
    $search = $_POST['search'];

    if ($department_id) {

        $sqldep = mysqli_query($con, "SELECT majors.id AS majorId, majors.name AS majorName, majors.department_id AS depId,
        student_majors.student_id AS studentId,
        users.id AS userId, users.name AS username, users.image AS userImage
        FROM majors
        JOIN student_majors ON student_majors.major_id = majors.id
        JOIN users ON users.id = student_majors.student_id
        WHERE majors.department_id = $department_id");

        while ($depsRow = mysqli_fetch_array($sqldep)) {
            $response[] = $depsRow;
        }

    } else if ($majorId) {

        $sql2 = mysqli_query($con, "SELECT student_majors.id AS studentMajorsId, student_majors.student_id AS studentId, student_majors.major_id AS studentMajorId,
        users.id AS userId, users.name AS username, users.image AS userImage,
        majors.name AS majorName
        from student_majors
        JOIN users ON users.id = student_majors.student_id
        JOIN majors ON majors.id = student_majors.major_id
        WHERE student_majors.major_id = $majorId 
        ORDER BY student_majors.id DESC");

        while ($filterhRow2 = mysqli_fetch_array($sql2)) {
            $response[] = $filterhRow2;
        }

    } else if ($search) {

        $sqlSearch = mysqli_query($con, "SELECT id from courses WHERE name LIKE '%$search%' AND active = 1");
        $searchRow = mysqli_fetch_array($sqlSearch);
        $course_id = $searchRow['id'];

        $sql2 = mysqli_query($con, "SELECT DISTINCT student_id from student_courses WHERE course_id = '$course_id' ORDER BY id DESC");

        while ($searchRow2 = mysqli_fetch_array($sql2)) {

            $student_id_search = $searchRow2['student_id'];

            $students_search = mysqli_query($con, "SELECT * from users WHERE id = '$student_id_search' AND active = 1 ORDER BY id DESC");
            $students_search_array = mysqli_fetch_array($students_search);

            $sqlNormalData = mysqli_query($con, "SELECT * from student_majors WHERE student_id = '$student_id_search'");
            $rowNormalData = mysqli_fetch_array($sqlNormalData);

            $maj_id = $rowNormalData['major_id'];

            $majorData = mysqli_query($con, "SELECT * from majors WHERE id = '$maj_id'");
            $rowNormalDataMajor = mysqli_fetch_array($majorData);

            $majName = $rowNormalDataMajor['name'];

            $rows = array(
                'studentId' => $students_search_array['id'],
                'userImage' => $students_search_array['image'],
                'username' => $students_search_array['name'],
                'majorName' => $majName,
            );

            $response[] = $rows;

        }

    } else if ($course_filter_id) {

        $sql2 = mysqli_query($con, "SELECT DISTINCT student_id from student_courses WHERE course_id = '$course_filter_id' ORDER BY id DESC");

        while ($courseRow2 = mysqli_fetch_array($sql2)) {

            $student_id_course = $courseRow2['student_id'];

            $students_courses = mysqli_query($con, "SELECT * from users WHERE id = '$student_id_course' AND active = 1 ORDER BY id DESC");
            $students_courses_array = mysqli_fetch_array($students_courses);

            $rows = array(
                'studentId' => $students_courses_array['id'],
                'userImage' => $students_courses_array['image'],
                'username' => $students_courses_array['name'],
                'majorName' => $majName,
            );

            $response[] = $rows;

        }
    }

} else {
    $sqlNormal = mysqli_query($con, "SELECT * from users WHERE user_type_id = 2 AND active = 1 ORDER BY id DESC");

    while ($rowNormal = mysqli_fetch_array($sqlNormal)) {

        $std_id = $rowNormal['id'];

        $sqlNormalData = mysqli_query($con, "SELECT * from student_majors WHERE student_id = '$std_id'");
        $rowNormalData = mysqli_fetch_array($sqlNormalData);

        $maj_id = $rowNormalData['major_id'];

        $majorData = mysqli_query($con, "SELECT * from majors WHERE id = '$maj_id'");
        $rowNormalDataMajor = mysqli_fetch_array($majorData);

        $majName = $rowNormalDataMajor['name'];

        $rows = array(
            'studentId' => $rowNormal['id'],
            'userImage' => $rowNormal['image'],
            'username' => $rowNormal['name'],
            'majorName' => $majName,
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
    <link href="./assets/css/site.css" rel="stylesheet">
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
                        <a href="./Students.php" class="nav-item nav-link active">Students</a>
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


    <!-- Students Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">

      <div class="container py-5">
        <div
          class="section-title text-center position-relative pb-3 mb-5 mx-auto"
          style="max-width: 600px"
        >
          <h5 class="fw-bold text-primary text-uppercase">Students</h5>


                      <div class="">
                        <form action="./Students.php" method="post" class="row g-3">


                        <div class="col-md-4">
                          <select class="form-select" aria-label="Default select example" name="department_id">
                        <option disabled selected>Select Department</option>
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

                          <div class="col-md-6">
                          <select class="form-select" aria-label="Default select example" name="major_id">
                                    <option disabled selected>Select Major</option>
                                    <?php

if (!$department_id) {

    $sql1 = mysqli_query($con, "SELECT * from majors ORDER BY id DESC");
} else {
    $sql1 = mysqli_query($con, "SELECT * from majors WHERE department_id = '$department_id' ORDER BY id DESC");

}

while ($row1 = mysqli_fetch_array($sql1)) {
    $major_id_select = $row1['id'];
    $major_name_select = $row1['name'];
    ?>
                                      <option value="<?php echo $major_id_select ?>"><?php echo $major_name_select ?></option>
                                    <?php }?>



                    </select>
                          </div>


                          <!-- <div class="row mb-3"> -->
                    <div class="text-center col-md-2">
                      <button type="submit" name="filter" class="btn btn-primary">
                        Filter
                      </button>
                    </div>
                  <!-- </div> -->

                        </form>
                      </div>



                      <div class="mt-2">
                        <form action="./Students.php" method="post" class="row g-3">

                          <div class="col-md-10">
                        <input
                          class="form-control"
                          list="datalistOptions"
                          id="exampleDataList"
                          placeholder="Type to search..."
                          name="search"
                        />
                        <datalist id="datalistOptions">
                        <?php
$sql1 = mysqli_query($con, "SELECT * from courses WHERE active = 1 ORDER BY id DESC");
while ($row1 = mysqli_fetch_array($sql1)) {
    $course_id_select = $row1['id'];
    $course_name_select = $row1['name'];

    ?>
                          <option value="<?php echo $course_name_select ?>"><?php echo $course_name_select ?></option>
                          <?php }?>
                        </datalist>
                      </div>


                          <!-- <div class="row mb-3"> -->
                    <div class="text-center col-md-2">
                      <button type="submit" name="filter_2" class="btn btn-primary">
                        Filter
                      </button>
                    </div>
                  <!-- </div> -->

                        </form>
                      </div>










        </div>
        <div class="row g-5">


          <?php

foreach ($response as $row) {?>

<a class="col-lg-4 wow slideInUp" data-wow-delay="0.3s" href="./Student.php?student_id=<?php echo $row['studentId'] ?>">


              <div id="posts-section-1">
                      <div class="col-xl-12">

                      <div class="card-2 mt-2">

                        <div class="card-body pt-3">
                          <div class="tab-content pt-2">
                            <div
                              class="tab-pane fade show active profile-overview"
                              id="profile-overview"
                            >
                              <div class="d-flex justify-content-between">
                                  <div class="user-data-post">
                                  <img src="<?php echo $row['userImage'] ?>" class="" width="90px" height="90px"/>
                                    <div class="div-user-name">
                                    <h4 class="user-name-1"><?php echo $row['username'] ?></h4>
                                    <h4 class="user-name"><?php echo $row['majorName'] ?></h4>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>

            </div>

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
