<?php

//Class got methods for operation on games database.
class GameDbConnect
{
    
    //Function to add values from game object to database
    public function dbAdd($values, $db_obj)
    {
        if (!$db_obj->connect_errno) {
            $query = "INSERT INTO games VALUES" . $values;
            $db_obj->query($query);
        } else {
            echo "Database connect error";
        }
    }

    //Function check if game is already in database or it has to be added. 
    //Also check if game is copied in database max 3 times. If not added it to database.
    public function dbCheck($values, $teams, $bet, $db_obj)
    {
        $query = "SELECT COUNT(*) FROM games WHERE teams = '$teams' AND bet = '$bet'";
        if ($result = $db_obj->query($query)) {
            if ($count = $result->fetch_array()) {
                //Check if game is in db
                if (!$count[0]) {
                    $query = "SELECT COUNT(*) FROM games WHERE teams = '$teams'";
                    if ($result = $db_obj->query($query)) {
                        if ($count = $result->fetch_array()) {
                            if ($count[0] < 3) {
                                $this->dbAdd($values . "1)", $db_obj);
                            }
                        }
                    }
                }
            }
        }
    }
    
    //Function delete games from database if `datetime` is past
    public function dbTimeFilter($db_obj)
    {
        $query =  "DELETE FROM games WHERE `datetime` < CURTIME()";
        if (!$db_obj->query($query)) {
            echo "dbTimeFilter error";
        }
    }

    //Function delete all games which have  set `print` flag for update valubets
    public function dbPrintFilter($db_obj)
    {
        $query =  "DELETE FROM games WHERE `print` = 1";
        if (!$db_obj->query($query)) {
            echo "dbPrintFilter error";
        }
    }        
}
