<?php
$classmap = ['model','libraries'];

//PARAMETRES DE CONFIGURACIÓ BDD
define('DB_HOST','localhost');
define('DB_USER','aleix');
define('DB_PASS','1234');
define('DB_NAME','casino');
define('DB_CHARSET','utf8');

//conector que debe usar PDO
define('SGDB','mysqli');

//CONTROLADOR Y METODO POR DEFECTO
define('DEFAULT_CONTROLLER', 'Welcome' );
define('DEFAULT_METHOD','index');