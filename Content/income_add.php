<?php
include("../condb.php");


$date = $_POST["incomeDateTime"];
$account = $_POST["incomeAccount"];
$category = $_POST["incomeCategory"];
$total = $_POST["incomeTotal"];
$note = $_POST["incomeNote"];

$formattedDate = date("Y-m-d H:i:s", strtotime($date));

$sql = "SELECT Total FROM assets WHERE Account = ?";
$stmt = $db->prepare($sql);
$currentRow = $stmt->execute(array($account));
$currentRow = $stmt->fetch(PDO::FETCH_ASSOC);
$currentvalue = $currentRow["Total"];

$newCash = $currentvalue + $total;

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "INSERT INTO income (Date, Account, Category, Total, Note) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($formattedDate, $account, $category, $total, $note));

if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
