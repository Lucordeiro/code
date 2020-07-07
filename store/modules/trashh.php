<?php
    class UploadImagem{
        public $width; // Definida no arquivo index.php, será a largura máxima da nossa imagem
        public $height; // Definida no arquivo index.php, será a altura máxima da nossa imagem
        protected $tipos = array("jpeg", "png", "gif"); // Nossos tipos de imagem disponíveis para este exemplo
        
        // Função que irá redimensionar nossa imagem
        protected function redimensionar($caminho, $nomearquivo){
            // Determina as novas dimensões
            $width = $this->width;
            $height = $this->height;
    
            // Pegamos a largura e altura originais, além do tipo de imagem
            list($width_orig, $height_orig, $tipo, $atributo) = 
            getimagesize($caminho.$nomearquivo);
            
            // Se largura é maior que altura, dividimos a largura determinada pela original e multiplicamos a altura pelo resultado, para manter a proporção da imagem
            if($width_orig > $height_orig){
                $height = ($width/$width_orig)*$height_orig;
                // Se altura é maior que largura, dividimos a altura determinada pela original e multiplicamos a largura pelo resultado, para manter a proporção da imagem
            } elseif($width_orig < $height_orig) {
                $width = ($height/$height_orig)*$width_orig;
            } // -> fim if
            // Criando a imagem com o novo tamanho
            $novaimagem = imagecreatetruecolor($width, $height);
            switch($tipo){
            
            // Se o tipo da imagem for gif
            case 1:
            // Obtém a imagem gif original
            $origem = imagecreatefromgif($caminho.$nomearquivo);
            // Copia a imagem original para a imagem com novo tamanho
            imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, 
            $height, $width_orig, $height_orig);
            // Envia a nova imagem gif para o lugar da antiga
            imagegif($novaimagem, $caminho.$nomearquivo);
            break;
    
            // Se o tipo da imagem for jpg
            case 2:
            // Obtém a imagem jpg original
            $origem = imagecreatefromjpeg($caminho.$nomearquivo);
            // Copia a imagem original para a imagem com novo tamanho
            imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, 
            $height, $width_orig, $height_orig);
            // Envia a nova imagem jpg para o lugar da antiga
            imagejpeg($novaimagem, $caminho.$nomearquivo);
            break;
    
            // Se o tipo da imagem for png
            case 3:
            // Obtém a imagem png original
            $origem = imagecreatefrompng($caminho.$nomearquivo);
            // Copia a imagem original para a imagem com novo tamanho
            imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, 
            $height, $width_orig, $height_orig);
            // Envia a nova imagem png para o lugar da antiga
            imagepng($novaimagem, $caminho.$nomearquivo);
            break;
            } // -> fim switch
            
            // Destrói a imagem nova criada e já salva no lugar da original
            imagedestroy($novaimagem);
            // Destrói a cópia de nossa imagem original
            imagedestroy($origem);
        } // -> fim function redimensionar()
    
    
        // Função que irá fazer o upload da imagem
        public function salvar($caminho, $file){
            
            
            $file['name'] = "teste";
            // Atribuímos caminho e nome da imagem a uma variável apenas
            $uploadfile = $caminho.$file['name'];
            
            // Guardamos na variável tipo o formato do arquivo enviado
            $tipo = strtolower(end(explode('/', $file['type'])));
            // Verifica se a imagem enviada é do tipo jpeg, png ou gif
            if (array_search($tipo, $this->tipos) === false) {
                $mensagem = "<font color='#F00'>Envie apenas imagens no formato jpeg, png ou gif!</font>";
                return $mensagem;
            }
            
            // Se a imagem temporária não for movida para onde a variável com caminho e nome indica, exibiremos uma mensagem de erro
            else if (!move_uploaded_file($file['tmp_name'], $uploadfile)) {
                switch($file['error']){
                    case 1 : 
                        $mensagem = "<font color='#F00'>O tamanho do arquivo é maior que o tamanho permitido.</font>";
                        break;
                    case 2:
                        $mensagem = "<font color='#F00'>O tamanho do arquivo é maior que o tamanho permitido.</font>";
                        break;
                    case 3:
                        $mensagem = "<font color='#F00'>O upload do arquivo foi feito parcialmente.</font>";
                    case 4:
                        $mensagem = "<font color='#F00'>Não foi feito o upload de arquivo.</font>";
                        break;
                }     
           
            } 
            else{
            
            // Pegamos sua largura e altura originais
            list($width_orig, $height_orig) = getimagesize($uploadfile);
            
            //Comparamos sua largura e altura originais com as desejadas
            if($width_orig > $this->width || $height_orig > $this->height){
            
            // Chamamos a função que redimensiona a imagem
            $this->redimensionar($caminho, $file['name']);
            } // -> fim if
            
            // Exibiremos uma mensagem de sucesso
            $mensagem = "<a href='".$uploadfile."'><font color='#070'>Upload 
            realizado com sucesso!</font><a>";
            } // -> fim else
            
            // Retornamos a mensagem com o erro ou sucesso
            return $mensagem;
        
        } 
    } 
?>