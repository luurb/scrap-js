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
                        
                        if (!isset($_SESSION['filter'])) {
                            $_SESSION['filter'] = 0;
                        }
                        $main = new Main($_SESSION['filter']);
                        $main->printResults();
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
                <span class="wrapper-header">Filters</span>
                <div class="stats-wrapper">
                    <div class="stat-box">
                        <?php $main->printButton(); ?>
                    </div>
                </div>
            </div>
        </aside>
    </section>
    <?php include('html/footer.html'); ?>
</body>
</html>
