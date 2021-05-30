<?php
include_once (__DIR__ . "/Db.php");
include_once (__DIR__ . "/Post.php");

class Search{
    private $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public static function searchPost($search) : array
    {
        $conn = Db::getConnection();
        $statementPost =$conn->prepare("SELECT post.id, users.username, users.profilePic, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id where `description` like :search;");
        $statementPost->bindValue(':search', '%'.$search.'%');
        $statementPost->execute();
        $posts = $statementPost->fetchAll();

        $fullPosts = array();
        $comments = array();
        $likes = array();

        foreach ($posts as $post) {

            $statementPost = $conn->prepare("SELECT users.username, comments.description, comments.time_comment FROM comments JOIN users on users.id = comments.user_id WHERE comments.post_id = :post_id");
            $statementPost->bindValue(":post_id", $post['id']);
            $statementPost->execute();
            $fetchedComments = $statementPost->fetchAll();

            if (!empty($fetchedComments)) {
                foreach ($fetchedComments as $fetchedComment) {
                    array_push($comments, array("username" => $fetchedComment['username'], "comment" => $fetchedComment['description'], "time" => $fetchedComment['time_comment']));
                }
            }

            $statementPost = $conn->prepare("SELECT users.username FROM likes JOIN users on users.id = likes.user_id WHERE likes.post_id = :post_id");
            $statementPost->bindValue(":post_id", $post['id']);
            $statementPost->execute();
            $fetchedLikes = $statementPost->fetchAll();

            if (!empty($fetchedLikes)) {
                foreach ($fetchedLikes as $fetchedLike) {
                    array_push($likes, $fetchedLike['username']);
                }
            }
            $newPost = new Post($post['username'], $post['profilePic'], $post['image'], $post['description'], $post['time_posted'], $comments, $post['id']);
            array_push($fullPosts,array("username" => $newPost->getUsername(), "profilePic" =>  $newPost->getProfilePic(), "image" => $newPost->getImage(), "description" => $newPost->getDescription(), "time_posted" => $newPost->time_posted, "comments" => $comments, "likes" => $likes, "id" => $newPost->getPostId()));
            $comments = array();
            $likes = array();
//            var_dump($fullPosts);
        }
        return $fullPosts;

    }

    public static function searchUser($search) : array
    {
        $conn = Db::getConnection();
        $statementUser = $conn->prepare("select * from `users` where `username` like :search;");
        $statementUser->bindValue(':search', '%'.$search.'%');
        $statementUser->execute();
        $users = $statementUser->fetchAll();

        foreach ($users as $user) {
            $statementPost = $conn->prepare("SELECT users.username, comments.description, comments.time_comment FROM comments JOIN users on users.id = comments.user_id WHERE comments.post_id = :post_id");
            $statementPost->bindValue(":post_id", $user['id']);
            $statementPost->execute();
        }
        return $users;
    }

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     */
    public function setSearch($search): void
    {
        $this->search = $search;
    }

}