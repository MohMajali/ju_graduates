<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$student_course_id = $_GET['student_course_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM student_courses WHERE id = ? ");

$stmt->bind_param("i", $student_course_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Course Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
