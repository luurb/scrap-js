<?php

//Abstract class with data to login to database
abstract class IDbInit
{
    protected $addr = "localhost";
    protected $login = "luckyluk";
    protected $password = "Hst13Har@";
    protected $db_name = "games";

    public function dbConnect()
    {
        $db_obj = new mysqli($this->addr, $this->login, $this->password, $this->db_name);
        if (!$db_obj->connect_errno) {
            return $db_obj;
        } else {
            echo $db_obj->connect_errno();
            $db_obj->close();
            return 0;
        }
    }
    
}
