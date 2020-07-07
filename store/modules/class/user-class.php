<?php
    require_once '../dao/user-dao.php';
    class user {
        
        private $id;
        private $name;
        private $email;
        private $pass;
        private $date;
        private $status;
        private $phone;
        private $address = array();

        public function __construct(){
            //
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }     
        public function setName($name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setPass($pass){
            $this->pass = $pass;
        }
        public function getPass(){
            return $this->pass;
        }     
        public function setPhone($phone){
            $this->phone = $phone;
        }
        public function getPhone(){
            return $this->phone;
        }
        public function setAdress($address){
            $this->address = $address;
        }
        public function getAdress(){
            return $this->address;
        }
        public function setCpf($address){
            $this->address = $address;
        }
        public function getCpf(){
            return $this->address;
        }
        

        public function authenticate(){
            
            $obj = new daoUser();
            return $obj->authenticate($this->getEmail(), $this->getPass());
            
        }
        public function recover(){
            
            $obj = new daoUser();
            return $obj->recover($this->getName(), $this->getEmail(), $this->getPass());

        }
        public function lista(){
            
            $obj = new daoUser();
            return $obj->lista();

        }
        public function search(){
            
            $obj = new daoUser();
            return $obj->search($this->getId());

        }
        public function complete(){
            
            $obj = new daoUser();
            return $obj->complete($this->getName(), $this->getEmail(), $this->getPass());

        }
        public function insert(){
            
            $obj = new daoUser();
            return $obj->insert($this->getName(), $this->getEmail(), $this->getPass());

        }
        public function change(){
            
            $obj = new daoUser();
            return $obj->change($this->getName(), $this->getEmail(), $this->getPass());

        }
        public function drop(){
            
            $obj = new daoUser();
            return $obj->drop($this->getId());

        }
        
            

    }
?>