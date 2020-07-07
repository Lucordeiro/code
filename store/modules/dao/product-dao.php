<?php
    require_once __DIR__.'/../connection.php';
    class daoProduct{
        public function lista(){
            
            $obj = new connection();
            $PDO = $obj->getInstance();    
            
            $sql = "SELECT id, nome, categoria, descricao, preco, foto, foto_b, foto_c, quant  FROM produtos ";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
                
        }
        public function search($id){

            $obj = new connection();
            $PDO = $obj->getInstance();    
            
            $sql = "SELECT id, nome, categoria,descricao,preco, foto, foto_b, foto_c, quant FROM produtos WHERE id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        
        public function insert($name,$email,$pass){
                
            $obj = new connection();
            $PDO = $obj->getInstance();    
            //$PDO = self::connection;
            
            $sql = "INSERT INTO produtos(nome, categoria, descricao, preco, foto, foto_b, foto_c, quant) 
                    VALUES(:name, :categorie, :description, :price, :photo, :photo_b, :photo_c, :amount)";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':photo_b', $photo_b); 
            $stmt->bindParam(':photo_c', $photo_c);
            $stmt->bindParam(':amount', $amount);
                        
            if ($stmt->execute())
            {
                return 0;
            }
            else
            {		
                return 1;
            }
            
        }
      
        public function change(){

        }
        public function drop($id){

            $obj = new connection();
            $PDO = $obj->getInstance();    
            //$PDO = self::connection;
            
            $sql = "DELETE FROM produtos WHERE id = :id";
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