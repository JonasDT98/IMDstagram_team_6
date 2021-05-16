<?php
include_once (__DIR__ . "/../classes/Comment.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
include_once (__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Comment
    session_start();
    $user = $_SESSION['username']   ;
    $amountPosts = $_POST['postsAmount'];
    $data = Post::showPosts($amountPosts);


    //save comment in Db

    //success message
    $response = [
        'status' => 'success',
        'body' => $data,
        'username' => $user,
        'message' => 'Posts are loaded in'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
