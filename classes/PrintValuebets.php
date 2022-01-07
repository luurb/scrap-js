<?php

namespace classes;

class PrintValuebets
{
    //Filter bets with key words.
    public function filterResults($bet)
    {
        //Filter results (deleteing all bets with corners, fouls, shots and offsides). 
        if ($_SESSION['filter']) {
            if (strpos($bet, 'corners') || strpos($bet, 'fouls') || strpos($bet, 'shots') || strpos($bet, 'offsides') || strpos($bet, 'throw')) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    //Function for printing values in the table.
    public function printResults()
    {
        ?>
        <table class="main-table__table main-table__valuebets-table">
            <thead>
                <tr>
                    <th scope="colgroup">ID</th>
                    <th scope="colgroup">Bookmaker</th>
                    <th scope="colgroup">Sport</th>
                    <th scope="colgroup">Date and time</th>
                    <th scope="colgroup">Teams</th>
                    <th scope="colgroup">Bet</th>
                    <th scope="colgroup">Odd</th>
                    <th scope="colgroup">Value [%]</th>
                    <th scope="colgroup">
                        <input type="submit" value="Add/Delete" class="main-table__button">
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>  
        </table>
<?php
    }
}
