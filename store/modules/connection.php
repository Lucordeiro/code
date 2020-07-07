<?php
    class connection{
        
        private $host = "localhost";
        private $user = "user";
        private $pass = "pass";
        private $db = "store";
        private $instance = NULL;

        public function __construct(){
            //return $this->getInstance();
        }
        public function getInstance(){
            try{
               /*$PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );*/
                $this->instance = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);

            }catch(PDOException $e){
                echo 'Erro ao instanciar o banco de dados: ' . $e->getMessage();
            }
         return $this->instance;   
        }
    }   
?>
