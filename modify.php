<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9369359bc2.js" crossorigin="anonymous"></script>
    <title>Bet modify</title>
    <?php include('includes/html/css.html'); ?>
</head>
<body>
    <?php include('includes/html/header.html'); ?>
        <main class="main">
            <div class="nav-box"></div>
            <section class="main-table">
                <div class="main-table__wrapper">
                    <?php
                        
                        require_once('autoload.php');
                        
                        if (isset($_GET['submit'])):
                            $modify = new classes\BetHistoryModify();
                            $record = $modify->getRecord($_GET['submit']);
                        ?>
                    <form  method="GET" action="db_modify.php">
                        <table class="main-table__table main-table__add-table">
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
                                    <td>
                                        <input type="hidden" value="<?=$record['bet_id']?>" name="bet_id"><?=$record['bet_id']?>
                                    </td>
                                    <td><?=$record['bookiename']?></td>
                                    <td><?=$record['sportname']?></td>
                                    <td><?=$record['datetime']?></td>
                                    <td><?=$record['teams']?></td>
                                    <td><input type="text" name="bet" value="<?=$record['bet']?>" class="main-table__input"></td>                            
                                    <td><input type="text" name="odd" value="<?=$record['odd']?>" class="main-table__input"></td>
                                    <td><input type="text" name="value" value="<?=$record['value']?>" class="main-table__input"></td>      
                                    <td><input type="text" name="stake" value="<?=$record['stake']?>" class="main-table__input"></td>      
                                    <td>
                                        <select name="result" class="main-table__select">
                                            <option value="-">-</option>
                                            <option value="1">1</option>
                                            <option value="0">0</option>
                                        </select>   
                                    </td>      
                                    <td><?=$record['return']?></td>      
                                    <td>
                                        <input type="submit" value="Modify" name="submit" class="main-table__button">
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
            <section class="filters">
            </section>
        </main>
   <?php include('includes/html/footer.html'); ?>
</body>
</html>
