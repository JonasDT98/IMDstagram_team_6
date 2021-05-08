<?php
include_once (__DIR__ . "/../classes/Comment.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
if (!empty($_POST)) {
//    new Comment
    session_start();
//    $conn = DB::getConnection();
//    $query = $conn->prepare("SELECT id from users where username = :username");
//    $query->bindValue(":username", $_SESSION['username']);
//    $query->execute();
//    $userId = $query->fetch();
    $userId = User::getId($_SESSION['username']);

    $c = new Comment();
    $c->setPostId($_POST['postId']);
    $c->setDescription($_POST['text']);
    $c->setUserId($userId['id']);

    //save comment in Db
    $c->save();

    //success message
    $response = [
        'status' => 'success',
        'body' => htmlspecialchars($c->getDescription()),
        'message' => 'Comment saved'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
