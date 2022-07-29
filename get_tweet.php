<?php 

include 'global.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header('location: index1.php?erro=1');
}

require_once ('db.class.php');

$id_usuario = $_SESSION['id'];

$objDB = new db();
$link = $objDB ->conecta_mysql();

//junção das tabelas usuario e tweet - join
$sql = "SELECT DATE_FORMAT(t.data, '%d %b %Y %T') AS data_formatada, t.tweet, u.usuario ";
    $sql .= "FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
    $sql .= "WHERE id_usuario = $id_usuario ";
    $sql .= "OR id_usuario IN (SELECT usuario_seguido FROM seguidores WHERE id_usuario = $id_usuario) ";
    $sql .= "ORDER BY data DESC";

$resultado_id = mysqli_query($link,$sql);

//exibindo as publicações
if($resultado_id){
    while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
        
        echo '<a href="#" class="list-group-item">';
            echo '<h4 class="list-group-item-heading">'.$registro['usuario'].'<small style="Float:right">'.$registro['data_formatada'].'</small></h4>';
            echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
        echo '</a>';
    
    }
}
else{
    echo "Nenhuma publicação encontrada";
}

?>