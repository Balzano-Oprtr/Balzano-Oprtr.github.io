<?php
include("../condb.php");

$id = $_POST["expenseIDU"];
$total = $_POST["expenseTotalU"];
$account = $_POST["expenseAccountU"];

$sql = "SELECT Total FROM assets WHERE Account = ?";
$stmt = $db->prepare($sql);
$currentRow = $stmt->execute(array($account));
$currentRow = $stmt->fetch(PDO::FETCH_ASSOC);
$currentvalue = $currentRow["Total"];

$newCash = $currentvalue + $total;
echo $newCash  . "\n";
echo $currentvalue  . "\n";
echo $total  . "\n";

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "DELETE FROM expense WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
