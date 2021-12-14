<?php

//Class for filtering data by adding it to bet_history table or deleting by setting right flag in db
class Filter extends IDbInit
{

    public function filter()
    {
        $db_obj = $this->dbConnect();
        if (isset($_GET["add"])){
            foreach ($_GET["add"] as $var) {
                $var = explode("$", $var);
                $teams = $var[0];
                $bet = $var[1];
                $query = "SELECT *FROM games WHERE teams = '$teams' AND bet = '$bet'"; 
                if($result = $db_obj->query($query)){
                    $row = $result->fetch_array();
                    $query = "INSERT INTO bet_history VALUES (0, $row[0], $row[1], '$row[2]', '$row[3]', '$row[4]', $row[5], '$row[6]', 1, '-', 0)";
                    echo $query . "<br />";
                    if(!$db_obj->query($query)){
                        echo "error 56";
                    }
                    $query = "UPDATE games SET `print` = 0 WHERE teams = '$teams' AND bet = '$bet'";
                    if(!$db_obj->query($query)){
                        echo "error 57";
                    }
                }
            }
        }
        if (isset($_GET["del"])) {
            foreach ($_GET["del"] as $var) {
                $var = explode("$", $var);
                $teams = $var[0];
                $bet = $var[1];
                $query = "UPDATE games SET `print` = 0 WHERE teams = '$teams' AND bet = '$bet'";
                if(!$db_obj->query($query)){
                    echo "error 58";
                }
            }
        }
        $db_obj->close();
    } 
}