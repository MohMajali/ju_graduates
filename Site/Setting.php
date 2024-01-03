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
    $image = $row1['image'];
    $userType = $row1['user_type_id'];

    if (isset($_POST['SubmitAccount'])) {

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
  document.location='./Setting.php';
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
document.location='./Setting.php';
   </script>";

            }

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Settings</title>
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
                            <a href="./Setting.php" class="dropdown-item active">Settings</a>
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

              <div class="card">
                <div class="card-body">
                  <form method="POST" action="./Setting.php" enctype="multipart/form-data">

                  <input type="hidden" value="<?php echo $S_ID ?>" name="student_id">
                    <div class="row g-3">


                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9 mt-2">
                        <img id="profile-image" src="<?php echo $image ?>" alt="Profile" width="150px" height="150px">
                        <div class="pt-2">
                        <label
                            for="profileImage"
                            class="btn btn-primary btn-sm"
                            ><i class="bi bi-upload" title="Upload image"></i
                          ></label>
                            <input type="file" name="file" onchange="onChange(event)" id="profileImage" hidden>
                        </div>
                      </div>
                    </div>


                      <div class="col-md-6">
                        <input
                          type="text"
                          name="name"
                          value="<?php echo $student_name ?>"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Your Name"
                          style="height: 55px"
                          required
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
                          required
                        />
                      </div>
                      <div class="col-12">
                        <input
                          type="test"
                          name="phone"
                          value="<?php echo $phone ?>"
                          pattern="[0-9]{10}"
                          title="Phone Number Must be 10 Digits"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Your Phone"
                          style="height: 55px"
                          required
                        />
                      </div>
                      <div class="col-12">
                        <input
                          type="text"
                          name="password"
                          value="<?php echo $password ?>"
                          pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"
                          title="Password Must be at least One Upper case, One Lower Case, Numbers & Symbols"
                          class="form-control border-0 bg-light px-4"
                          placeholder="Your Password"
                          style="height: 55px"
                          required
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

    <script>
        let profileImage = document.getElementById("profile-image");

        const onChange = (e) => {
        let profileImage = document.getElementById("profile-image");
        profileImage.src = window.URL.createObjectURL(e.target.files[0]);
        if (profileImage.hidden) {
          profileImage.hidden = !profileImage.hidden;
        //   deleteButton.hidden = false;
        }
      };
    </script>

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
