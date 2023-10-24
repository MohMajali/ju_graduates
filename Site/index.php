<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];

if ($S_ID) {
    $sql1 = mysqli_query($con, "select * from users where id='$S_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $student_id = $_POST['student_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file;

        $file = $_FILES["file"]["name"];

        if ($file) {
            $file = 'Posts-Images/' . $file;

            $stmt = $con->prepare("INSERT INTO posts (student_id, title, description, image) VALUES (?, ?, ?, ?) ");

            $stmt->bind_param("isss", $student_id, $title, $description, $file);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "Posts-Images/" . $_FILES["file"]["name"]);

                echo "<script language='JavaScript'>
            alert ('A New Course Has Been Added Successfully !');
       </script>";

                echo "<script language='JavaScript'>
      document.location='./index.php';
         </script>";

            }
        }
    } else if (isset($_POST['SubmitComment'])) {

        $student_id = $_POST['student_id'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];

        $stmt = $con->prepare("INSERT INTO comments (student_id, post_id, comment) VALUES (?, ?, ?) ");

        $stmt->bind_param("iis", $student_id, $post_id, $comment);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
          alert ('Comment Has Been Added Successfully !');
     </script>";

            echo "<script language='JavaScript'>
    document.location='./index.php';
       </script>";

        }

    }
} else {
  echo "<script language='JavaScript'>
  alert ('You Are not Logged in !');
</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="./assets/css/site.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@example.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <!-- <img src="assets/img/favicon.png" alt=""> -->
                <img src="assets/img/favicon.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
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
                        <a href="./Students.php" class="nav-item nav-link">Students</a>

                    <?php }?>

                </div>
                <button
                      type="button"
                      class="btn text-primary ms-3"
                      data-bs-toggle="modal"
                      data-bs-target="#searchModal"
                      ><i class="fa fa-search"></i>
              </button>
            </div>
        </nav>

        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Meet up with students</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                            <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Meet up with students</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                            <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
      <!-- <div class="modal-dialog modal-fullscreen"> -->

      <form action="./Students.php" method="POST" class="modal-dialog modal-fullscreen">
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
                  name="search"
                  class="form-control bg-transparent border-primary p-3"
                  placeholder="Search By Courses"
                />
                <button class="btn btn-primary px-4">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
          </div>
      </form>


      <!-- </div> -->
    </div>
    <!-- Full Screen Search End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Latest Posts</h5>
            </div>

            <div class="col g-5 justify-content-center">

            <div class="row">
             <div class="col-xl-12 mt-5">
              <div class="card p-4">
                <form action="./index.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="student_id" value="<?php echo $S_ID ?>">

                  <div class="row gy-4">
                    <div class="col-md-12">
                      <input
                        type="text"
                        class="form-control"
                        name="title"
                        placeholder="Title"
                        required
                      />
                    </div>

                    <div class="col-md-12">
                      <textarea
                        class="form-control"
                        name="description"
                        rows="6"
                        placeholder="Message"
                        required
                      ></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                      <div class="col-md-12 col-lg-12">
                        <img
                          id="postImage"
                          src="assets/img/profile-img.jpg"
                          alt="Profile"
                          class="w-50 h-50"
                          hidden
                        />
                        <div class="pt-2">
                          <label
                            for="profileImage"
                            class="btn btn-primary btn-sm"
                            ><i class="bi bi-upload" title="Upload image"></i
                          ></label>
                          <input
                            type="file"
                            name="file"
                            id="profileImage"
                            onchange="onChange(event)"
                            hidden
                          />
                          <button
                            id="deleteButton"
                            class="btn btn-danger btn-sm"
                            title="Remove image"
                            onclick="onClick(event)"
                          >
                            <i class="bi bi-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <button type="submit" name="Submit" class="btn btn-primary">
                        Create Post
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <?php
$sql1 = mysqli_query($con, "SELECT * from posts ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $active = $row1['active'];
    if ($active == 1) {
        $post_id = $row1['id'];
        $student_id = $row1['student_id'];
        $title = $row1['title'];
        $description = $row1['description'];
        $image = $row1['image'];
        $created_at = $row1['created_at'];

        $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$student_id' ORDER BY id DESC");
        $row2 = mysqli_fetch_array($sql2);

        $student_name = $row2['name'];
        $student_email = $row2['email'];
        $student_image = $row2['image'];

        ?>
          <div class="col-xl-12">
            <div class="card mt-2">
              <div class="card-body pt-3">
                <div class="tab-content pt-2">
                  <div
                    class="tab-pane fade show active profile-overview"
                    id="profile-overview"
                  >
                    <div class="user-data-post">
                      <img src="<?php echo $student_image ?>" class="" width="90px" height="90px" />
                      <h4 class="user-name"><?php echo $student_name ?></h4>
                    </div>

                    <p class="small fst-italic mt-4">
                      <?php echo $description ?>
                    </p>

                    <div class="text-center">
                      <img
                        src="<?php echo $image ?>"
                        class="img-fluid"
                        height="450px"
                        width="450px"
                      />
                    </div>

                  <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 col-md-6 col-12 pb-4">
                                <h1>Comments</h1>

                                <?php
$sql3 = mysqli_query($con, "SELECT * from comments WHERE post_id = '$post_id' ORDER BY id DESC");

        while ($row3 = mysqli_fetch_array($sql3)) {

            $comment_student_id = $row3['student_id'];
            $comment = $row3['comment'];
            $comment_created_at = $row3['created_at'];

            $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$comment_student_id' ORDER BY id DESC");
            $row2 = mysqli_fetch_array($sql2);

            $comment_student_name = $row2['name'];
            $comment_student_image = $row2['image'];

            ?>
                                <div class="darker mt-4 text-justify">
                                    <img src="<?php echo $comment_student_image ?>" alt="" class="rounded-circle" width="40" height="40">
                                    <h4><?php echo $comment_student_name ?></h4>
                                    <span>- <?php echo $comment_created_at ?></span>
                                    <br>
                                    <p ><?php echo $comment ?></p>
                                </div>
<?php }?>
                            </div>
                        </div>
                    </div>
                </section>


                <form method="POST" action="./index.php" enctype="multipart/form-data">


<input type="hidden" value="<?php echo $S_ID ?>" name="student_id">
<input type="hidden" value="<?php echo $post_id ?>" name="post_id">



  <div class="row mb-3">
    <!-- <label for="inputText" class="col-sm-4 col-form-label"
      >Project Description</label
    > -->
    <div class="col-sm-12">
    <textarea name="comment" class="form-control" style="height: 100px" placeholder="Put your comment"></textarea>
    </div>
  </div>


  <div class="row mb-3">
    <div class="text-end">
      <button type="submit" name="SubmitComment" class="btn btn-primary">
        Add Comment
      </button>
    </div>
  </div>
</form>
                  </div>
                </div>
                <!-- End Bordered Tabs -->
              </div>
            </div>
          </div>

<?php }}?>

            </div>
        </div>
    </div>
    <!-- Blog Start -->


    <!-- Footer Start -->
        <?php require './Footer.php'?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
      let postImage = document.getElementById("postImage");
      let deleteButton = document.getElementById("deleteButton");

      if (postImage.hidden) {
        deleteButton.hidden = true;
      }

      const onChange = (e) => {
        let postImage = document.getElementById("postImage");
        postImage.src = window.URL.createObjectURL(e.target.files[0]);
        if (postImage.hidden) {
          postImage.hidden = !postImage.hidden;
          deleteButton.hidden = false;
        }
      };

      const onClick = (e) => {
        let postImage = document.getElementById("postImage");

        if (!postImage.hidden) {
          postImage.hidden = !postImage.hidden;
          deleteButton.hidden = true;
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
