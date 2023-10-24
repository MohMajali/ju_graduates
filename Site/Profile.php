<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

if ($S_ID) {
    $sql1 = mysqli_query($con, "select * from users where id='$S_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $student_name = $row1['name'];
    $student_email = $row1['email'];
    $phone = $row1['phone'];
    $password = $row1['password'];

    if (isset($_POST['SubmitExper'])) {

        $company_id = $_POST['company_id'];
        $job_id = $_POST['job_id'];
        $student_id = $_POST['student_id'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $con->prepare("INSERT INTO student_experinces (company_id, job_id, student_id, description, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?) ");

        $stmt->bind_param("iiisss", $company_id, $job_id, $student_id, $description, $start_date, $end_date);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
          alert ('Experince Has Been Added Successfully !');
     </script>";

            echo "<script language='JavaScript'>
    document.location='./Profile.php';
       </script>";

        }

    } else if (isset($_POST['SubmitCourse'])) {

        $course_id = $_POST['course_id'];
        $student_id = $_POST['student_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $con->prepare("INSERT INTO student_courses (course_id, student_id, start_date, end_date) VALUES (?, ?, ?, ?) ");

        $stmt->bind_param("iiss", $course_id, $student_id, $start_date, $end_date);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
        alert ('Course Has Been Added Successfully !');
   </script>";

            echo "<script language='JavaScript'>
  document.location='./Profile.php';
     </script>";

        }

    } else if (isset($_POST['SubmitProject'])) {

        $student_id = $_POST['student_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file;
        $projectFile;

        $file = $_FILES["file"]["name"];
        $projectFile = $_FILES["projectFile"]["name"];

        if ($file && $projectFile) {

            $file = 'Projects-Images/' . $file;
            $projectFile = 'Projects-Images/' . $projectFile;

            $stmt = $con->prepare("INSERT INTO student_projects (student_id, title, description, main_image, project_file) VALUES (?, ?, ?, ?, ?) ");

            $stmt->bind_param("issss", $student_id, $title, $description, $file, $projectFile);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "Projects-Images/" . $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["projectFile"]["tmp_name"], "Projects-Images/" . $_FILES["projectFile"]["name"]);

                echo "<script language='JavaScript'>
        alert ('Project Has Been Added Successfully !');
   </script>";

                echo "<script language='JavaScript'>
  document.location='./Profile.php';
     </script>";

            }
        }

    } else if (isset($_POST['SubmitResearch'])) {

        $student_id = $_POST['student_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file;
        $researchFile;

        $file = $_FILES["file"]["name"];
        $researchFile = $_FILES["researchFile"]["name"];

        if ($file && $researchFile) {

            $file = 'Researches_Images/' . $file;
            $researchFile = 'Researches_Images/' . $researchFile;

            $stmt = $con->prepare("INSERT INTO student_researches (student_id, title, description, research_image, research_file) VALUES (?, ?, ?, ?, ?) ");

            $stmt->bind_param("issss", $student_id, $title, $description, $file, $researchFile);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "Researches_Images/" . $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["researchFile"]["tmp_name"], "Researches_Images/" . $_FILES["researchFile"]["name"]);

                echo "<script language='JavaScript'>
      alert ('Research Has Been Added Successfully !');
 </script>";

                echo "<script language='JavaScript'>
document.location='./Profile.php';
   </script>";

            }
        }
    } else if (isset($_POST['SubmitCv'])) {

        $student_id = $_POST['student_id'];
        $file;

        $stmt = $con->prepare("SELECT id FROM students_cvs WHERE id = ?");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

            echo '<script language="JavaScript">
        alert ("Sorry, Student Already Has Uploaded CV !")
          </script>';

            echo '<script language="JavaScript">
        document.location="./Profile.php";
        </script>';

        } else {
            $file = $_FILES["file"]["name"];

            if ($file) {

                $file = 'CV-Files/' . $file;

                $stmt = $con->prepare("INSERT INTO students_cvs (student_id, cv_file) VALUES (?, ?)");

                $stmt->bind_param("is", $student_id, $file);

                if ($stmt->execute()) {

                    move_uploaded_file($_FILES["file"]["tmp_name"], "CV-Files/" . $_FILES["file"]["name"]);

                    echo "<script language='JavaScript'>
      alert ('CV Has Been Added Successfully !');
  </script>";

                    echo "<script language='JavaScript'>
  document.location='./Profile.php';
   </script>";

                }
            }
        }

    } else if (isset($_POST['SubmitAccount'])) {

        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $student_id = $_POST['student_id'];
        $file;
        $file = $_FILES["file"]["name"];

        if ($file) {

            $file = 'Student-Images/' . $file;

            $stmt = $con->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ?, image = ?  WHERE id = ?");

            $stmt->bind_param("sssssi", $name, $email, $phone, $password, $file, $student_id);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "Student-Images/" . $_FILES["file"]["name"]);

                echo "<script language='JavaScript'>
        alert ('Account Has Been Added Successfully !');
   </script>";

                echo "<script language='JavaScript'>
  document.location='./Profile.php';
     </script>";

            }
        } else {

            $stmt = $con->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ?  WHERE id = ?");

            $stmt->bind_param("ssssi", $name, $email, $phone, $password, $student_id);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
      alert ('Account Has Been Added Successfully !');
 </script>";

                echo "<script language='JavaScript'>
document.location='./Profile.php';
   </script>";

            }

        }

    } else if (isset($_POST['SubmitMajor'])) {

        $student_id = $_POST['student_id'];
        $major_id = $_POST['major_id'];
        $gpa = $_POST['gpa'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $con->prepare("INSERT INTO student_majors (student_id, major_id, gpa, start_date, end_date) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("iidss", $student_id, $major_id, $gpa, $start_date, $end_date);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
      alert ('GPA Has Been Added Successfully !');
 </script>";

            echo "<script language='JavaScript'>
document.location='./Profile.php';
   </script>";

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Profile Account</title>
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
                class="nav-link dropdown-toggle active"
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
            <a href="./Students.php" class="nav-item nav-link">Students</a>

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
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="./Profile.php" enctype="multipart/form-data">

                  <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <input
                          type="text"
                          name="name"
                          value="<?php echo $student_name ?>"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Your Name"
                          style="height: 55px"
                        />
                      </div>
                      <div class="col-md-6">
                        <input
                          type="email"
                          name="email"
                          value="<?php echo $student_email ?>"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Your Email"
                          style="height: 55px"
                        />
                      </div>
                      <div class="col-12">
                        <input
                          type="number"
                          name="phone"
                          value="<?php echo $phone ?>"
                          pattern="[0-9]{10}"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Subject"
                          style="height: 55px"
                        />
                      </div>
                      <div class="col-12">
                        <input
                          type="text"
                          name="password"
                          value="<?php echo $password ?>"
                          pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Subject"
                          style="height: 55px"
                        />
                      </div>
                      <div class="col-12">
                        <input
                          type="file"
                          name="file"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Subject"
                          style="height: 55px"
                        />
                      </div>
                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100 py-3"
                          type="submit" name="SubmitAccount"
                        >
                          Update
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>




              <div class="card mt-2">
                <div class="card-body">
                  <div class="experince-section">
                    <h5 class="card-title w-25">Majors</h5>
                    <div class="icon">
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredMajors"></i>
                    </div>
                  </div>


                  <div class="modal fade" id="verticalycenteredMajors" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Major Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Major Name</label
                    >
                    <div class="col-sm-8">
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
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >GPA</label
                    >
                    <div class="col-sm-8">
                    <input type="number" min=0 step="0.01" name="gpa" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Start Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="start_date" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >End Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="end_date" class="form-control">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitMajor" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>











                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_majors WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                      <a href="./Delete-Major.php?major_id=<?php echo $student_major_id ?>"><i class="ri-delete-back-2-fill"></i></a>
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
                    <div class="icon">
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredExperince"></i>
                    </div>
                  </div>


                  <div class="modal fade" id="verticalycenteredExperince" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Experience Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Company Name</label
                    >
                    <div class="col-sm-8">
                      <!-- <input type="text" class="form-control" name="name" required/> -->
                      <select class="form-select" aria-label="Default select example" name="company_id">
                        <option selected>Select Company</option>
                        <?php
$sql1 = mysqli_query($con, "SELECT * from companies WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $company_id_select = $row1['id'];
    $company_name_select = $row1['name'];
    ?>
                          <option value="<?php echo $company_id_select ?>"><?php echo $company_name_select ?></option>
                        <?php }?>



                    </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Job Name</label
                    >
                    <div class="col-sm-8">
                      <!-- <input type="text" class="form-control" name="name" required/> -->
                      <select class="form-select" aria-label="Default select example" name="job_id">
                        <option selected>Select Job</option>
                        <?php
$sql1 = mysqli_query($con, "SELECT * from jobs ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $job_id_select = $row1['id'];
    $job_name_select = $row1['name'];
    ?>
                          <option value="<?php echo $job_id_select ?>"><?php echo $job_name_select ?></option>
                        <?php }?>



                    </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Job Description</label
                    >
                    <div class="col-sm-8">
                      <textarea name="description" class="form-control" style="height: 100px"></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Start Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="start_date" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >End Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="end_date" class="form-control">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitExper" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>











                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_experinces WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                      <a href="./Delete-Experience.php?experience_id=<?php echo $exper_id ?>"><i class="ri-delete-back-2-fill"></i></a>
                      </div>
                      <h3><?php echo $job_name ?></h3>
                      <h5><?php echo date("Y-m-d", strtotime($start_date)); ?> - <?php echo date("Y-m-d", strtotime($end_date)); ?></h5>
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
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredCourses"></i>
                    </div>
                  </div>




                  <div class="modal fade" id="verticalycenteredCourses" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Course Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Course Name</label
                    >
                    <div class="col-sm-8">
                      <!-- <input type="text" class="form-control" name="name" required/> -->
                      <select class="form-select" aria-label="Default select example" name="course_id">
                        <option selected>Select Course</option>
                        <?php
$sql1 = mysqli_query($con, "SELECT * from courses WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $courses_id_select = $row1['id'];
    $courses_name_select = $row1['name'];
    ?>
                          <option value="<?php echo $courses_id_select ?>"><?php echo $courses_name_select ?></option>
                        <?php }?>



                    </select>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Start Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="start_date" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >End Date</label
                    >
                    <div class="col-sm-8">
                    <input type="date" name="end_date" class="form-control">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitCourse" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_courses WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                      <a href="./Delete-Course.php?course_student_id=<?php echo $course_student_id ?>"><i class="ri-delete-back-2-fill"></i></a>
                      </div>
                      <h5><?php echo date("Y-m-d", strtotime($course_start_date)); ?> - <?php echo date("Y-m-d", strtotime($course_end_date)); ?></h5>
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
                    <div class="icon">
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredProjects"></i>
                    </div>
                  </div>




                  <div class="modal fade" id="verticalycenteredProjects" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Project Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>




              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Project Title</label
                    >
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="title" required/>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Project Description</label
                    >
                    <div class="col-sm-8">
                    <textarea name="description" class="form-control" style="height: 100px"></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Project Image</label
                    >
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="file" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Project File</label
                    >
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="projectFile" required/>
                    </div>
                  </div>



                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitProject" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>


              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_projects WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                        <a href="./Delete-Project.php?project_id=<?php echo $project_id ?>"><i class="ri-delete-back-2-fill"></i></a>
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
                    <div class="icon">
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredResearches"></i>
                    </div>
                  </div>




                  <div class="modal fade" id="verticalycenteredResearches" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Research Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Research Title</label
                    >
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="title" required/>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Research Description</label
                    >
                    <div class="col-sm-8">
                    <textarea name="description" class="form-control" style="height: 100px"></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Research Image</label
                    >
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="file" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Research File</label
                    >
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="researchFile" required/>
                    </div>
                  </div>



                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitResearch" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from student_researches WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                        <a href="./Delete-Research.php?research_id=<?php echo $research_id ?>"><i class="ri-delete-back-2-fill"></i></a>
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
                    <div class="icon">
                      <i class="bx bxs-plus-square" data-bs-toggle="modal" data-bs-target="#verticalycenteredCv"></i>
                    </div>
                  </div>




                  <div class="modal fade" id="verticalycenteredCv" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">CV Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Profile.php" enctype="multipart/form-data">


                <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >CV File</label
                    >
                    <div class="col-sm-8">
                      <input type="file" class="form-control" name="file" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="SubmitCv" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from students_cvs WHERE student_id = '$S_ID' ORDER BY id DESC");

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
                        <a href="./Delete-CV.php?cv_id=<?php echo $cv_id ?>"><i class="ri-delete-back-2-fill"></i></a>
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
