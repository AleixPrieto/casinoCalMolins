<?php
//funcion que fem servir per utilitzar les classes
function load($clase){
    global $classmap; //variable global
    
    //per a cada directori de la llista
    foreach($classmap as $directorio){
        $ruta = "$directorio/$clase.php"; //calcula la ruta
        
        if (is_readable($ruta)) { //si es legible
            require_once $ruta; //carga la clasSe
            break;              
        }
    }
}

spl_autoload_register("load"); //registra la funció de autoload

