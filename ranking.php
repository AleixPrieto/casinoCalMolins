<?php 
session_start();
require 'config/login.php';
/*require 'model/Soci.php';*/
/*require 'libraries/DB.php';*/

//url del servidor
// $url = "http://localhost/MF0493_3/Casino/server.php";
function formulari(){
?>
	<form id="formGuardar" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
		<input type="text" name="nick" placeholder="NICK"><br>
		<input type="text" name="password" placeholder="PASSWORD"><br>
		<input type="text" name="password2" placeholder="CONFIRMAR PASSWORD"><br>
		<input type="text" name="rang" placeholder="RANG"><br>
		<input type="text" name="saldo" placeholder="SALDO"><br>
		<input type="submit" name="guardar" value="Guardar Usuari">
	</form>
<?php
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Control</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estils.css" />
		<link rel="stylesheet" type="text/css" href="css/control2.css" />
		<meta name="descriptions" content="">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="media/mobil.css" media="screen and (max-width: 500px)" />
		<link rel="shortcut icon" href="imatges/favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<?php require_once 'view/header.php';?>
	
    	<main>
    		<table>
			<tr>
				<th>Nick</th>
				<th>Rang</th>
				<th>Saldo</th>
			</tr>
			<?php
            $socis=Soci::get();
			foreach ($socis as $soci){
			    echo "<tr>";				
			    echo "<td>$soci->nick</td>";
			    echo "<td>$soci->rang</td>";
			    echo "<td>$soci->saldo €</td>";
                echo "</tr>";
			    }
			?>	
			</table>
    	</main>
    	
    	<?php require_once 'view/footer.php';?>
	</body>
</html>