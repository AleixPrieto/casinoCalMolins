<?php
require_once '../config/config.php';
require_once '../libraries/DB.php';
require_once '../model/Soci.php';

//Recuperar tots els socis
$socis=Soci::get();

//llista html amb les dades
echo "<ul>";

    foreach($socis as $soci)
        echo "<li>{$soci}</li>";
    
echo "</ul>";

//Recuperar soci per id
$soci=Soci::getSoci(1);

echo $soci? "<p>$soci</p>" : "<p>Soci inexistent</p>";


//Recuperar soci concret per nick
$soci=Soci::getSocinick('peski');

echo $soci? "<p>$soci</p>" : "<p>Soci inexistent</p>";


//guardar un soci
//creo un nou objecte soci
$soci = new Soci();

//posem els valors a les propietats
$soci->nick='aleix';
$soci->pass='aina';
$soci->rang=0;
$soci->saldo=0;

//guardem el soci
$id = $soci->guardar();

echo $id? "<p>Guardat amb la id: $id</p>":"<p>Error al guardar: ".DB::get()->error."</p>";