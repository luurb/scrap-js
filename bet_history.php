<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet history</title>
    <?php include('html/css.html'); ?>
</head>
<body>
    <script src="scripts/add_icons.js"></script>
    <script src="scripts/stat-filter.js" defer></script>
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
                    $bet_history = new BetHistoryPrint();
                    $bet_history_stats = new BetHistoryStats();
                    $bet_history->printResults();
                    
                ?>   
                </div>
            </section>
        </main>
        <aside>
            <input type="checkbox" id="stat-check">
            <div class="filter-wrapper">
                <label for="stat-check" class="stat-filter" title="Show stats">
                    <i class="fas fa-cog"></i>
                </label>
            </div>
            <div class="aside-option">
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
                <span class="wrapper-header">All time stats</span>
                <div class="stats-wrapper">
                    <div class="stat-box">
                        <span class="stat-header">Return</span>
                        <span class="stat-value"><?=$return;?></span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-header">Yield</span>
                        <span class="stat-value"><?=$yield;?>%</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-header">Avg value</span>
                        <span class="stat-value"><?=$avg_value;?>%</span>
                    </div>
                </div>
                <span class="wrapper-header">Set time stats</span>
                <div class="stats-wrapper">
                    <div class="stat-box">
                        <span class="stat-header">Return</span>
                        <span class="stat-value"><?=$_SESSION['time_return'];?></span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-header">Yield</span>
                        <span class="stat-value"><?=$_SESSION['time_yield'];?>%</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-header">Avg value</span>
                        <span class="stat-value"><?=$_SESSION['time_avg_value'];?>%</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-header">Time range </span>
                        <form method="GET" action="bet_history.php">
                            <input type="date" name="first_date">
                            <span class="stat-header">/</span>
                            <input type="date" name="second_date">
                            <input type="submit" name="submit" class="date-submit">
                        </form>
                    </div>
                </div>
            </div>
        </aside>
    </section>
    <?php include('html/footer.html'); ?> 
</body>
</html>
