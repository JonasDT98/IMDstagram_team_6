<?php
    include_once (__DIR__ . "/Db.php");

    class User{
        private $email;
        private $fullname;
        private $username;
        private $password;
        public $id;

        /**
         * User constructor.
         * @param $email
         * @param $fullname
         * @param $username
         * @param $password
         */
        public function __construct($email, $fullname, $username, $password)
        {
            $this->email = $email;
            $this->fullname = $fullname;
            $this->username = $username;
            $this->password = $password;
        }

        public function save(){
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

        static function updateUser($oUsername, $username, $email, $nPassword, $fullname)
        {
            $conn = db::getConnection();
            $statement = $conn->prepare("UPDATE users SET username=:username,email=:email,password=:password,fullname=:fullname WHERE username=:oUsername");
            $statement->bindParam(':oUsername', $oUsername, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $nPassword, PDO::PARAM_STR);
            $result = $statement->execute();
            var_dump($result);
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
            $this->password =  password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        }


        /**
         * @return mixed
         */
        public static function getId($username)
        {
            $conn = db::getConnection();
            $query = $conn->prepare("SELECT id from users where username = :username");
            $query->bindValue(":username", $username);
            $query->execute();
            $userId = $query->fetch();
            return $userId;
        }

        public static function getUser($username){
            $conn = db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $statement->bindValue(':username', $username);
            $statement->execute();
            $result = $statement->fetch();
            return new User($result['email'], $result['fullname'], $result['username'], $result['password']);
        }
    }
