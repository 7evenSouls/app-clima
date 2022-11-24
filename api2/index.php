<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: True');
header('Access-Control-Allow-Methods: PUT, POST, DELETE, GET');

define('URL_BASE', '/alumno/3781/app_estaciones/api2/');

$request = explode('/', str_replace(URL_BASE, '', $_SERVER['REQUEST_URI']));
$request = array_values(array_filter($request));

if(! count($request)) {
    $body = array('errno' => 404, 'error' => 'Faltan parámetros.');
    echo json_encode($body);
}
else {

    $model = ucfirst(strtolower($request[0]));
    $modelName = '../models/' . $model .'.php';

    if (! file_exists($modelName)) {
        $body = array('errno' => 404, 'error' => 'El modelo no existe.');
        echo json_encode($body);
    }
    else {
        $metodo = ucfirst(strtolower($request[1]));

        if (! isset($metodo)) {
            $body = array('errno' => 404, 'error' => 'Faltan parámetros.');
            echo json_encode($body);
        }
        else {
            include_once $modelName;

            if (! method_exists($model, $metodo)) {
                $body = array('errno' => 404, 'error' => 'El método no existe en la clase.');
                echo json_encode($body);
            }
            else {
                $obj = new $model;
                $obj->connect();

                //echo json_encode($obj->$metodo());
                unset($request[0]);
                unset($request[1]);

                $res = call_user_func_array(array($obj, $metodo), array_values($request));
                $body = array('errno' => 200, 'error' => 'Petición exitosa', 'data' => $res);

                echo json_encode($body);
            }

        }
    }
}


?>