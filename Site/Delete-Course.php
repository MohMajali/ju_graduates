<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$course_student_id = $_GET['course_student_id'];

$stmt = $con->prepare("DELETE FROM student_courses WHERE id = ?");

$stmt->bind_param("i", $course_student_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Course Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
