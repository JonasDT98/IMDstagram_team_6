<?php
include_once(__DIR__ . "/Db.php");

Class Comment {
    private $user_id;
    private $post_id;
    private $description;
    private $time_comment;

    /**
     * @return mixed
     */
    public function getTimeComment()
    {
        return $this->time_comment;
    }

    /**
     * @param mixed $time_comment
     */
    public function setTimeComment($time_comment): void
    {
        $this->time_comment = $time_comment;
    }

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
        $query = $conn->prepare("insert into comments (description, post_id, user_id) values (:description, :postId, :userId)");

        $description = $this->getDescription();
        $postId = $this->getPostId();
        $userId = $this->getUserId();

        $query->bindValue(":description", $description);
        $query->bindValue(":postId", $postId);
        $query->bindValue(":userId", $userId);

        $result = $query->execute();

        return $result;

    }

    public static function showTime($date) {
        date_default_timezone_set ('Europe/Brussels');

        $time = strtotime($date);

        $time = time() - $time;
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }
}