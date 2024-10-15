<?php
include("condb.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Management</title>
    <link rel="stylesheet" type ="text/css" href="money.css">
    <script src="money.js"></script> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <form id="expense_add" method="post" action="money.php">
        <div class="popup" id="expensePopup">
            <div class="popup-content">
                <h1>Expense</h1>
                <div class="question">
                    <div class="name">
                        <label for="expenseDateTime">Date</label>
                    </div>
                    <div class="input">
                        <input type="datetime-local" id="expenseDateTime" name="expenseDateTime" step="1" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseAccount">Account</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseAccount" name="expenseAccount" required onclick="account('ADD','Expense')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseCategory">Category</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseCategory" name="expenseCategory" required onclick="category('Expense')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseTotal">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="expenseTotal" name="expenseTotal" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseNote">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseNote" name="expenseNote" required><br><br>
                    </div>
                </div>  
                <div class="question">
                    <input type="submit" value="Submit" onclick="add('expense')">
                    <button class = "close" onclick="closePopup('show')">Cancel</button>
                </div>  
            </div>
        </div>
        <div class="popupC" id="categoryExpense">
            <div class="popup-contentC">
                <?php
                $queryCE = "SELECT Category FROM categories WHERE Sign = 'E'";
                if ($stmtCE = $db->prepare($queryCE)) {
                    $stmtCE->execute();
                    $resultCE = $stmtCE->fetchAll();
                }
                foreach($resultCE as $rCE){ ?>
                <div class = "itemcategory" onclick="clickCategory('<?php echo $rCE["Category"]; ?>','ADD','expense','Expense')">
                    <span class = "categoryname"><?php echo $rCE["Category"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountExpense">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccount('<?php echo $rA["Account"]; ?>','ADD','expense','Expense')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
    <form id="income_add" method="post" action="money.php">
        <div class="popup" id="incomePopup">
            <div class="popup-content">
                <h1>Income</h1>
                <div class="question">
                    <div class="name">
                        <label for="incomeDateTime">Date</label>
                    </div>
                    <div class="input">
                        <input type="datetime-local" id="incomeDateTime" name="incomeDateTime" step="1" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeAccount">Account</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeAccount" name="incomeAccount" required onclick="account('ADD','Income')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeCategory">Category</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeCategory" name="incomeCategory" required onclick="category('Income')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeTotal">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="incomeTotal" name="incomeTotal" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeNote">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeNote" name="incomeNote" required><br><br>
                    </div>
                </div>  
                <div class="question">
                    <input type="submit" value="Submit" onclick="add('income')">
                    <button class = "close" onclick="closePopup('show')">Cancel</button>
                </div>  
            </div>
        </div>
        <div class="popupC" id="categoryIncome">
            <div class="popup-contentC">
                <?php
                $queryCI = "SELECT Category FROM categories WHERE Sign = 'I'";
                if ($stmtCI = $db->prepare($queryCI)) {
                    $stmtCI->execute();
                    $resultCI = $stmtCI->fetchAll();
                }
                foreach($resultCI as $rCI){ ?>
                <div class = "itemcategory" onclick="clickCategory('<?php echo $rCI["Category"]; ?>','ADD','income','Income')">
                    <span class = "categoryname"><?php echo $rCI["Category"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountIncome">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccount('<?php echo $rA["Account"]; ?>','ADD','income','Income')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </form>
    <form id="transfer_add" method="post" action="money.php">
        <div class="popup" id="transferPopup">
            <div class="popup-content">
                <h1>Transfer</h1>
                <div class="question">
                    <div class="name">
                        <label for="transferDateTime">Date</label>
                    </div>
                    <div class="input">
                        <input type="datetime-local" id="transferDateTime" name="transferDateTime" step="1" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferFrom">From</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferFrom" name="transferFrom" required onclick="accountT('ADD','From')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferTo">To</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferTo" name="transferTo" required onclick="accountT('ADD','To')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferTotal">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="transferTotal" name="transferTotal" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferNote">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferNote" name="transferNote" required><br><br>
                    </div>
                </div>  
                <div class="question">
                    <input type="submit" value="Submit" onclick="add('transfer')">
                    <button class = "close" onclick="closePopup('show')">Cancel</button>
                </div>      
            </div>
        </div>
        <div class="popupC" id="accountFrom">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccountT('<?php echo $rA["Account"]; ?>','ADD','From')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountTo">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccountT('<?php echo $rA["Account"]; ?>','ADD','To')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
    <form id="expense_update" method="post" action="money.php">
        <div class="popup" id="expensePopupU">
            <div class="popup-content">
                <h1>Expense</h1>
                <div class="question">
                    <div class="name">
                        <label for="expenseIDU"></label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseIDU" name="expenseIDU" hidden required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseTotalUO">O</label>
                    </div>
                    <div class="input">
                        <input type="number" id="expenseTotalUO" name="expenseTotalUO" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseAccountU">Account</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseAccountU" name="expenseAccountU" required onclick="account('UPDATE','Expense')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseCategoryU">Category</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseCategoryU" name="expenseCategoryU" required onclick="categoryU('Expense')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseTotalU">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="expenseTotalU" name="expenseTotalU" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="expenseNoteU">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="expenseNoteU" name="expenseNoteU" required><br><br>
                    </div>
                </div>  
                <div class="question">
                    <input type="submit" value="Submit" onclick="update('expense')">
                    <button class = "close" onclick="closePopup('!show')">Cancel</button>
                </div>  
                <div class="del">
                    <button class = "close1" onclick="confirm(event,'Expense')">Delete</button>
                </div>  
            </div>
        </div>
        <div class="popup1" id="confirmExpense">
            <div class="popup-content1">
                <div class="question">
                    <h2>Are you sure?</h2><br>
                </div>
                <div class="question">
                    <input type="submit" value="Yes" onclick="del('expense')">
                    <button class = "close" onclick="closePopup('!show')">No</button>
                </div>
            </div>
        </div>
        <div class="popupC" id="categoryExpenseU">
            <div class="popup-contentC">
                <?php
                $queryCE = "SELECT Category FROM categories WHERE Sign = 'E'";
                if ($stmtCE = $db->prepare($queryCE)) {
                    $stmtCE->execute();
                    $resultCE = $stmtCE->fetchAll();
                }
                foreach($resultCE as $rCE){ ?>
                <div class = "itemcategory" onclick="clickCategory('<?php echo $rCE["Category"]; ?>','UPDATE','expense','Expense')">
                    <span class = "categoryname"><?php echo $rCE["Category"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountExpenseU">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccount('<?php echo $rA["Account"]; ?>','UPDATE','expense','Expense')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
    <form id="income_update" method="post" action="money.php">
        <div class="popup" id="incomePopupU">
            <div class="popup-content">
                <h1>Income</h1>
                <div class="question">
                    <div class="name">
                        <label for="incomeIDU"></label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeIDU" name="incomeIDU" hidden required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeTotalU">O</label>
                    </div>
                    <div class="input">
                        <input type="number" id="incomeTotalUO" name="incomeTotalUO" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeAccountU">Account</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeAccountU" name="incomeAccountU" required onclick="account('UPDATE','Income')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeCategoryU">Category</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeCategoryU" name="incomeCategoryU" required onclick="categoryU('Income')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeTotalU">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="incomeTotalU" name="incomeTotalU" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="incomeNoteU">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="incomeNoteU" name="incomeNoteU" required><br><br>
                    </div>
                </div>  
                <div class="question">
                    <input type="submit" value="Submit" onclick="update('income')">
                    <button class = "close" onclick="closePopup('!show')">Cancel</button>
                </div>  
                <div class="del">
                    <button class = "close1" onclick="confirm(event,'Income')">Delete</button>
                </div>  
            </div> 
        </div>
        <div class="popup1" id="confirmIncome">
            <div class="popup-content1">
                <div class="question">
                    <h2>Are you sure?</h2><br>
                </div>
                <div class="question">
                    <input type="submit" value="Yes" onclick="del('income')">
                    <button class = "close" onclick="closePopup('!show')">No</button>
                </div>
            </div>
        </div>
        <div class="popupC" id="categoryIncomeU">
            <div class="popup-contentC">
                <?php
                $queryCI = "SELECT Category FROM categories WHERE Sign = 'I'";
                if ($stmtCI = $db->prepare($queryCI)) {
                    $stmtCI->execute();
                    $resultCI = $stmtCI->fetchAll();
                }
                foreach($resultCI as $rCI){ ?>
                <div class = "itemcategory" onclick="clickCategory('<?php echo $rCI["Category"]; ?>','UPDATE','income','Income')">
                    <span class = "categoryname"><?php echo $rCI["Category"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountIncomeU">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccount('<?php echo $rA["Account"]; ?>','UPDATE','income','Income')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
    <form id="transfer_update" method="post" action="money.php">
        <div class="popup" id="transferPopupU">
            <div class="popup-content">
            <h1>Transfer</h1>
                <div class="question">
                    <div class="name">
                        <label for="transferIDU"></label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferIDU" name="transferIDU" hidden required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferFromU">From</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferFromU" name="transferFromU" required onclick="accountT('UPDATE','From')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferToU">To</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferToU" name="transferToU" required onclick="accountT('UPDATE','To')"><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferTotalU">Total</label>
                    </div>
                    <div class="input">
                        <input type="number" id="transferTotalU" name="transferTotalU" required><br>
                    </div>
                </div>
                <div class="question">
                    <div class="name">
                        <label for="transferNoteU">Note</label>
                    </div>
                    <div class="input">
                        <input type="text" id="transferNoteU" name="transferNoteU" required><br><br>
                    </div>
                </div> 
                <div class="question">
                    <input type="submit" value="Submit" onclick="update('transfer')">
                    <button class = "close" onclick="closePopup('!show')">Cancel</button>
                </div>  
                <div class="del">
                    <button class = "close1" onclick="confirm(event,'Transfer')">Delete</button>
                </div> 
            </div>
        </div>
        <div class="popup1" id="confirmTransfer">
            <div class="popup-content1">
                <div class="question">
                    <h2>Are you sure?</h2><br>
                </div>
                <div class="question">
                    <input type="submit" value="Yes" onclick="del('transfer')">
                    <button class = "close" onclick="closePopup('!show')">No</button>
                </div>
            </div>
        </div>
        <div class="popupC" id="accountFromU">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccountT('<?php echo $rA["Account"]; ?>','UPDATE','From')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="popupC" id="accountToU">
            <div class="popup-contentC">
                <?php
                $queryA = "SELECT Account FROM assets";
                if ($stmtA = $db->prepare($queryA)) {
                    $stmtA->execute();
                    $resultA = $stmtA->fetchAll();
                }
                foreach($resultA as $rA){ ?>
                <div class = "itemaccount" onclick="clickAccountT('<?php echo $rA["Account"]; ?>','UPDATE','To')">
                    <span class = "accountname"><?php echo $rA["Account"]; ?></span>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="filter">
            <h1 class="web">Money Management</h1>
            <?php
            $month = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
            $currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
            $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
            
            $prevMonth = $currentMonth == 1 ? 12 : $currentMonth - 1;
            $prevYear = $currentMonth == 1 ? $currentYear - 1 : $currentYear;
            
            $nextMonth = $currentMonth == 12 ? 1 : $currentMonth + 1;
            $nextYear = $currentMonth == 12 ? $currentYear + 1 : $currentYear;
            ?>
            <div class="title">
                <a href="money.php?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>"><button class="prevNext"><</button></a>
                <span><?php echo $month[$currentMonth - 1];?> <?php echo $currentYear;?></span>
                <a href="money.php?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>"><button class="prevNext">></button></a>
            </div>
        </div>
        <button class="add-button" onclick="toggleDropdown()">
            <i class="material-icons">add</i>
        </button>
        <div class="dropdown" id="dropdown">
            <button onclick="showPopup('incomePopup')">Income</button>
            <button onclick="showPopup('expensePopup')">Expense</button>
            <button onclick="showPopup('transferPopup')">Transfer</button>
        </div>
        <div class="layout">
            <div class="IE">
                <?php
                $currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
                $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
                
                $totalIncome = 0;
                $queryIncomeTotal = "SELECT SUM(Total) AS total_income FROM income WHERE MONTH(date) = :month AND YEAR(date) = :year";
                $stmtIncomeTotal = $db->prepare($queryIncomeTotal);
                $stmtIncomeTotal->bindParam(':month', $currentMonth, PDO::PARAM_INT);
                $stmtIncomeTotal->bindParam(':year', $currentYear, PDO::PARAM_INT);
                $stmtIncomeTotal->execute();
                $totalIncome = $stmtIncomeTotal->fetchColumn();
    
                $totalExpense = 0;
                $queryExpenseTotal = "SELECT SUM(Total) AS total_expense FROM expense WHERE MONTH(date) = :month AND YEAR(date) = :year";
                $stmtExpenseTotal = $db->prepare($queryExpenseTotal);
                $stmtExpenseTotal->bindParam(':month', $currentMonth, PDO::PARAM_INT);
                $stmtExpenseTotal->bindParam(':year', $currentYear, PDO::PARAM_INT);
                $stmtExpenseTotal->execute();
                $totalExpense = $stmtExpenseTotal->fetchColumn();
                ?>
                <div class="income">Income: <br><?php echo '$' . number_format($totalIncome, 2); ?></div>
                <div class="expense">Expense: <br><?php echo '$' . number_format($totalExpense, 2); ?></div>
            </div>
            <div class="total">Total: <?php echo '$' . number_format($totalIncome - $totalExpense, 2); ?></div>
            <div class="data">
                <?php
                $query = "SELECT DISTINCT DATE(date) AS transaction_date FROM (
                            SELECT date FROM expense 
                            UNION ALL 
                            SELECT date FROM income
                            UNION ALL 
                            SELECT date FROM transfer
                        ) AS all_transactions 
                        WHERE MONTH(date) = :month AND YEAR(date) = :year
                        ORDER BY transaction_date DESC";
                if ($stmt = $db->prepare($query)) {
                    $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
                    $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
                    $stmt->execute();
                    $dates = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($dates as $date) {
                        $totalExpense = 0;
                        $totalIncome = 0;

                        $queryExpense = "SELECT * FROM expense WHERE Date(date) = ?";
                        if ($stmtExpense = $db->prepare($queryExpense)) {
                            $stmtExpense->execute([$date]);
                            $resultExpense = $stmtExpense->fetchAll();
                            foreach ($resultExpense as $expense) {
                                $totalExpense += $expense["Total"];
                            }
                        }

                        $queryIncome = "SELECT * FROM income WHERE Date(date) = ?";
                        if ($stmtIncome = $db->prepare($queryIncome)) {
                            $stmtIncome->execute([$date]);
                            $resultIncome = $stmtIncome->fetchAll();
                            foreach ($resultIncome as $income) {
                                $totalIncome += $income["Total"];
                            }
                        }

                        $queryTransfer = "SELECT * FROM transfer WHERE Date(date) = ?";
                        if ($stmtTransfer = $db->prepare($queryTransfer)) {
                            $stmtTransfer->execute([$date]);
                            $resultTransfer = $stmtTransfer->fetchAll();
                        }

                        ?>
                        <div class="day-transactions">
                            <div class="header">
                                <span class="date"><?php echo date('d M Y, D', strtotime($date)); ?></span>
                                <span class="total-expense"><?php echo '$' . number_format($totalExpense, 2); ?></span>
                            </div>
                            <hr>

                            <?php
                            foreach ($resultExpense as $expense) {
                            $other = $expense["Total"];
                            ?>
                            <div class="item" onclick="showPopupU('<?php echo $expense["Category"]; ?>', '<?php echo $expense["Note"]; ?>', '<?php echo $expense["Total"]; ?>', '<?php echo $expense["Account"]; ?>', '<?php echo $expense["ID"]; ?>','expense','<?php echo $other; ?>')">
                                <span class="category"><?php echo $expense["Category"]; ?></span>
                                <span class="description"><?php echo $expense["Note"]; ?></span>
                                <span class="amount"><?php echo '$' . $expense["Total"]; ?></span>
                            </div>
                            <?php
                            }

                            foreach ($resultIncome as $income) {
                            $other = $income["Total"];
                            ?>
                            <div class="item" onclick="showPopupU('<?php echo $income["Category"]; ?>', '<?php echo $income["Note"]; ?>', '<?php echo $income["Total"]; ?>', '<?php echo $income["Account"]; ?>', '<?php echo $income["ID"]; ?>','income','<?php echo $other; ?>')">
                                <span class="category"><?php echo $income["Category"]; ?></span>
                                <span class="description"><?php echo $income["Note"]; ?></span>
                                <span class="amount"><?php echo '$' . $income["Total"]; ?></span>
                            </div>
                            <?php
                            }

                            foreach ($resultTransfer as $transfer) {
                            $other = $transfer["Total"];
                            ?>
                            <div class="item" onclick="showPopupU('<?php echo $transfer["F"]; ?>', '<?php echo $transfer["Note"]; ?>', '<?php echo $transfer["Total"]; ?>', '<?php echo $transfer["T"]; ?>', '<?php echo $transfer["ID"]; ?>','transfer','<?php echo $other; ?>')">
                                <span class="category"><?php echo $transfer["F"]; ?> --> <?php echo $transfer["T"]; ?></span>
                                <span class="description"><?php echo $transfer["Note"]; ?></span>
                                <span class="amount"><?php echo '$' . $transfer["Total"]; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <a href="money.php"><span class="material-symbols-outlined">home</span></a>
        <a href="chart.php"><span class="material-symbols-outlined">monitoring</span></a>
        <a href="money.php"><span class="material-symbols-outlined">receipt_long</span></a>
        <a href="money.php"><span class="material-symbols-outlined">settings</span></a>
    </div>
</body>
</html>
