<?php 

include 'global.php';

session_start();

if(!isset($_SESSION['usuario'])){ // apenas permite acesso se a sessão de usuário foi iniciada
    header('location: index1.php?erro=0');
}

require_once ('db.class.php');

 $texto_tweet = $_POST['texto_tweet'];
 $id_usuario = $_SESSION['id'];

 if($id_usuario == '' || $texto_tweet == ''){
    echo "favor inserir um texto para publicação";
    die();
 }

    $objDB = new db;
    $link = $objDB ->conecta_mysql();

    $sql = "insert into tweet (id_usuario,tweet) values ( '$id_usuario' , '$texto_tweet')";

    mysqli_query($link,$sql);

?>