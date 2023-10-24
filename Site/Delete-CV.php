<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$cv_id = $_GET['cv_id'];

$stmt = $con->prepare("DELETE FROM students_cvs WHERE id = ?");

$stmt->bind_param("i", $cv_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('CV Has Been Deleted Successfully !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Profile.php';
 </script>";

}
