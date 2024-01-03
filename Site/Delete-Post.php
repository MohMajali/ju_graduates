<?php
session_start();

include "../Connect.php";

$S_ID = $_SESSION['S_Log'];
$id = $_GET['id'];

$updateStmt = $con->prepare("DELETE FROM comments WHERE post_id = ?");
$updateStmt->bind_param("i", $id);

if ($updateStmt->execute()) {
    $stmt = $con->prepare("DELETE FROM posts WHERE id = ?");

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        echo "<script language='JavaScript'>
        alert ('POST Has Been Deleted Successfully !');
    </script>";

        echo "<script language='JavaScript'>
    document.location='./MyPosts.php';
     </script>";

    }
}
