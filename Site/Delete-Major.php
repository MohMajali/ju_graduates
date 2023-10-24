<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$major_id = $_GET['major_id'];

$stmt = $con->prepare("DELETE FROM student_majors WHERE id = ?");

$stmt->bind_param("i", $major_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Student Major Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
