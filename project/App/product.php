<?php

namespace App;
use PDO;
 use PDOException;
//id user_id categroy_id name decripation price quantity image    
class product{

private int $id;
private int $user_id;
private int $categroy_id;
private string $name;
private string $descripation;
private float $price;
private int $quantity;
private string $image;

public function __construct( int $id,int $user_id, int $categroy_id, string $name, string $descripation, float $price ,int $quantity)
{
    $this->id = $id;
    $this->user_id=$user_id;
    $this->categroy_id=$categroy_id;
    $this->name=$name;
    $this->descripation=$descripation;
    $this->price=$price;
    $this->quantity=$quantity; 
}

public function __get($name)
{
    if ($name=="id") {
        return $this->id;

    }elseif ($name=="user_id") {
        return $this->user_id;
    }elseif ($name=="name") {
       return $this->name;
    }elseif ($name=="categroy_id") {
        return $this->categroy_id;
    }elseif ($name=="descripation") {
        return $this->descripation;
    }elseif ($name=="price") {
        return $this->price;
    }elseif ($name=="quantity") {
        return $this->quantity;
    }


}

public static function create( PDO $conn,int $user_id, int $categroy_id, string $name, string $descripation, float $price ,int $quantity) :?product{
    $stmt=$conn->prepare( "INSERT INTO products(user_id,categroy_id,name,descripation,price,quantity)VALUES(?,?,?,?,?,?);");
    $success = $stmt->execute([$user_id,$categroy_id,$name,$descripation,$price,$quantity]);
    if ($success) {
        $id= $conn->lastInsertId();
        return new self($id,$user_id,$categroy_id,$name,$descripation,$price,$quantity);

    }

    else {
        return null;
    }



    
}

public static function get_all(PDO $conn):array{

    $stmt=$conn->query("SELECT * FROM products;");
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $result=[];

    foreach ($rows as $row) {

       $result[]= new self($row['id'],$row['user_id'],$row['categroy_id'],$row['name'],$row['descripation'],$row['price'],$row['quantity']);


    }
    return $result;
}

public static function find_by_id(PDO $conn, int $id) : ?product {
    $stmt=$conn->prepare("SELECT * FROM `products` WHERE id =?");
   $stmt->execute([$id]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new product($row['id'],$row['user_id'],$row['categroy_id'],$row['name'],$row['descripation'],$row['price'],$row['quantity']);
    }
    else{
        return null;
    }


    
}




}