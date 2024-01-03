<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$post_id = $_GET['post_id'];

$stmt = $con->prepare("UPDATE posts SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $post_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Post Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Posts.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Post Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Posts.php';
</script>";
    }

}
