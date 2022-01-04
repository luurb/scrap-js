<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Valuescrap</title>
    <?php include('html/css.html'); ?>
</head>
<body>
    <script src="scripts/add_icons.js"></script>
    <script src="scripts/stat-filter.js" defer></script>
    <script src="feed/scripts/fetch.js"></script>

    <?php include('html/header.html'); ?>
    <main class="main">
        <div class="nav-box"></div>
        <section class="main-table">
            <div class="main-table__wrapper">
                <?php
                    function adding_class($class_name)
                    {
                        require "./classes/$class_name.php";
                    }
                    spl_autoload_register('adding_class');
                    
                    if (!isset($_SESSION['filter'])) {
                        $_SESSION['filter'] = 0;
                    }
                    $main = new Main($_SESSION['filter']);
                    $main->printResults();
                ?>   
            </div>
        </section> 
        <section class="filters">
            <div class="filters__wrapper none">
                <label for="stat-check" class="stat-filter" title="Show stats">
                    <input type="checkbox" id="stat-check" class="none">    
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
            </div>
        </section>
    </main>
    <?php include('html/footer.html'); ?>
</body>
</html>
