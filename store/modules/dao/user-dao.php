<?php
    
    require_once __DIR__.'/../connection.php';

    class daoUser{
        
        public function authenticate($email,$pass){
            
            $obj = new connection();
            $PDO = $obj->getInstance();    
            
            $sql = "SELECT id, nome, status FROM clientes WHERE email = :email AND senha = :pass";
            $stmt = $PDO->prepare($sql);
            
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $pass);
            
            $stmt->execute();
            
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if (count($user) <= 0)
            {
                return 1;
            }else{
                return $user;
            }
           
            

        }
        public function recover(){}    
        public function lista(){
            
            $obj = new connection();
            $PDO = $obj->getInstance();    

            //$sql = "SELECT *FROM clientes ";           
            $sql = "SELECT  nome, email, status, dat FROM clientes ";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            //$result[] = $stmt->fetch(PDO::FETCH_OBJ);
            $result = array();
            $count = 0;
            while($obj = $stmt->fetch(PDO::FETCH_OBJ)){
                $result[$count] = $obj;
                $count++;
            }
            
            return $result; 
        }
        public function search($id){

            $obj = new connection();
            $PDO = $obj->getInstance();    
            
            $sql = "SELECT id, nome, email FROM clientes WHERE id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        public function complete(){}    
        
        public function insert($name,$email,$pass){
                
            $obj = new connection();
            $PDO = $obj->getInstance();    
            //$PDO = self::connection;
            
            $sql = "INSERT INTO clientes(nome, email, senha, compras, dat,status) VALUES(:name, :email, :pass, 0,date('Y/m/d'), 'incompleto')";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $pass);
            //$stmt->bindParam(':date', date("Y/m/d"));
           // $stmt->bindParam(':status', 'incompleto'); 
            
            if ($stmt->execute())
            {
                return 0;
            }
            else
            {		
                return 1;
            }
            
            
        }
      
        public function change(){}
        public function drop($id){

            $obj = new connection();
            $PDO = $obj->getInstance();    
            //$PDO = self::connection;
            
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if ($stmt->execute())
            {
                return 0;
            }
            else
            {		
                return 1;
            }
        
        }
          
     
    }
?>