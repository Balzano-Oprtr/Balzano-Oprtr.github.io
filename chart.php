<?php
include("condb.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Management</title>
    <link rel="stylesheet" type ="text/css" href="chart.css">
    <script src="chart.js"></script> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
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
                <a href="chart.php?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>"><button class="prevNext"><</button></a>
                <span><?php echo $month[$currentMonth - 1];?> <?php echo $currentYear;?></span>
                <a href="chart.php?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>"><button class="prevNext">></button></a>
            </div>
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
                <div class="income" onclick="showChart('Income')">Income: <br><?php echo '$' . number_format($totalIncome, 2); ?></div>
                <div class="expense" onclick="showChart('Expense')">Expense: <br><?php echo '$' . number_format($totalExpense, 2); ?></div>
            </div>
            <div class="data">
                <div class="account">
                    <h2>Account</h2>
                    <?php 
                        $sql = "SELECT Account FROM assets";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $allaccount = $stmt->fetchAll();
                        foreach($allaccount as $account){
                            $sql = "SELECT Total FROM assets WHERE Account = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([$account["Account"]]);
                            $accountvalue = $stmt->fetchColumn();
                    ?>
                        <div class="accountitem"><?php echo $account["Account"]?> : <?php echo $accountvalue?></div>
                    <?php
                        }
                    ?>
                </div>
                <div class = "chart_expense" id = "chart_expense">
                    <?php
                        $currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
                        $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y'); 
                        $queryChartExpense = "SELECT categories.Category, SUM(expense.Total) AS Total
                        FROM categories
                        JOIN expense ON categories.Category = expense.Category
                        WHERE categories.Sign = 'E' AND MONTH(expense.date) = :month AND YEAR(expense.date) = :year
                        GROUP BY categories.Category";
                        $stmtChartExpense = $db->prepare($queryChartExpense);
                        $stmtChartExpense->bindParam(':month', $currentMonth, PDO::PARAM_INT);
                        $stmtChartExpense->bindParam(':year', $currentYear, PDO::PARAM_INT);
                        $stmtChartExpense->execute();
                        $CE = $stmtChartExpense->fetchAll(PDO::FETCH_ASSOC);
                        $categories = [];
                        $percentages = [];
                        $total = [];
                    
                        foreach ($CE as $data) {
                            $category_name = $data["Category"];
                            $category_total = $data["Total"];
                            $percentage = ($category_total / $totalExpense) * 100;
                            $categories[] = $category_name;
                            $percentages[] = round($percentage);
                            $total[] = $category_total;
                        }
                    ?>   
                    <canvas id="expenseChart"></canvas>

                    <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        var ctx = document.getElementById('expenseChart').getContext('2d');
                        var expenseChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: <?php echo json_encode($categories); ?>,
                                datasets: [{
                                    label: 'Expense Categories',
                                    data: <?php echo json_encode($percentages); ?>,
                                    backgroundColor: [
                                        'rgba(139, 0, 0, 0.8)',   // Dark Red
                                        'rgba(0, 0, 139, 0.8)',   // Dark Blue
                                        'rgba(184, 134, 11, 0.8)', // Dark Goldenrod
                                        'rgba(34, 139, 34, 0.8)', // Forest Green
                                        'rgba(75, 0, 130, 0.8)',  // Indigo
                                        'rgba(139, 69, 19, 0.8)'  // Saddle Brown
                                    ],
                                    borderColor: [
                                        'rgba(139, 0, 0, 1)',   // Dark Red
                                        'rgba(0, 0, 139, 1)',   // Dark Blue
                                        'rgba(184, 134, 11, 1)', // Dark Goldenrod
                                        'rgba(34, 139, 34, 1)', // Forest Green
                                        'rgba(75, 0, 130, 1)',  // Indigo
                                        'rgba(139, 69, 19, 1)'  // Saddle Brown
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                var total = <?php echo json_encode($total); ?>;
                                                var label = tooltipItem.label || '';
                                                var value = tooltipItem.raw || 0;
                                                var totalValue = total[tooltipItem.dataIndex] || 0;
                                                return label + ': ' + value + '% ($' + totalValue + ')';
                                            }
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Expense Chart',
                                        font: {
                                            size: 20
                                        }
                                    }
                                }
                            },animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        });
                    });
                    </script>
                </div>
                <div class = "chart_income" id = "chart_income"  style="display:none;">
                    <?php
                        $queryChartIncome = "SELECT categories.Category, SUM(income.Total) AS Total
                        FROM categories
                        JOIN income ON categories.Category = income.Category
                        WHERE categories.Sign = 'I' AND MONTH(income.date) = :month AND YEAR(income.date) = :year
                        GROUP BY categories.Category";
                        $stmtChartIncome = $db->prepare($queryChartIncome);
                        $stmtChartIncome->bindParam(':month', $currentMonth, PDO::PARAM_INT);
                        $stmtChartIncome->bindParam(':year', $currentYear, PDO::PARAM_INT);
                        $stmtChartIncome->execute();
                        $CI = $stmtChartIncome->fetchAll(PDO::FETCH_ASSOC);
                        $categories1 = [];
                        $percentages1 = [];
                        $total1 = [];
                    
                        foreach ($CI as $data) {
                            $category_name = $data["Category"];
                            $category_total = $data["Total"];
                            $percentage = ($category_total / $totalIncome) * 100;
                            $categories1[] = $category_name;
                            $percentages1[] = round($percentage);
                            $total1[] = $category_total;
                        }
                    ?>   
                    <canvas id="incomeChart"></canvas>

                    <script>
                        document.addEventListener('DOMContentLoaded', (event) => {
                            var ctx = document.getElementById('incomeChart').getContext('2d');
                            var incomeChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo json_encode($categories1); ?>,
                                    datasets: [{
                                        label: 'Income Categories',
                                        data: <?php echo json_encode($percentages1); ?>,
                                        backgroundColor: [
                                            'rgba(139, 0, 0, 0.8)',   // Dark Red
                                            'rgba(0, 0, 139, 0.8)',   // Dark Blue
                                            'rgba(184, 134, 11, 0.8)', // Dark Goldenrod
                                            'rgba(34, 139, 34, 0.8)', // Forest Green
                                            'rgba(75, 0, 130, 0.8)',  // Indigo
                                            'rgba(139, 69, 19, 0.8)'  // Saddle Brown
                                        ],
                                        borderColor: [
                                            'rgba(139, 0, 0, 1)',   // Dark Red
                                            'rgba(0, 0, 139, 1)',   // Dark Blue
                                            'rgba(184, 134, 11, 1)', // Dark Goldenrod
                                            'rgba(34, 139, 34, 1)', // Forest Green
                                            'rgba(75, 0, 130, 1)',  // Indigo
                                            'rgba(139, 69, 19, 1)'  // Saddle Brown
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    var total = <?php echo json_encode($total1); ?>;
                                                    var label = tooltipItem.label || '';
                                                    var value = tooltipItem.raw || 0;
                                                    var totalValue = total[tooltipItem.dataIndex] || 0;
                                                    return label + ': ' + value + '% ($' + totalValue + ')';
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Income Chart',
                                            font: {
                                                size: 20
                                            }
                                        }
                                    }
                                },animation: {
                                    animateScale: true,
                                    animateRotate: true
                                }
                            });
                        });
                    </script>
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
