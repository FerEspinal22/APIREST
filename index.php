<?php
/********
 * Manejo de errores
 *******/
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log',"C:/xampp/htdocs/Ejemplo/php_error_log");

require_once "Modelos/conexion.php";

//echo '<pre>'; print_r(Conexion::conectar()); echo '<pre>';
/********
 * Manejo de errores
 *******/
require_once "Controladores/rutas_controller.php";

$index = new rutasController();
$index -> index();