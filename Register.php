<?php
session_start();

include "./Connect.php";

if (isset($_POST['Submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $image = 'https://www.computerhope.com/jargon/g/guest-user.png';
    $userTypeId = $_POST['user_type_id'];

    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo '<script language="JavaScript">
      alert ("Sorry, Student Already Exist !")
        </script>';

        echo '<script language="JavaScript">
      document.location="./Login.php";
      </script>';

    } else {
        $stmt = $con->prepare("INSERT INTO users (name, email, password, phone, image, user_type_id) VALUES (?, ?, ?, ?, ?, ?) ");

        $stmt->bind_param("sssssi", $name, $email, $password, $phone, $image, $userTypeId);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
            alert ('Registration Success, You Can Login Now !');
       </script>";

            echo "<script language='JavaScript'>
      document.location='./Login.php';
         </script>";

        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Register Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/image00001.jpeg" rel="icon" />
    <link href="assets/img/image00001.jpeg" rel="apple-touch-icon" />

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
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.html"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/image00001.jpeg" alt="" />

                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Create an Account
                      </h5>
                      <p class="text-center small">
                        Enter your personal details to create account
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" method="POSt" action="./Register.php" novalidate>
                      <div class="col-12">
                        <label for="yourName" class="form-label"
                          >Your Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="yourName"
                          required
                        />
                        <div class="invalid-feedback">
                          Please, enter your name!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourEmail" class="form-label"
                          >Your Email</label
                        >
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          id="yourEmail"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter a valid Email adddress!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourEmail" class="form-label"
                          >Phone Number</label
                        >
                        <input
                          type="number"
                          min=0
                          name="phone"
                          class="form-control"
                          id="yourEmail"
                          pattern="[0-9]{10}"
                          required
                        />
                        <div class="invalid-feedback">
                          Phone Number Must Be 10 Numbers!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"
                          required
                        />
                        <div class="invalid-feedback">
                        Password Must be at least One Upper case, One Lower Case, Numbers & Symbols
                        </div>
                      </div>


                      <div class="col-12">
                        <label for="defaultSelect" class="form-label">Select Role</label>
                        <select id="defaultSelect" name="user_type_id" class="form-select" required>
                          <option value="2">Student</option>
                          <option value="3">Company</option>
                        </select>
                      </div>

                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100"
                          type="submit"
                          name="Submit"
                        >
                          Create Account
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Already have an account?
                          <a href="./Login.php">Log in</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="credits"></div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

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
