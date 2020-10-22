<?php 
session_start();
require 'config/login.php';
/*require 'model/Soci.php';*/
/*require 'libraries/DB.php';*/

//url del servidor
// $url = "http://localhost/MF0493_3/Casino/server.php";

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Registre</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estils2.css" />
		<link rel="stylesheet" type="text/css" href="css/registre.css" />
		<meta name="descriptions" content="">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="media/mobil.css" media="screen and (max-width: 500px)" />
		<link rel="shortcut icon" href="imatges/favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<?php require_once 'view/header.php';?>
	
    	<main>
    		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" accept-charset="utf-8">
    			<input type="text" name="nick" placeholder="NICK"><br>
    			<input type="password" name="password" placeholder="PASSWORD"><br>
    			<input type="password" name="password2" placeholder="COMFIRMAR PASSWORD"><br>
    			<!-- <input type="text" name="codi" placeholder="CODI INVITACIÓ"><br> -->
    			<input type="submit" name="enviar" value="Registrar">
    			<?php
    				$soci = new Soci();

					if (isset($_POST['enviar'])){
						$nick = $_POST['nick'];
						$soci=Soci::getSocinick($nick);
						//echo $soci;
						if((!empty($_POST['nick'])) && (!empty($_POST['password'])) && (!empty($_POST['password2']))){
							if(!$soci){
								if ($_POST['password']==$_POST['password2']){
									//guardar un soci
									//creo un nou objecte soci
									$soci = new Soci();

									//posem els valors a les propietats
									$soci->nick=$_POST['nick'];
									$soci->pass=$_POST['password'];

									//guardem el soci
									$id = $soci->guardar();

									echo $id? "<p>Benvingut/da <b>$nick</b></p>":"<p>Error al guardar: ".DB::get()->error."</p>";
											}else{
												echo "<p style=' color:#f00;'>WARNING: Password diferent</p>";
											}
										}else{
											echo "<p style=' color:#f00;'>WARNING: nick ja utilitzat</p>";
										}
									}
								}
    			?>
    		</form>
    	</main>
    	
    	<?php require_once 'view/footer.php';?>
	</body>
</html>