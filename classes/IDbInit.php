<?php

namespace classes;

//Abstract class with data to login to database
class IDbInit
{
    protected $addr = "localhost";
    protected $login = "";
    protected $password = "";
    protected $db_name = "games";

    public function dbConnect()
    {
        $db_obj = new \mysqli($this->addr, $this->login, $this->password, $this->db_name);
        if (!$db_obj->connect_errno) {
            return $db_obj;
        } else {
            echo $db_obj->connect_error;
            $db_obj->close();
            return 0;
        }
    }
    
}
