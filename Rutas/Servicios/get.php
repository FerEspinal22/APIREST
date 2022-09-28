<?php
require_once "Controladores/get.controller.php";

$tabla = explode("?", $rutasArray[1])[0];
$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;


$response = new GetController();

/***************************
 * Peticiones GET con filtro 
 **************************/
if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
  $response -> GetDatosFiltrados($tabla,$select,$_GET['linkTo'],$_GET['equalTo'], $orderBy, $orderMode, $startAt, $endAt);
  
  /***************************
   * Peticiones GET sin filtro entre tablas relacionadas
   **************************/

} else if (isset($_GET['rel']) && isset($_GET['type']) && $tabla == 'relations' && !isset($_GET['linkTo']) && isset($_GET['equalTo'])){

  // $response -> GetRelDatos($_GET['rel'],$_GET['type'], $select, $orderBy, $orderMode, $startAt, $endAt);


}else {
  /***************************
   * Peticiones GET sin filtro 
   **************************/
  $response -> GetDatos($tabla,$select, $orderBy, $orderMode, $startAt, $endAt);
}


