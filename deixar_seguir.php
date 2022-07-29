<?php 

include 'global.php';

session_start();

if(!isset($_SESSION['usuario'])){ // apenas permite acesso se a sessão de usuário foi iniciada
    header('location: index1.php?erro=0');
}

require_once ('db.class.php');


 $id_usuario = $_SESSION['id'];
 $deixar_seguir = $_POST['deixar_seguir_id_usuario'];

 if($id_usuario == '' || $deixar_seguir == ''){ // verifica se as informações contidas nas variáveis estão preenchidas
    die();
 }

    $objDB = new db;
    $link = $objDB->conecta_mysql();

    //exclui registros de seguir usuario do banco de dados
    $sql = "delete from seguidores where id_usuario = $id_usuario and usuario_seguido = $deixar_seguir";
        
    mysqli_query($link,$sql);

?>