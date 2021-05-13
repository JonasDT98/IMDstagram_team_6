<?php
include_once (__DIR__ . "/Db.php");
include_once (__DIR__ . "/Post.php");

class Search{
    private $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function search(){
        //https://stackoverflow.com/questions/18877098/pdo-search-database-using-like/18877158

        $conn = Db::getConnection();

        $statement = $conn->prepare("select * from `post` where `description` like :search;");
        $st = $conn->prepare("select * from `users` where `username` like :search;");

        $search = $this->getSearch();
        $statement->bindValue(':search', '%'.$search.'%');
        $st->bindValue(':search', '%'.$search.'%');

        $statement->execute();
        $st->execute();

        while ($result = $st->fetch(PDO:: FETCH_OBJ)){
            echo $result->username . " ";
            echo $result->email . " ";
            echo $result->fullname . " ";
            echo $result->profilePic;
            echo "<br>";
        }

        while ($result = $statement->fetch(PDO::FETCH_OBJ)){
            echo $result->description;
            echo "<br>";
        }

    }

    public static function showPosts()
    {

        $conn = Db::getConnection();
        $query = $conn->query("SELECT post.id, users.username, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id where `username` like :search");
        $posts = $query->fetchAll();
        $fullPosts = array();
        $comments = array();
        $likes = array();
        foreach ($posts as $post) {
            $query = $conn->prepare("SELECT users.username, comments.description FROM comments JOIN users on users.id = comments.user_id WHERE comments.post_id = :post_id");
            $query->bindValue(":post_id", $post['id']);
            $query->execute();
            $fetchedComments = $query->fetchAll();

            if (!empty($fetchedComments)) {
                foreach ($fetchedComments as $fetchedComment) {
                    array_push($comments, array("username" => $fetchedComment['username'], "comment" => $fetchedComment['description']));

                }
            }

            $query = $conn->prepare("SELECT users.username FROM likes JOIN users on users.id = likes.user_id WHERE likes.post_id = :post_id");
            $query->bindValue(":post_id", $post['id']);
            $query->execute();
            $fetchedlikes = $query->fetchAll();

            if (!empty($fetchedlikes)) {
                foreach ($fetchedlikes as $fetchedlike) {
                    array_push($likes, $fetchedlikes['username']);
                }
            }

            array_push($fullPosts, new Post($post['username'], $post['image'], $post['description'], $post['time_posted'], $comments, $likes));
            $comments = array();
            $likes = array();
        }
        return $fullPosts;
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