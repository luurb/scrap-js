<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet history</title>
    <?php include('includes/html/css.html'); ?>
</head>
<body>
    <script src="feed/scripts/add-icons.js"></script>
    <?php include('includes/html/header.html'); ?>
    <main class="main">
        <div class="nav-box"></div>
            <section class="main-table">
                <div class="main-table__wrapper">
                <?php

                     require_once('autoload.php');

                    $bet_history = new classes\BetHistoryPrint();
                    $bet_history_stats = new classes\BetHistoryStats();
                    $bet_history->printResults();
                    
                ?>   
                </div>
            </section>
        <section class="filters"> 
            <input type="checkbox" id="stat-check" class="none">
            <div class="filters__wrapper none">
                <label for="stat-check" class="filters__filters-icon" title="Show stats">
                    <i class="fas fa-cog none"></i>
                </label>
            </div>
            <div class="filters__options">
                <?php                                    
                    $return = round($bet_history_stats->getReturn(), 2); 
                    $yield = round($bet_history_stats->getYield($return), 2);
                    $avg_value = round($bet_history_stats->getAvgValue(), 2);

                    if (isset($_GET['submit'])) {
                        if (isset($_GET['first_date']) && isset($_GET['second_date'])) {
                            $_SESSION['first'] = $_GET['first_date'];
                            $_SESSION['second'] = $_GET['second_date'];
                            $_SESSION['second'] .=  " " . "23:59:59";
                            $_SESSION['first'] .= " " . "00:00:00";
                            $_SESSION['time_return'] = round($bet_history_stats->getTimeReturn($_SESSION['first'], $_SESSION['second']), 2);
                            $_SESSION['time_yield'] = round($bet_history_stats->getTimeYield($_SESSION['first'], $_SESSION['second'], $_SESSION['time_return']), 2);
                            $_SESSION['time_avg_value'] = round($bet_history_stats->getAvgTimeValue($_SESSION['first'], $_SESSION['second']), 2);
                        }
                    } else {
                        if (isset($_SESSION['first']) && isset($_SESSION['second'])) {
                            $_SESSION['time_return'] = round($bet_history_stats->getTimeReturn($_SESSION['first'], $_SESSION['second']), 2);
                            $_SESSION['time_yield'] = round($bet_history_stats->getTimeYield($_SESSION['first'], $_SESSION['second'], $_SESSION['time_return']), 2);
                            $_SESSION['time_avg_value'] = round($bet_history_stats->getAvgTimeValue($_SESSION['first'], $_SESSION['second']), 2);
                        } else {
                            $_SESSION['time_return'] = $return;
                            $_SESSION['time_yield'] = $yield;
                            $_SESSION['time_avg_value'] = $yield;
                        }  
                    }
                ?>
                <span class="filters__header">All time stats</span>
                <div class="filters__stats">
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Return</span>
                        <span class="filters__value"><?=$return;?></span>
                    </div>
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Yield</span>
                        <span class="filters__value"><?=$yield;?>%</span>
                    </div>
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Avg value</span>
                        <span class="filters__value"><?=$avg_value;?>%</span>
                    </div>
                </div>
                <span class="filters__header">Set time stats</span>
                <div class="filters__stats">
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Return</span>
                        <span class="filters__value"><?=$_SESSION['time_return'];?></span>
                    </div>
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Yield</span>
                        <span class="filters__value"><?=$_SESSION['time_yield'];?>%</span>
                    </div>
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Avg value</span>
                        <span class="filters__value"><?=$_SESSION['time_avg_value'];?>%</span>
                    </div>
                    <div class="filters__box">
                        <span class="ffilters__header filters__header--stat">Time range </span>
                        <form method="GET" action="bet_history.php">
                            <input type="date" name="first_date" class="filters__input">
                            <span class="ftilers__header filters__header--stat">/</span>
                            <input type="date" name="second_date" class="filters__input">
                            <input type="submit" name="submit" class="filters__button filters__submit">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('includes/html/footer.html'); ?> 
</body>
</html>
