<?php
include_once (__DIR__ . "/../classes/Comment.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
include_once (__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Comment
    session_start();
    $userId = User::getId($_SESSION['username']);
    $data = Post::showFirstPosts(20);

    //save comment in Db


    //success message
    $response = [
        'status' => 'success',
        'body' => [$data],
        'message' => 'Comment saved'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
