<?php

class Conexion{
  static public function infoDatabase(){
    $infoDB = array(
      "database" => "database_1",
      "user" => "root",
      "password" => "Workbench.1"
    );
    return $infoDB;
  }

  static public function conectar(){
    try {
      $link = new PDO(
        "mysql:host=localhost;dbname=".Conexion::infoDatabase()["database"],
        Conexion::infoDatabase()["user"],
        Conexion::infoDatabase()["password"]
      );
      $link -> exec("set names utf8");
    } catch (PDOException $e) {
      die("Error: ".$e->getMessage());
    }
    return $link;
  }
}