<?php
include_once (__DIR__ . "/Db.php");

class Search{
    private $search;

    public function __construct($search)
    {
        $this->search = $search;
        var_dump($search);
    }

    public function search(){
        //https://stackoverflow.com/questions/18877098/pdo-search-database-using-like/18877158

        var_dump($this->getSearch());

        $conn = Db::getConnection();

        $statement = $conn->prepare("select * from `post` where `description` like :search;");

        $search = $this->getSearch();

        $statement->bindValue(':search', '%'.$search.'%');

        $statement->execute();

        while ($result = $statement->fetch(PDO::FETCH_OBJ)){
            echo $result->description;
            echo "<br>";
        }


//        $st = $conn->prepare("select * from users where username like '%".getsearch()."%'");
//        $st->setFetchMode(PDO:: FETCH_OBJ);
//        $st->execute();

//        while ($result = $st->fetch()){
//            echo $result->username;
//            echo "<br>";
//        }

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