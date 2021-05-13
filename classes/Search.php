<?php
include_once (__DIR__ . "/Db.php");

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
        $st = $conn->prepare("select * from users where username like :search;");

        $search = $this->getSearch();

        $statement->bindValue(':search', '%'.$search.'%');
        $st->bindValue(':search', '%'.$search.'%');

        $statement->execute();
        $st->execute();

        while ($result = $st->fetch(PDO::FETCH_OBJ)){
            echo $result->username;
            echo "<br>";
        }

        while ($result = $statement->fetch(PDO::FETCH_OBJ)){
            echo $result->description;
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