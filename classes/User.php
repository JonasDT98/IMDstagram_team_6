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
            $id = $this->getId();

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
        static function updateUser($oUsername, $nUsername, $email, $nPassword)
        {
            $conn = db::getConnection();
            $statement = $conn->prepare("UPDATE users SET username = :nUsername, email = :email, password = :password WHERE username = :oUsername");
            $statement->bindParam(':username', $nUsername);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $nPassword);
            $statement->bindParam(':oUsername', $oUsername);
            $result = $statement->execute();
            return $result;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            $conn = db::getConnection();
            $statement = $conn->prepare("SELECT id FROM users WHERE username = '$this->username'");
            $this->id = $statement->execute();
            return $this->id;
        }

        static function getUser($username){
            $conn = db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $statement->bindValue(':username', $username);
            $result = $statement->execute();
            var_dump($result);
            $user = new User($result['email'], $result['fullname'], $result['username'], $result['password']);
            return $user;
        }
    }