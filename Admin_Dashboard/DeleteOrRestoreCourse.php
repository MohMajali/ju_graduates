<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$course_id = $_GET['course_id'];

$stmt = $con->prepare("UPDATE courses SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $course_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Course Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Courses.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Course Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Courses.php';
</script>";
    }

}
