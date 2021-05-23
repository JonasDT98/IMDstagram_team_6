<?php

include_once(__DIR__ . "/../classes/db.php");
include_once(__DIR__ . "/../classes/User.php");
include_once(__DIR__ . "/../classes/Follow.php");
if (!empty($_POST)) {
//    new Follow
    session_start();
    $userId = User::getId($_SESSION['username']);
    $followedId = $_POST['id'];

    $f = new Follow();
    $f->setFollowedId($followedId);
    $f->setUserId($userId);
    if (!User::isFollowed($userId, $followedId)) {

        $f->saveFollow();

        //success message
        if (User::getAmountOfFollowers($followedId) != 1) {
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(User::getAmountOfFollowers($f->getFollowedId()) . " followers"),
                'message' => 'Follow saved',
                'followed' => User::isFollowed($userId, $followedId),
                'followedId' => $followedId,
                'userId' => $userId
            ];
        } else {
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(User::getAmountOfFollowers($f->getFollowedId()) . " follower"),
                'message' => 'Follow saved',
                'followed' => User::isFollowed($userId, $followedId),
                'followedId' => $followedId,
                'userId' => $userId
            ];
        }
    }
    else {
        $f->deleteFollow();

        if (User::getAmountOfFollowers($followedId) != 1) {
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(User::getAmountOfFollowers($f->getFollowedId()) . " followers"),
                'message' => 'Follow deleted',
                'followed' => User::isFollowed($userId, $followedId),
                'followedId' => $followedId,
                'userId' => $userId
            ];
        } else {
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars(User::getAmountOfFollowers($f->getFollowedId()) . " follower"),
                'message' => 'Follow deleted',
                'followed' => User::isFollowed($userId, $followedId),
                'followedId' => $followedId,
                'userId' => $userId
            ];
        }
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}