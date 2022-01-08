<?php

namespace classes;

//Class with methods for operation on bet_history database.
class BetHistoryPrint extends IDbInit
{
    //Function print history bets which user add to database
    public function printResults(){ ?>
        <form  method="GET" action="delete.php">
            <table class="main-table__table main-table__history-table">
                <thead>
                    <tr>
                        <th scope="colgroup">ID</th>
                        <th scope="colgroup">Bookmaker</th>
                        <th scope="colgroup">Sport</th>
                        <th scope="colgroup">Date and time</th>
                        <th scope="colgroup">Teams></th>
                        <th scope="colgroup">Bet</th>
                        <th scope="colgroup">Odd</th>
                        <th scope="colgroup">Value [%]</th>
                        <th scope="colgroup">Stake</th>
                        <th scope="colgroup">Result</th>
                        <th scope="colgroup">Return</th>
                        <th scope="colgroup">
                            <input type="submit" value="Delete" class="main-table__button">
                        </th>
                        <th scope="colgroup"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $db_obj = $this->dbConnect();
                $query = "SELECT bet_id, bookiename, sportname, `datetime`, teams, bet, odd, `value`, stake, `result`, `return`";
                $query .= " FROM bet_history INNER JOIN bookie ON bet_history.bookmakerid = bookie.id INNER JOIN sport ON bet_history.sportid = sport.id ORDER BY bet_id DESC LIMIT 50";
                if ($result = $db_obj->query($query)): $iter = 0;
                    while($row = $result->fetch_array()): 
                    ++$iter;
                    $class = $this->getClass($row['result']);
                    ?>
                    <tr class="<?=$class?>">
                        <td><?=$iter?></td>
                        <td><?=$row['bookiename']?></td>
                        <td><span class="main-table__sport-span"><?=$row['sportname']?></span></td>
                        <td><?=$row['datetime']?></td>
                        <td><?=$row['teams']?></td>
                        <td><?=$row['bet']?></td>
                        <td><?=$row['odd']?></td>
                        <td><?=$row['value']?></td> 
                        <td><?=$row['stake']?></td> 
                        <td><?=$row['result']?></td> 
                        <td><?=$row['return']?></td> 
                        <td>
                            <label>
                                <input type="checkbox" value="<?=$row['bet_id']?>" name="del[]" class="main-table__checkbox--del none">
                                <span class="main-table__span">Del</span>
                            </label>
                        </td>
                        </form>
                        <td>
                            <form method="GET" action="modify.php">
                                <button type="submit" value="<?=$row['bet_id']?>" name="submit" class="main-table__button">Mod</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile;
                endif;
                $db_obj->close();
                ?>
                </tbody>         
            </table>
            <?php
    }

    //Function return class name specific by result value from bet_history table
    public function getClass($result)
    {
        switch($result){
            case 0:
                $class = "main-table__tr main-table__tr--lose";
                break;
            case 1:
                $class = "main-table__tr main-table__tr--win";
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