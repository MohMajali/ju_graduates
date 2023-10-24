<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$experience_id = $_GET['experience_id'];

$stmt = $con->prepare("DELETE FROM student_experinces WHERE id = ?");

$stmt->bind_param("i", $experience_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Experince Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
