<?php
include_once(__DIR__ . "/Db.php");

class Like
{
    private $postId;
    private $userId;



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

    public function saveLike() {
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into likes (post_id, user_id) values (:postId, :userId)");

        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);

        $query->execute();

        $query2 = $conn->prepare("SELECT post_id FROM likes WHERE user_id =:userId");
        $query2->bindValue(":userId", 1);
        $query2->execute();
        $result = $query->fetchAll();
        $result = implode('',array_column($result, 'post_id'));
        $result = str_split($result, 1);
        if(count(array_unique($result)) < count($result)){
            return false;
        }
        else{
            return true;
        }
    }
    public function unsaveLike() {
        $conn = Db::getConnection();
        $query = $conn->prepare("DELETE FROM likes WHERE post_id =:postId AND user_id=:userId");

        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);

        $result = $query->execute();

        return $result;
    }
    public static function getAmountOfLikes($postId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT post_id FROM likes WHERE post_id = :postId");

        $query->bindValue(":postId", $postId);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);
    }
    public function isLiked($userId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT post_id FROM likes WHERE user_id =:userId");
        $query->bindValue(":userId", $userId);
        $query->execute();
        $result = $query->fetchAll();
        $result = implode('',array_column($result, 'post_id'));
        $result = str_split($result, 1);
        if(count(array_unique($result)) < count($result)){
            return false;
        }
        else{
            return true;
        }
    }
}