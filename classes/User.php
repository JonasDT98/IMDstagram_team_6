<?php

    include_once (__DIR__ . "/Db.php");

    class User{
        private $email;
        private $fullname;
        private $username;
        private $password;

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
            $this->password = $password;
        }
    }