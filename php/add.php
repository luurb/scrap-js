<?php
    header('Location: add_bet.php');


    if (isset($_GET['submit'])) {
        if ($_GET['result'] == "1" || $_GET['result'] == "0") {
            $return = $_GET['odd'] * $_GET['stake'] * intval($_GET['result']) -  $_GET['stake'];
        }
        else {
            $return = 0;
        } 
        $arr = array(
           $_GET['bookie'], 
           $_GET['sport'], 
           $_GET['date']. " " . $_GET['time'],
           $_GET['teams'],
           $_GET['bet'],
           $_GET['odd'],
           $_GET['value'],
           $_GET['stake'],
           $_GET['result'],
           $return
        );
       $game_add = new BetHistoryAdd();
       $game_add->newGameAdd($arr);
    }
?>