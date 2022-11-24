<?php

include_once 'database.php';

class Station extends DataBase {
    public $currentStation;

    
    public function GetStation(int $chipid) {
        return $this->selectQuery("SELECT * FROM estaciones WHERE chipId = " . $chipid)[0];
    }


    public function GetStationList() {
        return $this->selectQuery("SELECT * FROM estaciones");
    }


    public function GetStationData(int $chipid, int $limit) {
        return $this->selectQuery("SELECT * FROM tiempo WHERE chipId = " . $chipid . " ORDER BY fecha DESC LIMIT " . $limit);
    }
}

?>