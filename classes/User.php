<?php
include_once (__DIR__ . "/Db.php");

class User{
    private $email;
    private $fullname;
    private $username;
    private $password;
    private $profilePic;
    private $bio;


    /**
     * User constructor.
     * @param $email
     * @param $fullname
     * @param $username
     * @param $password
     */
    public function __construct($email, $fullname, $username, $password, $profilePic='default.jpg', $bio= NULL)
    {
        $this->setEmail($email);
        $this->setFullname($fullname);
        $this->setUsername($username);
        $this->password = $password;
        $this->profilePic = $profilePic;
        $this->bio = $bio;
    }

    public function save(): bool
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into users (fullname, username, email, password) values (:fullname, :username, :email, :password)");

        $fullname = $this->getFullname();
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $statement->bindValue(":fullname", $fullname);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);

        $result = $statement->execute();
        return $result;

    }

    //canlogin comes here
    static function canLogin($username, $password) //naar klasse verplaatsen
    {
        $conn = db::getConnection();
        $statement = $conn->prepare("select * from users where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $user = $statement->fetch();
        if (!$user){
            return false;
        }
        $hash = $user["password"];
        if(password_verify($password, $hash)){
            return true;
        }else{
            return false;
        }
    }

    static function updateUser($oUsername, $username, $email, $nPassword, $fullname, $bio): void
    {
        $conn = db::getConnection();
        $statement = $conn->prepare("UPDATE users SET username=:username,email=:email,password=:password,fullname=:fullname, bio =:bio WHERE username=:oUsername");
        $statement->bindParam(':oUsername', $oUsername, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $nPassword, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->execute();

    }

    public static function getId($username)
    {
        $conn = db::getConnection();
        $query = $conn->prepare("SELECT id from users where username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
        $userId = $query->fetch();
        return $userId[0];
    }

    public static function getImage($username)
    {
        $conn = db::getConnection();
        $query = $conn->prepare("SELECT profilePic from users where username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
        $profilePic = $query->fetch();
        return $profilePic;
    }

    public function setProfilePic($profilePic, $username, $imageFileType): bool
    {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        } else {
            if ($_FILES["image"]["size"] > 700000) {
            } else {
                $fileName = $profilePic;
                $tempname = $_FILES["image"]["tmp_name"];
                $folder = "images/profilePics/" . $fileName;
                move_uploaded_file($tempname, $folder);

                $conn = Db::getConnection();

                $statement = $conn->prepare("update users set profilePic = :profilePic where username = :username");

                $statement->bindValue(":profilePic", $profilePic);
                $statement->bindValue(":username", $username);
                $result = $statement->execute();
                return $result;
//                $this->profilePic = $profilePic;
            }
        }
    }

    public function delete($username){
//        unlink($_FILES['image']['name']);
        if ($this->getProfilePic() != "default.jpg") {
            unlink("images/profilePics/" . $this->getProfilePic());
        }
        $conn = Db::getConnection();
        $statement = $conn->prepare("update users set profilePic = :profilePic where username = :username");
        $statement->bindValue(":username", $username);
        $statement->bindValue(":profilePic", "default.jpg");
        $statement->execute();
//        $this->profilePic = NULL;
    }

    public static function getUser($username): User
    {
        $conn = db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        return new User($result['email'], $result['fullname'], $result['username'], $result['password'], $result['profilePic'], $result['bio']);
    }

    public static function getProfileData($username) {
        $conn = db::getConnection();
        $statement = $conn->prepare("SELECT username, bio, profilePic FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    public static function isFollowed($userId, $followedId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM follows WHERE user_id =:userId AND followed_id =:followedId");
        $query->bindValue(":userId", $userId);
        $query->bindValue(":followedId", $followedId);
        $query->execute();
        $result = $query->fetchAll();
        if($result != NULL)
        {
            return true;
        }
        else{
            return false;
        }
    }
    public static function getAmountOfFollowers($followedId){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT user_id FROM follows WHERE followed_id = :followedId");
        $query->bindValue(":followedId", $followedId);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $options = [
            'cost' => 12,
        ];
        $this->password =  password_hash($password, PASSWORD_DEFAULT, $options);
    }

        /**
         * @return mixed
         */

    /**
     * @return mixed
     */

    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * @param mixed|null $profilePic
     */
    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->bio = $bio;
    }


}