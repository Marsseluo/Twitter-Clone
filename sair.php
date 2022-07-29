<?php 

include 'global.php';

session_start();
unset ($_SESSION['usuario']);
unset ($_SESSION['email']);

echo 'redirecionando a página inicial';

header("Location: index1.php?erro=0" );

?>