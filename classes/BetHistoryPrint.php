<?php

//Class with methods for operation on bet_history database.
class BetHistoryPrint extends IDbInit
{
    //Function print history bets which user add to database
    public function printResults(){ ?>
        <form  method="GET" action="delete.php">
            <table class="v_table">
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
                        <th scope="colgroup"><span>Stake</span></th>
                        <th scope="colgroup" class="result-col">Result</th>
                        <th scope="colgroup"><span>Return</span></th>
                        <th scope="colgroup">
                            <input type="submit" value="Delete" class="filter_button">
                        </th>
                        <th scope="colgroup"></th>
                    </tr>
                </thead>
                <?php
                $db_obj = $this->dbConnect();
                $query = "SELECT bet_id, bookiename, sportname, `datetime`, teams, bet, odd, `value`, stake, `result`, `return`";
                $query .= " FROM bet_history INNER JOIN bookie ON bet_history.bookmakerid = bookie.id INNER JOIN sport ON bet_history.sportid = sport.id ORDER BY bet_id DESC LIMIT 100";
                if ($result = $db_obj->query($query)): $iter = 0;
                    while($row = $result->fetch_array()): 
                    ++$iter;
                    $class = $this->getClass($row['result']);
                    ?>
                <tbody class="<?=$class?>">
                    <tr>
                        <td class="id-col"><?=$iter?></td>
                        <td class="bookie-col"><?=$row['bookiename']?></td>
                        <td class="sport-col"><span><?=$row['sportname']?></span></td>
                        <td class="date-col"><?=$row['datetime']?></td>
                        <td class="teams-col"><?=$row['teams']?></td>
                        <td><?=$row['bet']?></td>
                        <td class="odd-col"><?=$row['odd']?></td>
                        <td><?=$row['value']?></td> 
                        <td><?=$row['stake']?></td> 
                        <td class="result-col"><?=$row['result']?></td> 
                        <td><?=$row['return']?></td> 
                        <td>
                            <label>
                                <input type="checkbox" value="<?=$row['bet_id']?>" name="del[]" class="del-checkbox">
                                <span class="add-delete-btn">Delete</span>
                            </label>
                        </td>
                        </form>
                        <td>
                            <form method="GET" action="modify.php">
                                <button type="submit" value="<?=$row['bet_id']?>" name="submit" class="modify_button">Modify</button>
                            </form>
                        </td>
                    </tr>
                </tbody> 
                <?php endwhile;
                endif;
                $db_obj->close();
                ?>         
            </table>
            <?php
    }

    //Function return class name specific by result value from bet_history table
    public function getClass($result)
    {
        switch($result){
            case 0:
                $class = "td-lose";
                break;
            case 1:
                $class = "td-win";
                break;
            case '-':
                $class = "td-unknown";
                break;
            default:
                $class = "td-unknown";
                break;
        }
        return $class;
    }

}
?>