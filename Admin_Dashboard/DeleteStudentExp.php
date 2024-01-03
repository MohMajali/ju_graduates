<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$student_exper_id = $_GET['student_exper_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM student_experinces WHERE id = ? ");

$stmt->bind_param("i", $student_exper_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Experience Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
