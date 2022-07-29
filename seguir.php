<?php 

include 'global.php';

session_start();

if(!isset($_SESSION['usuario'])){ // apenas permite acesso se a sessão de usuário foi iniciada
    header('location: index1.php?erro=0');
}

require_once ('db.class.php');


 $id_usuario = $_SESSION['id'];
 $seguir = $_POST['seguir_id_usuario'];

 if($id_usuario == '' || $seguir == ''){ // verifica se as informações contidas nas variáveis estão preenchidas
    die();
 }

    $objDB = new db;
    $link = $objDB->conecta_mysql();

    $sql = "insert into seguidores (id_usuario, usuario_seguido) values ( $id_usuario , $seguir)";
        
    mysqli_query($link,$sql);

?>