<?php
include_once (__DIR__ . "/../classes/Comment.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
include_once (__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Comment
    session_start();
    $user = $_SESSION['username'];
    $amountPosts = $_POST['postsAmount'];
    $posts = Post::showPosts($amountPosts);
    $isLiked = array();
    $isReported = array();
    $isHidden = array();
    foreach ($posts as $post) {
        $userid = User::getId($_SESSION['username']);
        $userid = $userid['id'];
        $postid = $post['id'];
        $liked = Post::isLiked($userid, $postid);
        array_push($isLiked, $liked);
        $reported = Post::isReported($userid, $postid);
        array_push($isReported, $reported);
        $hidden = Post::isHidden($postid);
        array_push($isHidden, $hidden);
    }
    //save comment in Db

    //success message
    $response = [
        'status' => 'success',
        'body' => $posts,
        'username' => $user,
        'isLiked' => $isLiked,
        'isReported' => $isReported,
        'isHidden' => $isHidden,
        'message' => 'Posts are loaded in'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
