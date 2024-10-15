<?php
include("../condb.php");


$date = $_POST["transferDateTime"];
$from = $_POST["transferFrom"];
$to = $_POST["transferTo"];
$total = $_POST["transferTotal"];
$note = $_POST["transferNote"];

$formattedDate = date("Y-m-d H:i:s", strtotime($date));

$sql = "INSERT INTO transfer (Date, F, T, Total, Note) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($formattedDate, $from, $to, $total, $note));

if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
