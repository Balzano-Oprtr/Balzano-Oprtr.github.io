<?php
include("../condb.php");

$id = $_POST["transferIDU"];
$from = $_POST["transferFromU"];
$to = $_POST["transferToU"];
$total = $_POST["transferTotalU"];
$note = $_POST["transferNoteU"];

$sql = "UPDATE transfer SET F = ?, T = ?, Total = ?, Note = ? WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($from, $to, $total, $note, $id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
