<?php
session_start();

include "../Connect.php";

$A_ID = $_SESSION['A_Log'];
$student_id = $_GET['student_id'];

if (!$A_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from users where id='$A_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Student - JU-GRADUATES</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logo.png" alt="" />
           
        </a>
      </div>
      <!-- End Logo -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
                src="https://www.computerhope.com/jargon/g/guest-user.png"
                alt="Profile"
                class="rounded-circle"
              />
              <span class="d-none d-md-block ps-2"><?php echo $name ?></span> </a
            ><!-- End Profile Iamge Icon -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php require './Aside-Nav/Aside.php'?>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Students</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Students</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr id="data-tr">
                      <th scope="col"># Majors</th>
                      <th scope="col"># Projects</th>
                      <th scope="col"># Experiences</th>
                      <th scope="col"># Courses</th>
                      <th scope="col"># Researches</th>
                      <th scope="col">CV</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
$sql1 = mysqli_query($con, "SELECT COUNT(id) AS count_majors from student_majors WHERE student_id = '$student_id' ORDER BY id DESC");
$row1 = mysqli_fetch_array($sql1);

$sql2 = mysqli_query($con, "SELECT COUNT(id) AS count_projects from student_projects WHERE student_id = '$student_id' ORDER BY id DESC");
$row2 = mysqli_fetch_array($sql2);

$sql3 = mysqli_query($con, "SELECT COUNT(id) AS count_exp from student_experinces WHERE student_id = '$student_id' ORDER BY id DESC");
$row3 = mysqli_fetch_array($sql3);

$sql4 = mysqli_query($con, "SELECT COUNT(id) AS count_courses from student_courses WHERE student_id = '$student_id' ORDER BY id DESC");
$row4 = mysqli_fetch_array($sql4);

$sql5 = mysqli_query($con, "SELECT COUNT(id) AS count_res from student_researches WHERE student_id = '$student_id' ORDER BY id DESC");
$row5 = mysqli_fetch_array($sql5);

$sql6 = mysqli_query($con, "SELECT COUNT(id) AS count_cv from students_cvs WHERE student_id = '$student_id' ORDER BY id DESC");
$row6 = mysqli_fetch_array($sql6);

?>
                    <tr>
                      <td scope="row"><button id="majors" onclick="clickTd(event)"><?php echo $row1['count_majors'] ?></button></td>
                      <td scope="row"><button id="projects" onclick="clickTd(event)"><?php echo $row2['count_projects'] ?></button></td>
                      <td><button id="exp" onclick="clickTd(event)"><?php echo $row3['count_exp'] ?></button></td>
                      <td><button id="courses" onclick="clickTd(event)"><?php echo $row4['count_courses'] ?></button></td>
                      <td><button id="res" onclick="clickTd(event)"><?php echo $row5['count_res'] ?></button></td>
                      <td><button id="cv" onclick="clickTd(event)"><?php echo $row6['count_cv'] ?></button></td>

                    </tr>

                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>




      <section id="major-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Major</th>
              <th scope="col">GPA</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from student_majors WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $student_major_id = $row1['id'];
    $major_id = $row1['major_id'];
    $gpa = $row1['gpa'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $major_student_created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from majors WHERE id = '$major_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $major_name = $row2['name'];

    ?>
            <tr>
              <td scope="row"><?php echo $student_major_id ?></td>
              <td scope="row"><?php echo $major_name ?></td>
              <td><?php echo $gpa ?></td>
              <td><?php echo $start_date ?></td>
              <td><?php echo $end_date ?></button></td>
              <td><?php echo $major_student_created_at ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>




<section id="projects-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Project Image</th>
              <th scope="col">Link</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from student_projects WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $project_major_id = $row1['id'];
    $title = $row1['title'];
    $description = $row1['description'];
    $main_image = $row1['main_image'];
    $project_file = $row1['project_file'];
    $project_student_created_at = $row1['created_at'];

    ?>
            <tr>
              <td scope="row"><?php echo $project_major_id ?></td>
              <td scope="row"><?php echo $title ?></td>
              <td><img src="../Site/<?php echo $main_image ?>" width="150px" height="150px" alt=""></td>
              <td><a href="../Site/<?php echo $project_file ?>">Project File</a></td>
              <td><?php echo $project_student_created_at ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>



<section id="exper-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Company Name</th>
              <th scope="col">Job Title</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from student_experinces WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $student_exper_id = $row1['id'];
    $company_id = $row1['company_id'];
    $job_id = $row1['job_id'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $exper_student_created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from companies WHERE id = '$company_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $company_name = $row2['name'];

    $sql3 = mysqli_query($con, "SELECT * from jobs WHERE id = '$job_id' ORDER BY id DESC");
    $row3 = mysqli_fetch_array($sql3);

    $job_name = $row3['name'];

    ?>
            <tr>
              <td scope="row"><?php echo $student_exper_id ?></td>
              <td scope="row"><?php echo $company_name ?></td>
              <td><?php echo $job_name ?></td>
              <td><?php echo $start_date ?></td>
              <td><?php echo $end_date ?></td>
              <td><?php echo $exper_student_created_at ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>


<section id="courses-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Course Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from student_courses WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $student_course_id = $row1['id'];
    $course_id = $row1['course_id'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $course_student_created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from courses WHERE id = '$course_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $course_name = $row2['name'];

    ?>
            <tr>
              <td scope="row"><?php echo $student_course_id ?></td>
              <td scope="row"><?php echo $course_name ?></td>
              <td><?php echo $start_date ?></td>
              <td><?php echo $end_date ?></td>
              <td><?php echo $student_course_id ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>


<section id="res-section" id="researches-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Research Title</th>
              <th scope="col">Research Image</th>
              <th scope="col">Link</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from student_researches WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $research_id = $row1['id'];
    $title = $row1['title'];
    $description = $row1['description'];
    $research_image = $row1['research_image'];
    $research_file = $row1['research_file'];
    $research_student_created_at = $row1['created_at'];

    ?>
            <tr>
              <td scope="row"><?php echo $research_id ?></td>
              <td scope="row"><?php echo $title ?></td>
              <td><img src="../Site/<?php echo $research_image ?>" width="150px" height="150px" alt=""></td>
              <td><a href="../Site/<?php echo $research_file ?>">Research File</a></td>
              <td><?php echo $research_student_created_at ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>

<section id="cv-section" class="section" hidden>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr id="data-tr">
              <th scope="col">ID</th>
              <th scope="col">Link</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>

          <?php
$sql1 = mysqli_query($con, "SELECT * from students_cvs WHERE student_id = '$student_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $cv_id = $row1['id'];
    $cv_file = $row1['cv_file'];
    $cv_created_at = $row1['created_at'];

    ?>
            <tr>
              <td scope="row"><?php echo $cv_id ?></td>
              <td><a href="../Site/<?php echo $cv_file ?>">Research File</a></td>
              <td><?php echo $cv_created_at ?></td>

            </tr>
<?php }?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
</section>

    </main>



    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>JU-Graduates</span></strong
        >. All Rights Reserved
      </div>
    </footer>
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

  <script>

      const clickTd = (e) => {

        const objects = {
          majors: document.getElementById('major-section'),
          projects : document.getElementById('projects-section'),
          exp : document.getElementById('exper-section'),
          courses: document.getElementById('courses-section'),
          res: document.getElementById('res-section'),
          cv: document.getElementById('cv-section')
        }

        objects[e.target.id].hidden = !objects[e.target.id].hidden

      }

      window.addEventListener('DOMContentLoaded', (event) => {
      document.querySelector('#sidebar-nav .nav-item:nth-child(8) .nav-link').classList.remove('collapsed')
    });

  </script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
