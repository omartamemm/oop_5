<?php


use app\controller\user as con;
use app\model\user as us;
// include "controller/user1.php";
// include "model/user1.php";

spl_autoload_register(function($class){
    echo $class;
    require $class .".php";


});

echo "<hr>";
$two = new \app\controller\user;

$one= new us;

echo "<hr>";
echo $one->print();
echo "<hr>";
echo $two->print();