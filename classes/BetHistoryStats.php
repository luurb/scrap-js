<?php

class BetHistoryStats extends IDbInit{

    //Function return sum of `return` column from bet_history table
    public function getReturn(){
    $db_obj = $this->dbConnect();
    $return = 0;
    $query = "SELECT SUM(`return`) FROM bet_history";
    if($result = $db_obj->query($query)){
        $result = $result->fetch_array();
        $return = $result[0];
    }
    $db_obj->close();
    return $return;
}

public function getTimeReturn($first_date, $second_date){
    $db_obj = $this->dbConnect();
    $return = 0;
    $query = "SELECT SUM(`return`) FROM bet_history WHERE `datetime` > '$first_date' AND `datetime` < '$second_date'";
    if($result = $db_obj->query($query)){
        $result = $result->fetch_array();
        $return = $result[0];
    }
    $db_obj->close();
    return $return;
}

public function getYield($return){
    $db_obj = $this->dbConnect();
    $query = "SELECT SUM(`stake`) FROM bet_history WHERE `result` != '-'";
    if($result = $db_obj->query($query)){
        $sum = $result->fetch_array();
        if($sum[0]){
            $var = ($return / $sum[0]) * 100;
        }
        else{
            $var = 0;
        }
    }
    else{
        $var = 0;
    }
    $db_obj->close();
    return $var;
}

public function getTimeYield($first_date, $second_date, $return){
    $db_obj = $this->dbConnect();
    $query = "SELECT SUM(`stake`) FROM bet_history WHERE `result` != '-' AND `datetime` > '$first_date' AND `datetime` < '$second_date'";
    if($result = $db_obj->query($query)){
        $sum = $result->fetch_array();
        if($sum[0]){
            $var = ($return / $sum[0]) * 100;
        }
        else{
            $var = 0;
        }
    }
    else{
        $var = 0;
    }
    $db_obj->close();
    return $var;
}

public function getAvgValue(){
    $db_obj = $this->dbConnect();
    $query = "SELECT AVG(`value`) FROM bet_history";
    if($result = $db_obj->query($query)){
        $result = $result->fetch_array();
        $return = $result[0];
    }
    else{
        $return = 0;
    }
    $db_obj->close();
    return $return;
}

public function getAvgTimeValue($first_date, $second_date){
    $db_obj = $this->dbConnect();
    $query = "SELECT AVG(`value`) FROM bet_history WHERE `result` != '-' AND `datetime` > '$first_date' AND `datetime` < '$second_date'";
    if($result = $db_obj->query($query)){
        $result = $result->fetch_array();
        $return = $result[0];
    }
    else{
        $return = 0;
    }
    $db_obj->close();
    return $return;
}
}
?>