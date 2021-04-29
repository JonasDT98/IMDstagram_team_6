<?php
include_once(__DIR__ . "/Db.php");

class Post
{
    private $username;
    private $image;
    private $description;
    private $likes;
    private $comments;
    private $time_posted;

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