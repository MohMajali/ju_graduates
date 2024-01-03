<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$cv_id = $_GET['cv_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM students_cvs WHERE id = ? ");

$stmt->bind_param("i", $cv_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('CV Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
