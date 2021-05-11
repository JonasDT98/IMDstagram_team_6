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
    }
    public function deleteLike() {
        $conn = Db::getConnection();
        $query = $conn->prepare("DELETE FROM likes WHERE post_id =:postId AND user_id=:userId");

        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);
        $query->execute();
    }

}