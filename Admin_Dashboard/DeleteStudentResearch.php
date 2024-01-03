<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$research_id = $_GET['research_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM student_researches WHERE id = ? ");

$stmt->bind_param("i", $research_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Research Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
