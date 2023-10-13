<?php

class DBConfig{
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;

    public function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "SIS";
    }
}

?>