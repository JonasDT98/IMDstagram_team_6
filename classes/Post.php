<?php
include_once(__DIR__ . "/Db.php");

class Post
{
    private $image;
    private $description;
    private $tags;
    private $liked;

    public static function showPosts()
    {

        $conn = Db::getConnection();
        $query = $conn->query("SELECT post.id, users.username, post.image, post.description, post.time_posted FROM post JOIN users on users.id = post.user_id ORDER BY post.time_posted DESC LIMIT 20");
        $posts = $query->fetchAll();
//        $fullPosts = array();
//        $comments = array();
//        $likes = array();
//        foreach ($posts as $post) {
//            $query = $conn->prepare("SELECT users.username, post.id, comments.description FROM comments JOIN users on users.id = comments.user_id JOIN post on post.id = comments.post_id WHERE comments.post_id = :post_id");
//            $query->bindValue(":post_id", $post['id']);
//            $query->execute();
//            $fetchedComments = $query->fetchAll();
//            if (!empty($fetchedComments)) {
//                foreach ($fetchedComments as $fetchedComment) {
//                    array_push($comments, $fetchedComment['description']);
//                }
//            }
//
//            array_push($fullPosts, $post['username'], $post['image'], $post['description'], $post['time_posted'], $fetchedComments['description']);
//            var_dump($fullPosts);
//            $comments = array();
//        }
        return $posts;
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

    /**
     * @return mixed
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * @param mixed $liked
     */
    public function setLiked($liked): void
    {
        $this->liked = $liked;
    }


}