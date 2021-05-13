<?php
include_once (__DIR__ . "/../classes/Like.php");
include_once (__DIR__ . "/../classes/db.php");
include_once (__DIR__ . "/../classes/User.php");
include_once (__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Like
    session_start();
    $userId = User::getId($_SESSION['username']);
    $userId = $userId['id'];
    $postId = $_POST['postId'];
    $l = new Like();
    $l->setPostId($postId);
    $l->setUserId($userId);
    if(!Post::isLiked($userId, $postId)){

    $l->saveLike();

        //success message
        if (Post::getAmountOfLikes($postId) != 1){
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(Post::getAmountOfLikes($l->getPostId()) . " likes" ),
                'message' => 'Like saved',
                'liked' => Post::isLiked($userId, $postId)
            ];
        }
        else{
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(Post::getAmountOfLikes($l->getPostId()) . " like" ),
                'message' => 'Like saved',
                'liked' => Post::isLiked($userId, $postId)
            ];
        }
    }
    else{
        $l->deleteLike();

        if (Post::getAmountOfLikes($postId) != 1){
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(Post::getAmountOfLikes($l->getPostId()) . " likes" ),
                'message' => 'Like removed',
                'liked' => Post::isLiked($userId, $postId)
            ];
        }
        else{
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(Post::getAmountOfLikes($l->getPostId()) . " like" ),
                'message' => 'Like removed',
                'liked' => Post::isLiked($userId, $postId)
            ];
        }
    }



    header('Content-Type: application/json');
    echo json_encode($response);
}