<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/all.min.css">
    <title>Valuescrap</title>
    <?php include('includes/html/css.html'); ?>
    <?php include('includes/html/js.html'); ?>
</head>
<body>
    <?php include('includes/html/header.html'); ?>
    <main class="main">
        <div class="nav-box">
            <div class="nav-box__timer"></div>
        </div>
        <section class="main-table">
            <div class="main-table__wrapper">
                <?php
                
                    require_once('autoload.php');
                    
                    if (!isset($_SESSION['filter'])) {
                        $_SESSION['filter'] = 0;
                    }
                    $main = new classes\Main($_SESSION['filter']);
                    $main->printResults();
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
                <span class="filters__header">Filters</span>
                <div class="filters__stats">
                    <div class="filters__box">
                        <?php $main->printButton(); ?>
                    </div>
                </div>
                <span class="filters__header">Options</span>
                <div class="filters__stats">
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Refresh timeout</span>
                        <div class="filters__refresh-wrapper">
                            <span class="filters__refresh-iter">+</span>
                            <span class="filters__refresh-num">2</span>
                            <span class="filters__refresh-iter">-</span>
                        </div>
                        <button class="filters__button filters__submit filters__refresh">Refresh</button>
                    </div>
                </div>
                <span class="filters__header">Sorting</span>
                <div class="filters__stats">
                    <div class="filters__box">
                        <span class="filters__header filters__header--stat">Sorting options</span>
                        <div class="filters__sorting">
                            <select class="filters__select">
                                <option disabled selected hidden>Choose</option>
                                <option>Delay</option>
                                <option>Date</option>
                                <option>Odd</option>
                                <option>Value</option>
                            </select>
                            <span>
                                <i title="asceding" class="fa-solid fa-caret-up filters__caret"></i>
                                <i title="descending" class="fa-solid fa-caret-down filters__caret filters__caret-down"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('includes/html/footer.html'); ?>
</body>
</html>
