<?php
include("../condb.php");

$id = $_POST["incomeIDU"];
$total = $_POST["incomeTotalU"];
$account = $_POST["incomeAccountU"];

$sql = "SELECT Total FROM assets WHERE Account = ?";
$stmt = $db->prepare($sql);
$currentRow = $stmt->execute(array($account));
$currentRow = $stmt->fetch(PDO::FETCH_ASSOC);
$currentvalue = $currentRow["Total"];

$newCash = $currentvalue - $total;

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "DELETE FROM income WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
