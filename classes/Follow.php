<?php


include_once(__DIR__ . "/db.php");

class Follow
{
    private $followedId;
    private $userId;


    /**
     * @return mixed
     */
    public function getFollowedId()
    {
        return $this->followedId;
    }


    public function setFollowedId($followedId): void
    {
        $this->followedId = $followedId;
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

    public function saveFollow()
    {
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into follows (followed_id, user_id) values (:followedId, :userId)");

        $followedId = $this->getFollowedId();
        $userId = $this->getUserId();

        $query->bindValue(":followedId", $followedId);
        $query->bindValue(":userId", $userId);
        $query->execute();
    }

    public function deleteFollow()
    {
        $conn = Db::getConnection();
        $query = $conn->prepare("DELETE FROM follows WHERE followed_id =:followedId AND user_id=:userId");

        $followedId = $this->getFollowedId();
        $userId = $this->getUserId();

        $query->bindValue(":followedId", $followedId);
        $query->bindValue(":userId", $userId);
        $query->execute();
    }

}