<?php 
session_start();
require 'config/login.php';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Portada</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estils.css" />
		<link rel="stylesheet" type="text/css" href="css/portada.css" />
		<meta name="descriptions" content="">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="media/mobil.css" media="screen and (max-width: 500px)" />
		<link rel="shortcut icon" href="imatges/favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<?php require_once 'header.php';?>
	
    	<main>	
	    	<section>
    			<figure>
    				<a href="texas.php"><img src="imatges/texas.jpg" alt=""></a>
    				<a href="ruleta.php"><img src="imatges/ruleta.png" alt=""></a>
    				<a href="blackjack.php"><img src="imatges/black.jpg" alt=""></a>
    			</figure>
    		</section>
    	</main>
    	
    	<?php require_once 'footer.php';?>
	</body>
</html>
