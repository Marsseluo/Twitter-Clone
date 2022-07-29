<?php 

include 'global.php';

require_once ('db.class.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

//variaveis verificar se dados já existem e é possivel seguir com cadastro
$usuario_existe = false;
$email_existe = false;

//instanciando banco dados
$objDB = new db();
$link =$objDB->conecta_mysql();

//verifica se usuario já existe
$sql="select * from usuarios where usuario = '$usuario' ";
    if ($resultado_search = mysqli_query($link,$sql)){
        $dados_usuario = mysqli_fetch_array($resultado_search);

        if(isset($dados_usuario['usuario'])){
            $usuario_existe = true;
        }
    }

//verifica se email já existe
$sql="select * from usuarios where email = '$email' ";
if ($resultado_search = mysqli_query($link,$sql)){
    $dados_usuario = mysqli_fetch_array($resultado_search);

    if(isset($dados_usuario['email'])){

        $email_existe = true;
        }
}

//verifica se é possível segui com cadastro
if($usuario_existe || $email_existe){
    $retorno_get=''; //retorna o erro ao usuário

    if($usuario_existe){
        $retorno_get.= "erro_usuario=1&";
    }

    if($email_existe){
        $retorno_get.= "erro_email=1&";
    }

    header('location: inscrevase.php?'.$retorno_get);
    die();
}

    

//insere dados no banco de dados
$sql = "INSERT INTO usuarios( usuario, email, senha) values( '$usuario' , '$email' , '$senha')";

//executar
if (mysqli_query($link, $sql)){
         //(variavel conexão , variavel com os dados a serem inseridos)
    header ("location:index1.php?sucesso=1");
    }
    else{
        echo 'não foi possivel efetuar cadastro';
    }


?>