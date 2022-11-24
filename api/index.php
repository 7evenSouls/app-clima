<?php

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        if (isset($_GET['mode'])) {
            if ($_GET['mode'] == 'list-stations') {
                include_once '../models/station.php';
                $station = new Station();
                $station->connect();
                $res = $station->getStationList();

                if ($res) {
                    $body = array(
                        'errno' => 200,
                        'error' => 'Lista de estaciones obtenida con éxito.',
                        'stationData' => $res
                    );
                    break;
                }
            }
            $body = array(
                'errno' => 400,
                'error' => 'Modo no válido'
            );
            break;
        }


        if (isset($_GET['chipid'])) {

            if (trim($_GET['chipid']) == '' or !is_numeric($_GET['chipid'])) {
                $body = array(
                    'errno' => 400,
                    'error' => 'Chipid no válido.'
                );
                break;
            }

            
            include_once '../models/station.php';
            $station = new Station();
            $station->connect();


            if (isset($_GET['limit'])) {
                if (trim($_GET['limit']) == '' or !is_numeric($_GET['limit'])) {
                    $body = array(
                        'errno' => 400,
                        'error' => 'Limit no válido.'
                    );
                    break;
                }
                $res = $station->getStationData($_GET['chipid'], $_GET['limit']);
            }
            else {
                $res = $station->getStation($_GET['chipid']);
            }


            if ($res) {
                $body = array(
                    'errno' => 200,
                    'error' => 'Datos de la estación obtenidos con éxito.',
                    'stationData' => $res
                );
                break;
            }


            $body = array(
                'errno' => 404,
                'error' => 'Estación no encontrada.'
            );
            break;
        }

        break;
}


if (! isset($body)) {
    $body = array(
        'errno' => 400,
        'error' => 'Acción no indicada.'
    );
}


echo json_encode($body);

?>