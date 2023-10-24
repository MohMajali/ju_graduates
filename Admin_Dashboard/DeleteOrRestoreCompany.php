<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$company_id = $_GET['company_id'];

$stmt = $con->prepare("UPDATE companies SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $company_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Company Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Companies.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Company Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Companies.php';
</script>";
    }

}
