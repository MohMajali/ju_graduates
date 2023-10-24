<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$project_id = $_GET['project_id'];

$stmt = $con->prepare("DELETE FROM student_projects WHERE id = ?");

$stmt->bind_param("i", $project_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Project Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
