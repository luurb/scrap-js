<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet add</title>
    <?php include('includes/html/css.html'); ?>
</head>
<body>
    <?php include('includes/html/header.html'); ?>
    <main class="main">
        <div class="nav-box"></div>
        <section class="main-table">
            <div class="main-table__wrapper">
            <?php

                require_once ('autoload.php');
                
                $game_add = new \classes\BetHistoryAdd();
            ?>   
                <form action="php/add.php" method="GET">
                    <table class="main-table__table main-table__add-table">
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
                                    <select name="bookie" class="main-table__select">
                                        <?=$game_add->getOptions('bookie')?>
                                    </select>
                                </td>
                                <td>
                                    <select name="sport" class="main-table__select">
                                        <?=$game_add->getOptions('sport')?>
                                    </select>
                                </td>
                                <td><input type="date" name="date" class="main-table__input"></td>
                                <td><input type="time" name="time" class="main-table__input"></td>
                                <td><input type="text" name="teams" value="" class="main-table__input"></td>
                                <td><input type="text" name="bet" value="" class="main-table__input"></td>
                                <td><input type="text" name="odd" value="" class="main-table__input"></td>
                                <td><input type="text" name="value" value="" class="main-table__input"></td>
                                <td><input type="text" name="stake" value="" class="main-table__input"></td>
                                <td>
                                <select name="result" class="main-table__select">
                                    <option value="-">-</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select>   
                            </td> 
                                <td><input type="submit" value="Add" name="submit" class="main-table__button"></td>
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
        <section class="filters">
        </section>
    </main>
    <?php include('includes/html/footer.html'); ?> 
</body>
</html>
