<?php
    require_once __DIR__."/../class/user-class.php";
    
    /*
    {
        "action" : "",
        "token" : "",
        "appID" : "",
        "data" : {data}
    }
    */
    
    $appID = "asToplakmnhytpuyTEbncindhdbdgjsojgdetaawdx";
    
    $post = isset($_POST['data']) ? $_POST['data'] : '';
    $data = json_decode($post);
    
    switch($data->action){
    
        case "authenticate":
            $authentication = authenticate($data->auth);
            
            if($authentication != NULL){
                
                if($authentication == 1){
                    
                    $result = array("status" => 1 ,"message" => "Usuário ou senha Incorretos"); 
                    
                }else{
                    
                    foreach($authentication as $user){
                        $id = $user->id;
                        $name = $user->nome;
                        $user_status = $user->status;    
                    }
                    if(isset($_SESSION['data'])){
                        session_destroy();
                        session_start();
                        
                    }else{
                        
                        session_start();
                    }
                    $token = token();
                    $_SESSION['data'] = array("id" => $id, "name" => $name, "token" => $token, "user_status" => $user_status);        
                    $result = array("status" => 0, "token" => $token);
                    
                }
                
            }else{
                $result = array("status"=>"2","message"=>"Erro entre em contato com o administrador!");
            }
            
           header('Content-Type: application/json');
           echo (json_encode($result)); 
            
            break;


        case "get":
            session_start();
            $session_token = $_SESSION['data']['token'];
            $session_status = $_SESSION['data']['user_status'];
            $session_name = $_SESSION['data']['name'];
            
            if($data->token == $session_token){
                $result = array("status" => 0, "message" => "Autorizado!","name" => $session_name , "user_status" => $session_status); 
            }else{
                $result = array("status" => 1, "message" => "Nao autorizado!");
            }
            header('Content-Type: application/json');
            echo json_encode($result);
            break;


        case "logout":
            session_start();
            session_destroy();
            $result = array("status"=>"0","message"=>"Todas as sessoes destruídas");
            
            header('Content-Type: application/json');
            echo (json_encode($result));
             
            break;


        case "insert":
            
            $register = insert($data->auth);
                
            header('Content-Type: application/json');
            if($register == 0 || $register == 1){
                $result = array("status" => $register);
                echo (json_encode($result));
            }else{
                $response = array("status"=>"2","message"=>"Erro entre em contato com o administrador!");
                echo json_encode($response);
            }
            
            
            break;


        case "lista":
            
            session_start();
            $session_token = $_SESSION['data']['token'];
            $session_status = $_SESSION['data']['user_status'];
            $session_name = $_SESSION['data']['name'];
            
            if($data->token == $session_token){
                $lista = lista();
                $result = array("status" => 0, "message" => "Lista de usuários", "list"=> $lista); 
            }else{
                $result = array("status" => 1, "message" => "Nao autorizado!");
            }
            header('Content-Type: application/json');
            echo json_encode($result);
            
          break;
        case "search":

            $user = search($data->id);
            header('Content-Type: application/json');
            echo json_encode($user);
            break;

        default:
            $response = array("status"=>"1","message"=>"Nada informado!");
            header('Content-Type: application/json');
            echo json_encode($response);
            break;
    }
    
    //basic functions
    function token(){
        $size = 40;
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $result = "";

        for($count= 0; $size > $count; $count++){
           $result.= $basic[rand(0, strlen($basic) - 1)];
        }

        return $result;
  
    }
    function response($returned){
        
    }


    //methods call
    function authenticate($data){

        $obj = new user();
        $obj->setEmail($data->email);
        $obj->setPass($data->pass);
        return $obj->authenticate();
        
    }
     
    function lista(){
        $obj = new user();
        return $obj->lista();
        
    }

    function search($data){
        $obj = new user();
        $obj->setId($data);
        return $obj->search();
        
        
    }
    
    //functions require admin privilegies
    function recover($data){

    }   
    function complete($data){

    }
    function insert($data){
        $obj = new user();
        $obj->setName($data->name);
        $obj->setEmail($data->email);
        $obj->setPass($data->pass);
        return $obj->insert();
    }
    function change($data){
        $obj = new user();
        $obj->setName($data->name);
        $obj->setEmail($data->email);
        $obj->setPass($data->pass);
        return $obj->change();
    }
    function drop($data){
        $obj->setId($data->id);
        return $obj->drop();
    }

    
        

?>