<?php
session_start();
require 'config/login.php';

$opciones["location"]="http://localhost/Casino/server.php";
$opciones["uri"]="http://localhost/Casino/server.php";
$cliente=new SoapClient(NULL,$opciones);
$tirada = "";

if(isset($_SESSION['nick'])){
    $nick = $_SESSION['nick']; //Guardo el nick de la sessió en una veriable
    $soci=Soci::getSocinick($nick); //Recupero la informació del soci a partir del $nick
    $saldo = $soci->saldo; //Recupero de la BDD el saldo del soci

    if (isset($_POST['tirada']) && $saldo > 0){
        $tirada = $cliente->tirada();
       
        if(!empty($_POST['jugada']) && !empty(['aposta'])){
           $jugada = htmlspecialchars($_POST['jugada']);
           $aposta = htmlspecialchars($_POST['aposta']);
           $nouSaldo = $soci->saldo;
            
            if($jugada=="par"){ //si l'usuari escull par...
                if( ($tirada%2==0) && ($tirada!=0) ){  // si surt un numero divisible per 2 i no es cero
                    $nouSaldo=$soci->saldo+$aposta;  // afegir guanys al saldo
                    // echo "<h4>has guanyat $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo-$aposta;  // resta l'aposta
                    // echo "<h4>has perdut $aposta €</h4>";
                }
            }
            if($jugada=="impar"){ // si l'usuari escull impar
                if( ($tirada%2==0) && ($tirada!=0) ){
                    $nouSaldo=$soci->saldo-$aposta;
                    // echo "<h4>has perdut $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo+$aposta;
                    // echo "<h4>has guanyat $aposta €</h4>";
                }
            }
            if($jugada=="vermell"){ //escull vermell 
                if( in_array($tirada, [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36]) ){  // si surt vermell
                    $nouSaldo=$soci->saldo+$aposta;
                    // echo "<h4>has guanyat $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo-$aposta;
                    // echo "<h4>has perdut $aposta €</h4>";
                }
            }
            if($jugada=="negre"){  // escull negre
                if( in_array($tirada, [2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,31,33,35]) ){  // si surt negre
                    $nouSaldo=$soci->saldo+$aposta;
                    // echo "<h4>has guanyat $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo-$aposta;
                    // echo "<h4>has perdut $aposta €</h4>";
                }
            }
            if($jugada=="pmeitat"){
                if (in_array($tirada, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18])) {
                    $nouSaldo=$soci->saldo+$aposta;
                    // echo "<h4>has guanyat $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo-$aposta;
                    // echo "<h4>has perdut $aposta €</h4>";
                }
            }
            if($jugada=="smeitat"){
                if (in_array($tirada, [19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36])) {
                    $nouSaldo=$soci->saldo+$aposta;
                    // echo "<h4>has guanyat $aposta €</h4>";
                }else{
                    $nouSaldo=$soci->saldo-$aposta;
                    // echo "<h4>has perdut $aposta €</h4>";
                }
            }
                if($nouSaldo>$soci->saldo){  // si el nou saldo es mes gran que el de la BDD GUANYES sino PERDS
                    $resultat="GUANYES $aposta €";
                }else{
                    $resultat="PERDS $aposta €";
                }

                $soci->saldo=$nouSaldo;  //Actualizar el saldo del usuari al html
                $soci->actualitzarSaldo($nick,$saldo);  //Actualitzar el saldo del usuari a la BDD
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Classic Roulette</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estils2.css" />
        <link rel="stylesheet" type="text/css" href="css/ruleta2.css" />
		<meta name="descriptions" content="">
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="media/mobil.css" media="screen and (max-width: 500px)" />
		<link rel="shortcut icon" href="imatges/favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<?php include 'view/header.php';?>
	
    	<main>

    		<?php
    		if(empty($_SESSION['nick'])){?>
    			<div class="fondo" style="background-color: rgba(255,255,255,0.5);">
    		    	<p style="padding:20vw 0;font-size:3vw;color:#000;">Identificat o <a href="registre.php">registrat </a>per poder jugar</p>
    		    </div>
    		
    		<?php }else{?>

    			<div><h2>Classic Roulette</h2></div>
                <div id="numero">
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <select name="aposta">
                            <option value="5">5 €</option>
                            <option value="10">10 €</option>
                            <option value="20">20 €</option>
                            <option value="50">50 €</option>
                        </select>
                        <select name="jugada">
                            <option value="par">PAR</option>
                            <option value="impar">IMPAR</option>
                            <option value="vermell">VERMELL</option>
                            <option value="negre">NEGRE</option>
                            <option value="pmeitat">1-18</option>
                            <option value="smeitat">19-36</option>
                        </select><br>
                        
                        <input type="submit" name="tirada" value="Jugar">
                    </form>
                    <?php
                    
                    if(isset($resultat)){?>
                        <h4><?php echo $resultat ?></h4>
                    <?php}
                    
                    if(isset($tirada)){
                            echo "hola";
                        if(in_array($tirada, [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36])){?>
                                <p style = "background-color:#f00;color:#fff;border-radius: 50px;"><?php echo $tirada?></p><?php
                            }elseif(in_array($tirada, [2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,31,33,35] )){?>
                                <p style = "background-color:#000;color:#fff;border-radius: 50px;"><?php echo $tirada?></p><?php
                            }else{?>
                                <p style = "background-color:#1efc7a;color:#fff;border-radius: 50px;"><?php echo $tirada?></p>
                                <?php
                            }
                        }?>
                    
                </div>
            
    	</main>
    	
    	<?php include 'view/footer.php';?>
	</body>
</html>
