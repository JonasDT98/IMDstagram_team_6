<?php

include_once(__DIR__ . "/../classes/Report.php");
include_once(__DIR__ . "/../classes/db.php");
include_once(__DIR__ . "/../classes/User.php");
include_once(__DIR__ . "/../classes/Post.php");
if (!empty($_POST)) {
//    new Report
    session_start();
    $userId = User::getId($_SESSION['username']);
    $userId = $userId['id'];
    $postId = $_POST['postId'];
    $r = new Report();
    $r->setPostId($postId);
    $r->setUserId($userId);

    if (!Post::isReported($userId, $postId)) {


        $r->saveReport();
        $reports = Post::getAmountOfReports($postId);
        if($reports >= 3){
            Post::setHidden(1, $postId);
            $response = [
                'status' => 'success',
                'message' => 'Report saved en true',
                'reported' => Post::isReported($userId, $postId),
                'hidden' => Post::isHidden($postId),
                'amount' => $reports
            ];
        }
        elseif($reports < 3){
            Post::setHidden(0, $postId);
            $response = [
                'status' => 'success',
                'message' => 'Report saved en false',
                'reported' => Post::isReported($userId, $postId),
                'hidden' => Post::isHidden($postId),
                'amount' => $reports
            ];
        }
        //success message


    }
    else {
        $r->deleteReport();
        $reports = Post::getAmountOfReports($postId);
        if($reports >= 3){
            Post::setHidden(1, $postId);
            $response = [
                'status' => 'success',
                'message' => 'report removed en true',
                'reported' => Post::isReported($userId, $postId),
                'hidden' => Post::isHidden($postId),
                'amount' => $reports
            ];
        }
        elseif($reports < 3){
            Post::setHidden(0, $postId);
            $response = [
                'status' => 'success',
                'message' => 'report removed en false',
                'reported' => Post::isReported($userId, $postId),
                'hidden' => Post::isHidden($postId),
                'amount' => $reports
            ];
        }

        }
    header('Content-Type: application/json');
    echo json_encode($response);
    }



