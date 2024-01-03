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
        } else {

            $stmt = $con->prepare("INSERT INTO posts (student_id, title, description) VALUES (?, ?, ?) ");

            $stmt->bind_param("iss", $student_id, $title, $description);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
          alert ('A New Course Has Been Added Successfully !');
     </script>";

                echo "<script language='JavaScript'>
    document.location='./index.php';
       </script>";

            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Posts</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="assets/img/image00001_png.png" rel="icon">

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





    <!-- Navbar & Carousel Start -->
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

                    <a href="contact.php" class="nav-item nav-link">Contact</a>

                    <?php if ($S_ID) {?>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $name ?></a>
                        <div class="dropdown-menu m-0">

                        <?php if ($userType != 3) {?>
                        <a href="./Profile.php" class="dropdown-item">Profile</a>
                        <?php }?>
                            <a href="./Setting.php" class="dropdown-item">Settings</a>
                            <a href="./MyPosts.php" class="dropdown-item active">My Posts</a>
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
    <!-- Navbar & Carousel End -->

    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" id="testID">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">My Posts</h5>
            </div>

            <div id="posts-section" class="col g-5 justify-content-center">



<?php
$sql1 = mysqli_query($con, "select * from posts where student_id ='$S_ID'");

while ($row1 = mysqli_fetch_array($sql1)) {

    $post_id = $row1['id'];
    $student_id = $row1['student_id'];
    $title = $row1['title'];
    $description = $row1['description'];
    $postImage = $row1['image'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$student_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $student_name = $row2['name'];
    $student_image = $row2['image'];

    ?>
            <div id="posts-section-1">
            <div class="col-xl-12">
            <div class="card mt-2">
              <div class="card-body pt-3">
                <div class="tab-content pt-2">
                  <div
                    class="tab-pane fade show active profile-overview"
                    id="profile-overview"
                  >
                    <div class="d-flex justify-content-between">
                        <div class="user-data-post">
                        <img src="<?php echo $student_image ?>" class="" width="90px" height="90px" />
                          <h4 class="user-name"><?php echo $student_name ?></h4>
                        </div>
                      <div class="">
                          <a href="Edit-Post.php?id=<?php echo $post_id ?>" class="btn btn-primary">Edit</a>
                          <a href="Delete-Post.php?id=<?php echo $post_id ?>" class="btn btn-danger">Delete</a>
                      </div>
                    </div>

                    <p class="small fst-italic mt-4">
                    <?php echo $description ?>
                    </p>

                    <div class="text-center">
                      <img
                        src="<?php echo $postImage ?>"
                        class="img-fluid"
                        height="450px"
                        width="450px"
                      />
                    </div>


                  </div>
                </div>
                <!-- End Bordered Tabs -->
              </div>
            </div>
          </div>

            </div>
<?php }?>

            </div>
        </div>
    </div>
    <!-- Blog Start -->


    <!-- Footer Start -->
        <?php require './Footer.php'?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


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









<script>

$( document ).ready(function() {

  $(document).on('submit', '#commentFrom', function(event) {
  event.preventDefault();

  let form = $(this)
  let url = form.attr('action')

  $.ajax({
  type: 'POST',
  url: './AddComment.php',
  data: form.serialize()
}).done(function(data){

  if(JSON.parse(data)?.mesage){
    // console.log(JSON.parse(data));
    postsAndCommentsSection()
  }
})
})

});

</script>
</body>

</html>
