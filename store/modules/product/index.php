<?php

$post = isset($_POST['data']) ? $_POST['data'] : '';

var_dump($post)
   // require_once __DIR__."/../class/product-class.php";

    /*
    {
        "action" : "",
        "token" : "",
        "userID": "",
        "auth" : {data}
    }
    */
    /*
    $token = "asToplakmnhytpuyTEbncindhdbdgjsojgdetaawdx";
    
    $post = isset($_POST['data']) ? $_POST['data'] : '';
    $data = json_decode($post);
    
    switch($data->action){
    
        case "lista":
                
            $lista = lista();
            header('Content-Type: application/json');
            echo json_encode($lista);
            break;
        
        case "search":

            $product = search($data->id);
            header('Content-Type: application/json');
            echo json_encode($product);
            break;

        case "insert":
            
            session_start();
            $session_token = $_SESSION['data']['token'];
            $session_status = $_SESSION['data']['user_status'];
            $session_name = $_SESSION['data']['name'];
            
            if($data->token == $session_token && $session_status == "root"){

                $result = array("status" => "0","message" => "Inserido!!");
                echo "chegou aqui chefe";
               */ /*$file = upload();
                
                $register = insert($data->auth);       
                if($register == 0 || $register == 1){
                    $result = array("status" => $register);
                    
                }else{
                    $result = array("status"=>"2","message"=>"Erro entre em contato com o administrador!");
                }*//*
                
            }else{
                $result = array("status"=>"1","message"=>"O senhor nao possui permissão para adicionar produtos!");

            }    
            header('Content-Type: application/json');
            echo (json_encode($result));
                
            break;

        case "change":
            $change = change($data->auth);

        case "drop":

            $product = drop($data->id);
            header('Content-Type: application/json');
            echo json_encode($product);
            break;
    
        default:
            $response = array("status"=>"1","message"=>"Nada informado!");
            header('Content-Type: application/json');
            echo json_encode($response);
            break;
    }
    function upload($file){
        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = '../../user/assets/images';
        
        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
        
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'png', 'gif','jpeg');
        
        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = true;
        
        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        
        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
            exit; // Para a execução do script
        }
        
        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo
        $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
        if (array_search($extensao, $_UP['extensoes']) === false) {
            echo "Por favor, envie arquivos com as seguintes extensões: pdf,jpg, png ou gif";
        }
        
        // Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
            echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        }
        
        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        else {
        // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = time().'.'.$extensao.'';
            
            } else {
                // Mantém o nome original do arquivo
                $nome_final = $_FILES['arquivo']['name'];
            }
        
            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
                echo "Upload efetuado com sucesso!";
                echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
            } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "Não foi possível enviar o arquivo, tente novamente";
            }
            
        }

    }
        
    function lista(){
        $obj = new product();
        return $obj->lista();
        
    }
    function search($data){
        $obj = new product();
        $obj->setId($data);
        return $obj->search();
        
        
    }

    //functions require admin privilegies
    function insert($data){
        $obj = new product();
        $obj->setName($data->name);
        $obj->setEmail($data->email);
        $obj->setPass($data->pass);
        return $obj->insert();
    }

    function change($data){
        $obj = new product();
        $obj->setName($data->name);
        $obj->setEmail($data->email);
        $obj->setPass($data->pass);
        return $obj->change();
    }
    function drop($data){
        $obj = new product();
        $obj->setId($data->id);
        return $obj->drop();
    }

    
?>*/