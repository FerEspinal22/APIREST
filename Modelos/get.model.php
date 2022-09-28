<?php

require_once "conexion.php";

class GetModel{

  /***************************
 * Peticiones GET sin filtro 
 **************************/
  static public function GetDatos($tabla,$select, $orderBy, $orderMode, $startAt, $endAt){

    $sql = "SELECT $select FROM $tabla";

    /***************************
    En caso de que traigan información ordenandola y sin limitarla 
 **************************/
    if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
      $sql = "SELECT $select FROM $tabla ORDER BY $orderBy $orderMode";
    }

    /***************************
    En caso de que traigan información ordenandola y limitandola
    **************************/
    if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
      $sql = "SELECT $select FROM $tabla ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
    }

      /***************************
    En caso de que traigan información limitandola y sin ordenarla
    **************************/

    if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
      $sql = "SELECT $select FROM $tabla LIMIT $startAt, $endAt";
    }

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt -> execute();

    return $stmt -> fetchAll(PDO::FETCH_CLASS);
  }
  /***************************
 * Peticiones GET con filtro 
 **************************/
  static public function GetDatosFiltrados($tabla,$select,$linkTo,$equalTo, $orderBy, $orderMode, $startAt, $endAt){
    $linkToArray = explode(",",$linkTo);
    $equalToArray = explode("_",$equalTo);
    $linkToText = "";
    if (count($linkToArray)>1) {
      foreach ($linkToArray as $key => $value) {
        if ($key > 0) {
          $linkToText .= "AND ".$value." = :".$value." ";
        }
      }
    }
    
    $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

  /***************************
    En caso de que traigan información ordenandola y sin limitarla 
 **************************/
    if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
      $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
    }

    /***************************
    En caso de que traigan información ordenandola y limitandola
    **************************/
    if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
      $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
    }

      /***************************
    En caso de que traigan información limitandola y sin ordenarla
    **************************/

    if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
      $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt, $endAt";
    }

    $stmt = Conexion::conectar()->prepare($sql);
    
    foreach ($linkToArray as $key => $value) {
      $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);
    }
    $stmt -> execute();
    return $stmt -> fetchAll(PDO::FETCH_CLASS);
  }
}