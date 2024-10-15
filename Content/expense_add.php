<?php
include("../condb.php");

$date = $_POST["expenseDateTime"];
$account = $_POST["expenseAccount"];
$category = $_POST["expenseCategory"];
$total = $_POST["expenseTotal"];
$note = $_POST["expenseNote"];

$formattedDate = date("Y-m-d H:i:s", strtotime($date));

$sql = "SELECT Total FROM assets WHERE Account = ?";
$stmt = $db->prepare($sql);
$currentRow = $stmt->execute(array($account));
$currentRow = $stmt->fetch(PDO::FETCH_ASSOC);
$currentvalue = $currentRow["Total"];

$newCash = $currentvalue - $total;

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "INSERT INTO expense (Date, Account, Category, Total, Note, Invoice) VALUES (?, ?, ?, ?, ?, 0)";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($formattedDate, $account, $category, $total, $note));

if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
