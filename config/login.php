<?php
require 'config/config.php';
require 'model/Soci.php';
require 'libraries/DB.php';

if(isset($_POST['login'])){
    $nick = htmlspecialchars($_POST['nick']);
    $password = htmlspecialchars($_POST['password']);
    $soci=Soci::getSocinick($nick);
    if(!empty($soci)){
        if($password==$soci->pass){
            $_SESSION['logged'] = true;
            $_SESSION['nick'] = $nick;
        }else{
            echo "<p>Nick o password incorrectes</p>";
        }
    }
}

if(!empty($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: index.php');
}
