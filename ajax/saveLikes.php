<?php
include_once (__DIR__ . "/../classes/Like.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
include_once (__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Like
    session_start();
    $userId = User::getId($_SESSION['username']);

    $l = new Like();
    $l->setPostId($_POST['postId']);
    $l->setUserId($userId['id']);
    $postId = $l->getPostId();
    $userid = $l->getUserId();
    if($l->isLiked($userId)){
        $l->saveLike();

        //success message
        if ($l->getAmountOfLikes($l->getPostId()) != 1){
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars($l->getAmountOfLikes($l->getPostId()) . " likes" ),
                'message' => 'Like saved'
            ];
        }
        else{
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars($l->getAmountOfLikes($l->getPostId()) . " like" ),
                'message' => 'Like saved'
            ];
        }
    }
    else{
        $l->unsaveLike();
        $response = [
                'status' => 'success',
                'body' => htmlspecialchars($l->getAmountOfLikes($l->getPostId()) - 1 . " like" ),
                'message' => 'Like removed'
        ];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
}