<?php
include_once (__DIR__ . "/Db.php");

class Post{

    private $description;
    private $username;
    private $image;
    private $likes;
    private $comments;
    public $time_posted;
    private $postId;
    private $profilePic;
    private $postsAmount;
    private $userId;
    private $timesReported;
    private $hidden = false;

    public function __construct($username, $profilePic, $image, $description, $time_posted, $comments, $postId)
    {
        $this->setUsername($username);
        $this->setImage($image);
        $this->setDescription($description);
        $this->setComments($comments);
        $this->setTimePosted($time_posted);
        $this->setPostId($postId);
        $this->setProfilePic($profilePic);
    }

    public function post($userId, $filename, $imageFileType): bool
    {

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        } else {
            if ($_FILES["image"]["size"] > 700000) {
            } else {
                $fileName = $filename;
                $tempname = $_FILES["image"]["tmp_name"];
                $folder = "images/upload/" . $fileName;
                move_uploaded_file($tempname, $folder);
                $conn = Db::getConnection();

                $statement = $conn->prepare("insert into post (description, image, user_id) values (:description, :image, :user_id)");

                $description = $this->getDescription();
                $image = $this->getImage();

                $statement->bindValue(":description", $description);
                $statement->bindValue(":image", $image);
                $statement->bindValue(":user_id", $userId);

                $result = $statement->execute();
                return $result;
            }
        }
    }

    public static function profilePosts($username) {
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT post.id, post.image, post.description FROM post JOIN users ON users.id = post.user_id WHERE users.username = :username ORDER BY post.time_posted");
        $query->bindValue(":username", $username);
        $query->execute();
        $fetchedProfile = $query->fetchAll();
        return $fetchedProfile;
    }

    public static function deletePost($postId, $image){
//        unlink("images/upload/" . $this->getProfilePic());
//            echo $postId,  $image;
        unlink("images/upload/" . $image);
        $conn = Db::getConnection();
        $statement = $conn->prepare("DELETE FROM post WHERE post.id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public static function showPosts($offset): array
    {
            $conn = Db::getConnection();
            $query = $conn->prepare("SELECT post.id, users.username, users.profilePic, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id ORDER BY post.time_posted DESC LIMIT 20 OFFSET $offset");
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
                        $time = Comment::showTime($fetchedComment['time_comment']);
                        array_push($comments, array("username" => $fetchedComment['username'], "comment" => $fetchedComment['description'], "time" => $time));
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
                $newPost = new Post($post['username'], $post['profilePic'], $post['image'], $post['description'], $post['time_posted'], $comments, $post['id']);
                array_push($fullPosts,array("username" => $newPost->getUsername(), "profilePic" =>  $newPost->getProfilePic(), "image" => $newPost->getImage(), "description" => $newPost->getDescription(), "time_posted" => Comment::showTime($newPost->time_posted), "comments" => $comments, "id" => $newPost->getPostId()));
                $comments = array();
                $likes = array();
            }
            return $fullPosts;
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

    public static function isHidden($postId)
    {
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT hidden FROM post WHERE id = :postId");
        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetch();
        return $result['0'];
    }
  
      public static function isReported($userId, $postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM reports  WHERE user_id =:userId AND post_id =:postId");
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
    public static function getAmountOfReports($postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT post_id FROM reports WHERE post_id = :postId");
        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);

    }
  
   /**
     * @param $postId
     */
    public static function setHidden($hidden, $postId)
    {
        $conn = Db::getConnection();
        $query = $conn->prepare("update post set hidden = :hidden where id = :postId");
        $query->bindValue(":hidden", $hidden);
        $query->bindValue(":postId", $postId);
        $query->execute();
    }

    public static function getPostById($postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("select * from post where id = :postId");
        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
//        return new Post($result['username'], $result['profilePic'], $result['image'], $result['description'], $result['time_posted'], $result['comments'], $result['postId']);
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
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

    /**
     * @return mixed
     */
    public function getPostsAmount()
    {
        return $this->postsAmount;
    }

    /**
     * @param mixed $postsAmount
     */
    public function setPostsAmount($postsAmount): void
    {
        $this->postsAmount = $postsAmount;
    }


    public function report($postId){
        $report = $this->timesReported;
        $report = $report + 1;
        $this->timesReported = $report;
        echo $report;
        $conn = Db::getConnection();
        $query = $conn->prepare("UPDATE post SET reports =:report WHERE id =:postId");
        $query->bindValue(":report", $report);
        $query->bindValue(":postId", $postId);
        $query->execute();
        if($report >= 3){
            $this->hidden = true;
        }
    }
    public function getReports($postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT reports FROM post WHERE post_id = :postId");

        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetch();
        echo $result;
    }
}