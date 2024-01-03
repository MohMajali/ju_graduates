<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$job_id = $_GET['job_id'];

$stmt = $con->prepare("UPDATE jobs SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $job_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Job Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Jobs.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Job Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Jobs.php';
</script>";
    }

}
