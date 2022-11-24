<?php

include_once 'credentials.php';

class DataBase {
    public $db;
    public $response;

    public function connect() {
        $this->db = new mysqli(HOST, USER, PASS, DB, PORT);
        if ($this->db->connect_errno) {
            echo('Error al conectarse a la DB <br>'. $this->db->connect_error);
            exit();
        }
    }

    public function queryExec($query) {
        $this->response = $this->db->query($query);
    }

    /**
     * * Devuelve el resultado de la última consulta ejecutada
     * * como un array asociativo.
     * En caso de que el resultado no sea válido, devuelve false
     */
    public function getResponse() {
        if (! $this->response) {
            return false;
        }

        return $this->response->fetch_all(MYSQLI_ASSOC);
    }

    
    /**
     * * Devuelve los datos de una consulta (normalmente SELECT).
     * Si la consulta devuelve 0 filas, retorna false.
     */
    public function selectQuery($query) {
        $this->queryExec($query);

        if ($this->response->num_rows == 0) {
            return false;
        }
        return $this->getResponse();
    }
    

    public function insertQuery(string $table, array $data) {
        $query = ' (';
        foreach ($data as $key => $value) {
            $query .= $key . ', ';
        }
        $query = rtrim($query, ', ');
        $query .= ') VALUES (';
        foreach ($data as $key => $value) {
            if (is_numeric($value)) {
                $query .= $value . ', ';
            }
            else {
                $query .= "'" . $value . "', ";
            }
        }
        $query = rtrim($query, ', ');
        $query .= ')';

        $this->queryExec("INSERT INTO " . $table . $query);
    }
}

?>