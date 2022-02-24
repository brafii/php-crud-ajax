<?php

    class Database{
        private $host="localhost";
        private $username="root";
        private $dbname="php_oop_crud";
        private $password="";
        private $conn;

        public function __construct(){

            try {
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
                return $this->conn;
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }

        }

        public function addUsers($firstname, $lastname, $email, $phone){
            $sql = 'INSERT INTO users (firstname,lastname,email,phone) VALUES (:firstname,:lastname,:email,:phone)';
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':phone' => $phone
            ]);
            return true;
        }

        public function selectRecords(){
            $data = array();
            $sql = 'SELECT * FROM users';
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row){
                $data[] = $row;
            }
            return $data; 
        }


        public function getUserByID($id){
            $sql = 'SELECT * FROM users WHERE id = :id';
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                ':id' => $id,
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function updateUsers($id, $firstname, $lastname, $email, $phone){
            $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone WHERE id = :id';
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':phone' => $phone,
                ':id' => $id,
            ]);
            return true;
        }

        public function deleteRecords($id){
            $sql = 'DELETE FROM users WHERE id = :id';
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                ':id' => $id,
            ]);
            return true;
        }

        public function totalRowCount(){
            $sql = 'SELECT * FROM users';
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $t_rows = $statement->rowCount();

            return $t_rows;
        }



    }


?>