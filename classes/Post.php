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
    private $postId;
    private $profilePic;

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

                $statement = $conn->prepare("insert into post (title, description, image, user_id) values (:title, :description, :image, :user_id)");

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

    public function __construct($username, $profilePic, $image, $description, $time_posted, $comments, $likes, $postId)
    {
        $this->setUsername($username);
        $this->setImage($image);
        $this->setDescription($description);
        $this->setComments($comments);
        $this->setTimePosted($time_posted);
        $this->setLikes($likes);
        $this->setPostId($postId);
        $this->setProfilePic($profilePic);
    }



    public static function profileData($username) {
        $conn = Db::getConnection();
        $query = $conn->prepare("Select users.username, users.profilePic, users.bio, post.image, post.description FROM post JOIN users ON users.id = post.user_id WHERE users.username = :username ORDER BY post.time_posted DESC LIMIT 9");
        $query->bindValue(":username", $username);
        $query->execute();
        $fetchedProfile = $query->fetchAll();
        return $fetchedProfile;
    }

    public static function showFirstPosts($amount): array
    {

            $conn = Db::getConnection();
            $query = $conn->prepare("SELECT post.id, users.username, users.profilePic, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id WHERE post.id BETWEEN :amount1 AND :amount2 ORDER BY post.time_posted DESC LIMIT 20");
            $query->bindValue(":amount1", $amount-19);
            $query->bindValue(":amount2", $amount);
            $query->execute();
            $posts = $query->fetchAll();
            $fullPosts = array();
            $comments = array();
            $likes = array();
            foreach ($posts as $post) {
                $query = $conn->prepare("SELECT users.username, comments.description, comments.time_comment FROM comments JOIN users on users.id = comments.user_id WHERE comments.post_id = :post_id");
                $query->bindValue(":post_id", $post['id']);
                $query->execute();
                $fetchedComments = $query->fetchAll();

                if (!empty($fetchedComments)) {
                    foreach ($fetchedComments as $fetchedComment) {
                        array_push($comments, array("username" => $fetchedComment['username'], "comment" => $fetchedComment['description'], "time" => $fetchedComment['time_comment']));
                    }
                }

                $query = $conn->prepare("SELECT users.username FROM likes JOIN users on users.id = likes.user_id WHERE likes.post_id = :post_id");
                $query->bindValue(":post_id", $post['id']);
                $query->execute();
                $fetchedLikes = $query->fetchAll();

                if (!empty($fetchedLikes)) {
                    foreach ($fetchedLikes as $fetchedLike) {
                        array_push($likes, $fetchedLike['username']);
                    }
                }

                array_push($fullPosts, new Post($post['username'], $post['profilePic'], $post['image'], $post['description'], $post['time_posted'], $comments, $likes, $post['id']));
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

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }
  
      /**
     * @return mixed
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic($profilePic): void
    {
        $this->profilePic = $profilePic;
    }
  
  
    public static function isLiked($userId, $postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM likes WHERE user_id =:userId AND post_id =:postId");
        $query->bindValue(":userId", $userId);
        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetchAll();
        if($result != NULL){
            return true;
        }
        else{
            return false;
        }
    }
    public static function getAmountOfLikes($postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT post_id FROM likes WHERE post_id = :postId");
        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);
    }
  
}