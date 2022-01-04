<?php

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
        <table class="main-table__table">
            <thead>
                <tr>
                    <th scope="colgroup"><span>ID</span></th>
                    <th scope="colgroup"><span>Bookmaker</span></th>
                    <th scope="colgroup"><span>Sport</span></th>
                    <th scope="colgroup"><span>Date and time</span></th>
                    <th scope="colgroup"><span>Teams</span></th>
                    <th scope="colgroup"><span>Bet</span></th>
                    <th scope="colgroup"><span>Odd</span></th>
                    <th scope="colgroup"><span>Value [%]</span></th>
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
