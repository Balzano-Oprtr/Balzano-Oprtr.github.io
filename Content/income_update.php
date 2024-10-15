<?php
include("../condb.php");

$id = $_POST["incomeIDU"];
$account = $_POST["incomeAccountU"];
$category = $_POST["incomeCategoryU"];
$total = $_POST["incomeTotalU"];
$other = $_POST["incomeTotalUO"];
$note = $_POST["incomeNoteU"];

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
    $newCash = $currentvalue - ($t - $o);
}else{
    $newCash = $currentvalue - ($o - $t);
}

$sql = "UPDATE assets SET Total = ? WHERE Account = ?";
$stmt = $db->prepare($sql);
$newvalue = $stmt->execute(array($newCash,$account));

$sql = "UPDATE income SET Account = ?, Category = ?, Total = ?, Note = ? WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($account, $category, $total, $note, $id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
