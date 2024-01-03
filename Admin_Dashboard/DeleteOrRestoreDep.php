<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$department_id = $_GET['department_id'];

$stmt = $con->prepare("UPDATE departments SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $department_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Department Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Departments.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Department Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Departments.php';
</script>";
    }

}
