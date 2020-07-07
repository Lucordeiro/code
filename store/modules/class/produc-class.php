<?php

    require_once '../dao/product-dao.php';

    class product {

        private $id;
        private $name;
        private $categorie;
        private $description;
        private $price;
        private $photo;
        private $photo_b;
        private $photo_c;
        private $amount;

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
       
        public function setCategorie($categorie){
            $this->categorie = $categorie;
        }
        public function getCategorie(){
            return $this->categorie;
        }     
        public function setDescripton($descripton){
            $this->descripton = $descripton;
        }
        public function getDescripton(){
            return $this->descripton;
        }
        public function setPrice($price){
            $this->price = $price;
        }
        public function getPrice(){
            return $this->price;
        }     
        public function setPhoto($photo){
            $this->photo = $photo;
        }
        public function getPhoto(){
            return $this->photo;
        }
        public function setPhoto_b($photo_b){
            $this->photo_b = $photo_b;
        }
        public function getPhoto_b(){
            return $this->photo_b;
        }
        public function setPhoto_c($photo_c){
            $this->photo_c = $photo_c;
        }
        public function getPhoto_c(){
            return $this->photo_c;
        }
        public function setAmount($amount){
            $this->amount = $amount;
        }
        public function getAmount(){
            return $this->amount;
        }


        public function lista(){
            
            $obj = new daoProduct();
            return $obj->lista();

        }
        public function insert(){
            $data = array("name" => $this->getName(), "categorie" => $this->getCategorie(), "description" => $this->getDescripton(), "price" => $this->getPrice(), "photo" => $this->getPhoto(), "photo_b" => $this->getPhoto_b(), "photo_c" => $this->getPhoto_c(), "amount" => $this->getAmount());
            $obj = new daoProduct();
            return $obj->insert($data);

        }
        public function change(){
            $data = array("name" => $this->getName(), "categorie" => $this->getCategorie(), "description" => $this->getDescripton(), "price" => $this->getPrice(), "photo" => $this->getPhoto(), "photo_b" => $this->getPhoto_b(), "photo_c" => $this->getPhoto_c(), "amount" => $this->getAmount());       
            $obj = new daoProduct();
            return $obj->change($data);

        }
        public function drop(){

            $obj = new daoProduct();
            return $obj->drop();

        }
    }

?>