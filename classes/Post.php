<?php

include_once (__DIR__ . "/Db.php");

class Post{

    private $title;
    private $description;
    private $username;
    private $image;
    private $likes;
    private $comments;
    private $time_posted;

    public function post()
    {

        $target_file = "images/upload/" . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Ga niet aahja moet ne jpg, jpeg of png zen";
            $error = "Ga niet aahja moet ne jpg, jpeg of png zen";
        } else {
            if ($_FILES["image"]["size"] > 500000) {
                echo "das te zwaar he pipo";
                $error = "das te zwaar he pipo";
            } else {
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];
                $folder = "images/upload/" . $filename;
                move_uploaded_file($tempname, $folder);

                $conn = Db::getConnection();

                $statement = $conn->prepare("insert into post (title, description, image) values (:title, :description, :image)");

                //user_id
                $title = $this->getTitle();
                $description = $this->getDescription();
                $image = $this->getImage();

                $statement->bindValue(":title", $title);
                $statement->bindValue(":description", $description);
                $statement->bindValue(":image", $image);

                $result = $statement->execute();
                return $result;
            }
        }
        return $error;

    }

    public function __construct($username, $image, $description, $time_posted, $comments, $likes)
    {
        $this->setUsername($username);
        $this->setImage($image);
        $this->setDescription($description);
        $this->setComments($comments);
        $this->setTimePosted($time_posted);
        $this->setLikes($likes);
    }

    public static function profileData($username) {
        $conn = Db::getConnection();
        $query = $conn->prepare("Select users.username, post.image, post.description FROM post JOIN users ON users.id = post.user_id WHERE users.username = :username ORDER BY post.time_posted DESC LIMIT 9");
        $query->bindValue(":username", $username);
        $query->execute();
        $fetchedProfile = $query->fetchAll();
        return $fetchedProfile;
    }

    public static function showPosts()
        {

            $conn = Db::getConnection();
            $query = $conn->query("SELECT post.id, users.username, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id ORDER BY post.time_posted DESC LIMIT 20");
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

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
        {
            $this->title = $title;
        }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;

    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
      
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }
      
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes(array $likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;

    }

    /**
     * @return mixed
     */

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }


    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getTimePosted()
    {
        return $this->time_posted;
    }

    /**
     * @param mixed $time_posted
     */
    public function setTimePosted($time_posted): void
    {
        $this->time_posted = $time_posted;
    }

}