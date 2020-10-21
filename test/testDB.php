<?php
require_once '../config/config.php';
require_once '../libraries/DB.php';

echo "<pre>";
    var_dump(DB::selectAll("SELECT * FROM socis"));
echo "</pre>";

echo "<pre>";
var_dump(DB::select("SELECT * FROM socis WHERE nick='peski'"));
echo "</pre>";

echo "<pre>";
var_dump(DB::selectAll("SELECT * FROM socis where nick='peski'"));
echo "</pre>";