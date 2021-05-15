<?php
include_once (__DIR__ . "/Db.php");
//include_once (__DIR__ . "/Post.php");

class Search{
    private $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function search()
    {
        //https://stackoverflow.com/questions/18877098/pdo-search-database-using-like/18877158
        $conn = Db::getConnection();

        $statementPost =$conn->prepare("SELECT post.id, users.username, users.profilePic, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id where `description` like :search;");
        $statementUser = $conn->prepare("select * from `users` where `username` like :search;");

        $search = $this->getSearch();
        $statementPost->bindValue(':search', '%'.$search.'%');
        $statementUser->bindValue(':search', '%'.$search.'%');

        $statementPost->execute();
        $statementUser->execute();

        $fullPosts = array();
        $comments = array();
        $likes = array();

        var_dump($statementPost->fetchAll());

        while ($result = $statementUser->fetch(PDO:: FETCH_OBJ)) {
            echo $result->username . " ";
            echo $result->email . " ";
            echo $result->fullname . " ";
            echo $result->profilePic;
            echo "<br>";

        }

        while ($result = $statementPost->fetch(PDO::FETCH_OBJ)){

            echo $result->description . " ";
            echo $result->id;
            echo "<br>";

        }

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