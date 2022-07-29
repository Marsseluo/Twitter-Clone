<?php 

include 'global.php';

    session_start(); //abre a sessão

require_once 'db.class.php';

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = "select * from usuarios where usuario ='$usuario' and senha='$senha' ";

$objDB = new db();
$link = $objDB->conecta_mysql();

$resultado_search = mysqli_query($link,$sql);

if($resultado_search){
    $dados_usuarios = mysqli_fetch_array($resultado_search);

    if(isset($dados_usuarios ['usuario'])){
        
        $_SESSION['id'] = $dados_usuarios['id'];
        $_SESSION['usuario'] = $dados_usuarios['usuario'];
        $_SESSION['email'] = $dados_usuarios['email'];

        header('location:home1.php');
    }
    else{
        header("Location: index1.php?erro=1" );
    }
}
else{
    echo ('não foi possível realizar a consulta');
}


//update

//insert

//select

//delete

?>