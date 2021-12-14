<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet add</title>
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
                    $game_add = new BetHistoryAdd();
                ?>   
                    <form action="add.php" method="GET">
                        <table class="add-table">
                            <thead>
                                <tr>
                                    <th scope="colgroup">Bookmaker</th>
                                    <th scope="colgroup">Sport</th>
                                    <th scope="colgroup">Date</th>
                                    <th scope="colgroup">Time</th>
                                    <th scope="colgroup">Teams</th>
                                    <th scope="colgroup">Bet</th>
                                    <th scope="colgroup">Odd</th>
                                    <th scope="colgroup">Value [%]</th>
                                    <th scope="colgroup">Stake</th>
                                    <th scope="colgroup">Result</th>
                                    <th scope="colgroup"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="bookie" class="modify_textbox">
                                            <?=$game_add->getOptions('bookie')?>
                                        </select>
                                    </td>
                                    <td class="sport-col">
                                        <select name="sport" class="modify_textbox">
                                            <?=$game_add->getOptions('sport')?>
                                        </select>
                                    </td>
                                    <td><input type="date" name="date" class="modify_textbox"></td>
                                    <td><input type="time" name="time" class="modify_textbox"></td>
                                    <td class="teams-col"><input type="text" name="teams" value="" class="modify_textbox"></td>
                                    <td class="bet-col"><input type="text" name="bet" value="" class="modify_textbox"></td>
                                    <td class="odd-col"><input type="text" name="odd" value="" class="modify_textbox"></td>
                                    <td><input type="text" name="value" value="" class="modify_textbox"></td>
                                    <td><input type="text" name="stake" value="" class="modify_textbox"></td>
                                    <td>
                                    <select name="result" class="modify_textbox">
                                        <option value="-">-</option>
                                        <option value="1">1</option>
                                        <option value="0">0</option>
                                    </select>   
                                </td> 
                                    <td><input type="submit" value="Add" name="submit" class="modify-button"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <?php
                        /*if(isset($_COOKIE['err_mess'])){
                            echo $_COOKIE['err_mess'];
                            unset($_COOKIE['err_mess']);
                            setcookie('err_mess', null, -1);
                        } */
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
