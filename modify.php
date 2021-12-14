<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet modify</title>
    <?php include('html/css.html'); ?>
</head>
<body>
    <?php include('html/header.html'); ?>
    <section class="section">
        <main>
            <div class="nav-box"></div>
            <section>
                    <div class="table-wrapper">
                        <?php
                            function adding_class($class_name)
                            {
                                require "./classes/$class_name.php";
                            }
                            spl_autoload_register('adding_class');
                            
                            if (isset($_GET['submit'])):
                                $modify = new BetHistoryModify();
                                $record = $modify->getRecord($_GET['submit']);
                            ?>
                            <form  method="GET" action="db_modify.php">
                                <table class="add-table">
                                    <thead>
                                        <tr>
                                            <th scope="colgroup" class="id-col">Id</th>
                                            <th scope="colgroup">Bookmaker</th>
                                            <th scope="colgroup">Sport</th>
                                            <th scope="colgroup">Date and time</th>
                                            <th scope="colgroup">Teams</th>
                                            <th scope="colgroup">Bet</th>
                                            <th scope="colgroup">Odd</th>
                                            <th scope="colgroup">Value [%]</th>
                                            <th scope="colgroup">Stake</th>
                                            <th scope="colgroup">Result</th>
                                            <th scope="colgroup">Return</th>
                                            <th scope="colgroup"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="id-col">
                                                <input type="hidden" value="<?=$record['bet_id']?>" name="bet_id"><?=$record['bet_id']?>
                                            </td>
                                            <td><?=$record['bookiename']?></td>
                                            <td><?=$record['sportname']?></td>
                                            <td><?=$record['datetime']?></td>
                                            <td class="teams-col"><?=$record['teams']?></td>
                                            <td><input type="text" name="bet" value="<?=$record['bet']?>" class="modify_textbox"></td>                            
                                            <td><input type="text" name="odd" value="<?=$record['odd']?>" class="modify_textbox"></td>
                                            <td><input type="text" name="value" value="<?=$record['value']?>" class="modify_textbox"></td>      
                                            <td><input type="text" name="stake" value="<?=$record['stake']?>" class="modify_textbox"></td>      
                                            <td>
                                                <select name="result" class="modify_textbox">
                                                    <option value="-">-</option>
                                                    <option value="1">1</option>
                                                    <option value="0">0</option>
                                                </select>   
                                            </td>      
                                            <td><?=$record['return']?></td>      
                                            <td>
                                                <input type="submit" value="Modify" name="submit" class="modify_button">
                                            </td>
                                        </tr>
                                    </tbody> 
                                </table>
                            </form>
                            <?php
                            endif;
                        ?>   
                    </div>
            </section>
        </main>
        <aside>
        </aside>
    </section>
   <?php include('html/footer.html'); ?>
</body>
</html>
