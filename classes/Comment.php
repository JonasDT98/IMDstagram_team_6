<?php
include_once(__DIR__ . "/Db.php");

Class Comment {
    private $user_id;
    private $post_id;
    private $description;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id): void
    {
        $this->post_id = $post_id;
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

    public function save() {
        $conn = Db::getConnection();
        $query = $conn->prepare("insert into comments (description, postId, userId) values (:description, :postId, :userId)");

        $description = $this->getDescription();
        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":description", $description);
        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);

        $result = $query->execute();
        return $result;
    }

}