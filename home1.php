<?php 

include 'global.php';

	session_start(); // abre sessão
	if(!isset($_SESSION['usuario'])){
		header('location: index1.php?erro=0');
	}

	require_once ('db.class.php');

	$objDB = new db();
	$link = $objDB ->conecta_mysql();
	
	//consulta e conta a quantidade de tweets
	$id = $_SESSION['id'];
	
	$sql = "select count(tweet) as qte_tweets from tweet where id_usuario = $id"; //conta a quantidade de registros há na tabela tweet

	$resultado_id = mysqli_query($link,$sql);

	if($resultado_id){

   		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		   $qte_tweets = $registro['qte_tweets'];
	}
		
	//consulta e conta a quantidade de seguidores
	$sql = " select count(id_usuario) as qte_seguidores from seguidores where id_usuario = $id"; //conta a quantidade de registros há na tabela tweet

	$resultado_id = mysqli_query($link,$sql);

	
	if($resultado_id){

   		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		   $qte_seguidores = $registro['qte_seguidores'];
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>

		<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate, Post-Check=0, Pre-Check=0">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">

		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!--Latest compiled and minified CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
		<!--jQuery library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		<!--Latest compiled JavaScript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script language="javascript" src="java.js"></script>

	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    		
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4>
							<?=$_SESSION['usuario'] ?>
						</h4> 

							<hr>
							<div class="col-md-6">
								TWEETS <br>
								<?= $qte_tweets ?> <br>
							</div>
							<div class="col-md-6">
								SEGUIDORES <br> 
								<?= $qte_seguidores ?> <br>
							</div>
					</div>
				</div>
			</div>
            <div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<form class="input-group">
								<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="Digite o seu status agora" maxlength="140">
								<span class="input-group-btn">
									<button class="btn btn-primary" id="btn_publicar">Publicar</button>
								</span>
							</form>
						</div>
						
					</div>

					<div id="tweets" class="list-group">

					</div>
            </div>
			<div class=col-md-3>
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar Amigos</a></h4>
					</div>
				</div>
			</div>

			</div>


	    </div>
	
		<!--Latest compiled JavaScript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	</body>

	<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate, Post-Check=0, Pre-Check=0">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">

</html>