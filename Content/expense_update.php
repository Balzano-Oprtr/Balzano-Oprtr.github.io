<?php
include("../condb.php");

$id = $_POST["expenseIDU"];
$account = $_POST["expenseAccountU"];
$category = $_POST["expenseCategoryU"];
$total = $_POST["expenseTotalU"];
$other = $_POST["expenseTotalUO"];
$note = $_POST["expenseNoteU"];

$sql = "SELECT Total FROM assets WHERE Account = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($account));
$currentvalue = $stmt->fetchColumn();

$t = intval($total);
$o = intval($other);

echo $currentvalue . "\n";
echo $t . "\n";
echo $o . "\n";

if($t > $o){
    $newCash = $currentvalue + ($t - $o);
}else{
    $newCash = $currentvalue + ($o - $t);
}

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "UPDATE expense SET Account = ?, Category = ?, Total = ?, Note = ? WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($account, $category, $total, $note, $id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
