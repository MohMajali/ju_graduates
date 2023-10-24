<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$research_id = $_GET['research_id'];

$stmt = $con->prepare("DELETE FROM student_researches WHERE id = ?");

$stmt->bind_param("i", $research_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Research Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
