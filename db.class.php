<?php 

include 'global.php';

class db{
    //host
        private $host = 'localhost';

    //usuario
        private $usuario = 'root';

    //banco dados
        private $database = 'twitter';

    //senha
        private $senha = '';

        public function conecta_mysql(){
            //criar conexão banco dados
            $conexao = mysqli_connect($this->host,              $this->usuario,   $this->senha,  $this->database);
                        //(localização banco dados,   usuario acesso,   senha,         nome banco dados)
            
            //ajustar o charset de comunicação dom o bd
            mysqli_set_charset($conexao,'utf8');

            //verificar erros conexão
            if(mysqli_connect_errno()){
                echo 'Erro de conexão ao banco dados: ' . mysqli_connect_error();
            }

            return $conexao;
        }
}

?>