<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$student_major_id = $_GET['student_major_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM student_majors WHERE id = ? ");

$stmt->bind_param("i", $student_major_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Student Major Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
