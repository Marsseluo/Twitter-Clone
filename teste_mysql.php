<?php 

include 'global.php';

require_once 'db.class.php';

$sql = "select * from usuarios";

$objDB = new db();
$link = $objDB->conecta_mysql();

$resultado_search = mysqli_query($link,$sql);

if($resultado_search){
    $dados_usuarios = mysqli_fetch_array($resultado_search);

    echo 'exibir indices e associaçoes do array <br>';

    var_dump ($dados_usuarios);

    echo '<br>';
    echo '<br>';

    echo 'exibir indices numéricos do array <br>';
    var_dump ($dados_usuarios = mysqli_fetch_array($resultado_search,MYSQLI_NUM));

    echo '<br>';
    echo '<br>';

    echo 'exibir indices associativos do array <br>';
    var_dump ($dados_usuarios = mysqli_fetch_array($resultado_search,MYSQLI_ASSOC));

    echo '<br>';
    echo '<br>';

    echo 'exibir todos os registros da consulta <br>';
    $dados_usuarios = array();
    
    while($linha = mysqli_fetch_array($resultado_search,MYSQLI_ASSOC)){
        $dados_usuarios[] = $linha;

    }

    foreach($dados_usuarios as $usuario){
        var_dump($usuario);
        echo '<br>';
        echo '<br>';
    }

    echo '<br>';
    echo '<br>';

    echo 'exibir apenas um registro da consulta <br>';
    foreach($dados_usuarios as $usuarios){
        var_dump($usuarios['email']);
        echo '<br>';
        echo '<br>';
    }
}
else{
    echo ('não foi possível realizar a consulta');
}

?>