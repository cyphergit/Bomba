<?php

class DBase {

    public $isLocal;
    public $setting;
    
    private function settings() {
        $s = $this->setting;
        return $s->default_settings();
    }
    
    private function source() {
        $db_info = $this->settings();

        if (!$this->isLocal) {
            return $db_info["database"]["prod"];
        } else {
            return $db_info["database"]["local"];
        }
    }

    public function connect() {
        $dbase = $this->source();        
        $con = mysqli_connect($dbase['host'], $dbase['user'], $dbase['password'], $dbase['db_name']);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
            
        } else {
            return $con;
        }
    }

    public function server_info($connection) {
        return mysqli_get_server_info($connection);
    }

}
