<?php
class PrintValuebets{

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
        public function printResults($db_obj)
        {
        ?>
        <form  method="GET" action="filter.php">
        <table>
            <thead>
                <tr>
                    <th scope="colgroup" class="id-col"><span>ID</span></th>
                    <th scope="colgroup" class="bookie-col"><span>Bookmaker</span></th>
                    <th scope="colgroup"><span>Sport</span></th>
                    <th scope="colgroup"><span>Date and time</span></th>
                    <th scope="colgroup"><span>Teams</span></th>
                    <th scope="colgroup"><span>Bet</span></th>
                    <th scope="colgroup"><span>Odd</span></th>
                    <th scope="colgroup"><span>Value [%]</span></th>
                    <th scope="colgroup">
                        <input type="submit" value="Add/Delete" class="filter_button">
                    </th>
                </tr>
            </thead>
            <?php
                //Print values from every game in vector and add checkbox with option to add or delete game
                $query = "SELECT bookiename, sportname, `datetime`, teams, bet, odd, `value`, `print` FROM games INNER JOIN bookie ON games.bookmakerid = bookie.id ";
                $query .= "INNER JOIN sport ON games.sportid = sport.id ORDER BY `value` DESC";
                if ($result = $db_obj->query($query)) {
                    $iter = 0;
                    while ($row = $result->fetch_array()):
                        if ($row['print'] && $this->filterResults($row['bet'])):
                            ++$iter;?>
                                <tbody>
                                    <tr>
                                        <td class="id-col"><?=$iter?></td>
                                        <td class="bookie-col"><?=$row['bookiename']?></td>
                                        <td class="sport-col"><span><?=$row['sportname']?></span></td>
                                        <td><?=$row['datetime']?></td>
                                        <?php $var = explode(" ", $row['teams'])?>
                                        <td class="teams-col"><a href="https://www.oddsportal.com/search/<?=$var[0]?>/" target="_blank"><?=$row['teams']?></a></td>
                                        <td><?=$row['bet']?></td>
                                        <td class="odd-col"><?=$row['odd']?></td>
                                        <td><?=$row['value']?></td> 
                                        <td>
                                            <label>
                                                <input type="checkbox" value="<?=$row['teams'] . "$" . $row['bet']?>" name="add[]" class="add-checkbox">
                                                <span class="add-delete-btn">Add</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="<?=$row['teams'] . "$" . $row['bet']?>" name="del[]" class="del-checkbox">
                                                <span class="add-delete-btn">Delete</span>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>          
                <?php   endif;
                    endwhile;
                }
                else{
                    echo "error888";
                }
                ?>
        </table>
        </form>
        
<?php
    }
}
?>