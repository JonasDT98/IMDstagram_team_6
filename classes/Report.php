<?php
include_once(__DIR__ . "/Db.php");

class Report
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

    public function saveReport() {
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into reports (post_id, user_id) values (:postId, :userId)");

        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);

        $query->execute();
    }
    public function deleteReport() {
        $conn = Db::getConnection();
        $query = $conn->prepare("DELETE FROM reports WHERE post_id =:postId AND user_id=:userId");

        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);
        $query->execute();
    }

}