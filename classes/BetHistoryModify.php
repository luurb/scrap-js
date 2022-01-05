<?php

namespace classes;

//Class for modifing bet_history table 
class BetHistoryModify extends IDbInit
{

    //Function return record from database to modify
    public function getRecord($id)
    {
        $db_obj = $this->dbConnect();
        $query = "SELECT bet_id, bookiename, sportname, `datetime`, teams, bet, odd, `value`, stake, `result`, `return` FROM bet_history ";
        $query .= "INNER JOIN bookie ON bet_history.bookmakerid = bookie.id INNER JOIN sport ON bet_history.sportid = sport.id WHERE bet_id = $id";
        if ($result = $db_obj->query($query)) {
            $result = $result->fetch_array();
            $db_obj->close();
            return $result;
        }
        $db_obj->close();
    }

    //Function update database with modify values (array) from user.
    public function updateDb($values)
    {
        $db_obj = $this->dbConnect();
        $values = $this->delBadCharacters($db_obj, $values);
        $query = "UPDATE bet_history SET bet = '$values[1]', odd = $values[2], `value` = $values[3], stake = $values[4],"; 
        $query .= " result = '$values[5]', `return` = $values[6] WHERE bet_id = $values[0]";
        echo $query . "<br />";
        if (!$db_obj->query($query)) {
            echo "error";
        }
        $db_obj->close();
    }

    //Function delete game with $id from bet_history table
    public function delete($arr)
    {
        $db_obj = $this->dbConnect();
        foreach ($arr as $id) {
            $query = "DELETE FROM bet_history WHERE bet_id = $id";
            if (!$db_obj->query($query)) {
                echo "error BetHistoryMOdify delete";
                
            } 
        }
        $db_obj->close();
    }

    //Function delete html entities and special charackets from values in table
    public function delBadCharacters($db_obj, $arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i] = htmlentities($arr[$i], ENT_QUOTES, "UTF-8");
            $arr[$i] = $db_obj->real_escape_string($arr[$i]);
        }
        return $arr;
    }
}
