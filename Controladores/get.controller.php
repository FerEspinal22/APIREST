<?php
require_once "Modelos/get.model.php";

class GetController{
  /***************************
 * Peticiones GET sin filtro 
 **************************/
  static public function GetDatos($tabla, $select, $orderBy, $orderMode, $startAt, $endAt){
    $response = GetModel::GetDatos($tabla,$select, $orderBy, $orderMode, $startAt, $endAt);
    $return = new GetController();
    $return -> fncResponse($response);
  }
  /***************************
 * Peticiones GET con filtro 
 **************************/
  static public function GetDatosFiltrados($tabla, $select,$linkTo,$equalTo, $orderBy, $orderMode, $startAt, $endAt){
    $response = GetModel::GetDatosFiltrados($tabla,$select,$linkTo,$equalTo, $orderBy, $orderMode, $startAt, $endAt);
    $return = new GetController();
    $return -> fncResponse($response);
  }
  /**
   * respuestas del controlador
   */
  public function fncResponse($response){
    if(!empty($response)) {
      $json = array(
        'status' => 200,
        'total' => count($response),
        'results' => $response
      );
    }else {
      $json = array(
        'status' => 400,
        'result' => 'Not found'
      );
    }
    
    echo json_encode($json, http_response_code($json["status"]));
  }

}