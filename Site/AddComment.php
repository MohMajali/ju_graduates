<?php
session_start();

include "../Connect.php";

$student_id = $_POST['student_id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

// print_r($student_id . '/-> ');
// print_r($post_id . '/-> ');
// die;

$response = array();

$stmt = $con->prepare("INSERT INTO comments (student_id, post_id, comment) VALUES (?, ?, ?) ");

$stmt->bind_param("iis", $student_id, $post_id, $comment);

if ($stmt->execute()) {

    $response['mesage'] = true;

} else {

    $response['mesage'] = false;
}

echo json_encode($response);
