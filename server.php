<?php
require_once "model/Numero.php";
require 'model/Soci.php';
header("Content-Type: application/json; charset=utf-8");

$soci = new Soci();

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$soci->guardar($_POST['nick'],$_POST['password']);
	/*$soci->nick = $_POST['nick'];
	$soci->pass = $_POST['password'];

	$id = $soci->guardar();*/
}

$opciones["uri"] = "http://localhost/Casino/server.php";
$servidor=new SoapServer(NULL,$opciones);
$servidor->setClass("Numero");
$servidor->handle();

