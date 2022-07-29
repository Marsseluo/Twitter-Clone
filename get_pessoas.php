<?php 

include 'global.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header('location: index1.php?erro=1');
}

require_once ('db.class.php');

$nome_pessoa = $_POST['nome_pessoa'];
$id_usuario = $_SESSION['id'];

$objDB = new db();
$link = $objDB ->conecta_mysql();

//Pesquisa nomes de usuarios na tabela usuarios
//$sql = "SELECT * from usuarios where usuario like '%$nome_pessoa%' and id <> '$id_usuario'"; // like - usado com % para encontrar parte do nome 
$sql = "select u.*, s.* from usuarios as u
        left join seguidores as s
        on (s.id_usuario = $id_usuario and u.id = s.usuario_seguido)
        where u.usuario like '%$nome_pessoa%' and u.id <> $id_usuario";

$resultado_id = mysqli_query($link,$sql);

//exibindo os resultados pesquisa
if($resultado_id){

   
    while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

        echo '<a href="#" class="list-group-item">';
            echo '<strong>'.$registro['usuario'].'</strong> <small>'.$registro['email'].'</small>';
            
            //incluir botão seguir 
            echo '<p class ="list-group-item-text pull-right">';

                $segue_sn = isset($registro['usuario_seguido']) && !empty($registro['usuario_seguido']) ? 's': 'n';

                $btn_seguir = 'block';
                $btn_deixar_seguir = "block";

                if($segue_sn == 'n'){
                    $btn_deixar_seguir = 'none';
                }
                else{
                    $btn_seguir = 'none';
                }

                echo '<button style="display:'.$btn_seguir.'" id="seguir_'.$registro['id'].'" class="btn_seguir btn btn-default" type="button"  data-id_usuario="'.$registro['id'].'">Seguir</button>';
                echo '<button style="display:'.$btn_deixar_seguir.'" id="deixar_seguir_'.$registro['id'].'" class="btn_deixar_seguir btn btn-primary" type="button" data-id_usuario="'.$registro['id'].'">Deixar de Seguir</button>';
            echo '</p>';
            echo '<div class="clearfix"></div>';
            echo '</a>';        
        
    }
    }

else{
    echo '<strong>Nenhum usuário encontrado<strong>';
}

?>