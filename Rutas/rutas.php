<?php

$rutasArray = explode("/", $_SERVER['REQUEST_URI']);
$rutasArray = array_filter($rutasArray);


/*****************************************
 *Cuando no se hace una peticion a la api
 ****************************************/
if (empty($rutasArray)) {
    $json = array(
        'status' => 404,
        'result' => 'Not Found'
    );
    echo json_encode($json, http_response_code($json["status"]));
    return;
}

/*****************************************
 *Cuando se hace una peticion a la api
 ****************************************/
if(count($rutasArray) ==1 && isset($_SERVER['REQUEST_METHOD'])){
    /*****************************************
     *Cuando se hace una peticion GET
     ****************************************/
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include_once "Servicios/get.php";
    }
    /*****************************************
     *Cuando se hace una peticion POST
     ****************************************/
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = array(
            'status' => 200,
            'result' => 'Solicitud POST'
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
    /*****************************************
     *Cuando se hace una peticion PUT
     ****************************************/
    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $json = array(
            'status' => 200,
            'result' => 'Solicitud PUT'
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
    /*****************************************
     *Cuando se hace una peticion DELETE
     ****************************************/
    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $json = array(
            'status' => 200,
            'result' => 'Solicitud DELETE'
        );
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}