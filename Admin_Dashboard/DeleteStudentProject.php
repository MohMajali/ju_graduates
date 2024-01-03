<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$project_major_id = $_GET['project_major_id'];
$student_id = $_GET['student_id'];

$stmt = $con->prepare("DELETE FROM student_projects WHERE id = ? ");

$stmt->bind_param("i", $project_major_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Project Has Been Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./View-Single-Student.php?student_id=${student_id}';
        </script>";

}
