<?php

//Class for filtering (or not) and printing results in child list from ScraperInit object.
class ScraperResults
{
    //Function return values for INSERT INTO games query.
    public function getValues($game, $db_obj)
    {
        $var = explode(" ", $game->item(0)->nodeValue);
        $bookie = $this->setForeignKey($var[0], "bookie", $db_obj);
        $sport = $var[1];
        if ($sport == "Dota" || $sport == "League of Legends" || $sport == "Counter-Strike"
            || $sport == "Valorant" || $sport == "Rainbow") {
            $sport = "Esport";
        }
        $sport =  $this->setForeignKey($sport, "sport", $db_obj);
        $var = $game->item(2)->nodeValue;
        $date_time = $this->setDateTime($db_obj, $var);
        $var = explode("[", $game->item(4)->nodeValue);
        $teams = $var[0];
        $bet = $game->item(6)->nodeValue;
        $odd = floatval($game->item(8)->nodeValue);
        $value = $game->item(14)->nodeValue;
        $value = rtrim($value, "%");
        $value = ltrim($value, "+");
        $value = floatval($value);

        $query = "($bookie, $sport, '$date_time' ,'$teams', '$bet', $odd, $value, ";
        return $query;
    }

    //Function return bookie or sport id or if value is not avalibe in database, function add it there.
    public function setForeignKey($value, $db_table, $db_obj)
    {
        $db_column = $db_table . "name";
        $query = "SELECT id FROM $db_table WHERE $db_column = '$value'";
        $result = $db_obj->query($query);
        if ($result) {
            $row = $result->fetch_array();
            if (!$row[0]) {
                $query = "INSERT INTO $db_table VALUES (0, '$value')";
                $db_obj->query($query);
                $this->setForeignKey($value, $db_table, $db_obj);
            } else {
                return intval($row[0]);
            }
        } else {
            echo "QUERY NOT WORK setForeignKey";
        }
    }   
    
    //30/0914:00
    public function setDateTime($db_obj, $value)
    {
        $day = substr($value, 0, 2);
        $month = substr($value, 3, 2);
        $time = substr($value, -5);   
        $query = "SELECT YEAR (CURDATE())";
        $year = $db_obj->query($query)->fetch_array();
        $date_time = $year[0] . "/" . $month . "/" . $day . " " . $time . ":00";   
        $query = "SELECT ADDTIME('$date_time', '1:00:00')";
        $date_time = $db_obj->query($query)->fetch_array();
        return $date_time[0];
    }  

}
