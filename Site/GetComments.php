<?php

session_start();

include "../Connect.php";
$response = array();
$comments = [];

$sql3 = mysqli_query($con, "SELECT * from comments ORDER BY id DESC");

while ($row3 = mysqli_fetch_array($sql3)) {

    $comment_student_id = $row3['student_id'];
    $post_id = $row3['post_id'];
    $comment = $row3['comment'];
    $comment_created_at = $row3['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$comment_student_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $comment_student_name = $row2['name'];
    $comment_student_image = $row2['image'];

    $commentData = array(
        'comment_student_id' => $comment_student_id,
        'comment' => $comment,
        'created_at' => $comment_created_at,
        'student_name' => $comment_student_name,
        'student_image' => $comment_student_image,
        'post_id' => $post_id
    );

    $comments[] = $commentData;
}

$response['comments'] = $comments; 

echo json_encode($response);
