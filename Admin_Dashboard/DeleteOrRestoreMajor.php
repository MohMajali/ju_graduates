<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$major_id = $_GET['major_id'];

$stmt = $con->prepare("UPDATE majors SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $major_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Major Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Majors.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Major Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Majors.php';
</script>";
    }

}
