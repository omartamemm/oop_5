<?php


use App\database;
use App\product;


require_once "vendor/autoload.php";

require_once "config/db.php";



$db = database ::get_instance($connect)->get_connect();

product::create($db,1,1,"modify","first exprimanet ",12.5,10);


$f= product::find_by_id($db,4);
echo $f->name;