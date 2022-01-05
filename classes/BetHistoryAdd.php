<?php

namespace classes;

//Class for adding custom games to bet history table
class BetHistoryAdd extends IDbInit
{

    //Function returns bookies or sport names and ids as <option></option> from table
    public function getOptions($table_name)
    {
        $db_obj = $this->dbConnect();
        $query = "SELECT *FROM $table_name";
        if ($result = $db_obj->query($query)) {
            while($row = $result->fetch_array()){
                echo "<option value=" ."'$row[0]'" . ">$row[1]</option>";//bookie id
            }
        } else {
            echo "<option></option>";
        }
        $db_obj->close();
    }

    public function newGameAdd($arr)
    {
        $db_obj = $this->dbConnect();
        require_once("./classes/BetHistoryModify.php");
        $modify = new BetHistoryMOdify();
        $arr = $modify->delBadCharacters($db_obj, $arr);
        $query = "INSERT INTO bet_history VALUES (0, $arr[0], $arr[1], '$arr[2]', ";
        $query .= "'$arr[3]', '$arr[4]', $arr[5], $arr[6], $arr[7], '$arr[8]', $arr[9])";
        if (!$db_obj->query($query)) {
            setcookie('err_mess', "Can't add game to database");
        } else {
            setcookie('err_mess', "Added game to bet history");
        }
        $db_obj->close();
    }
}