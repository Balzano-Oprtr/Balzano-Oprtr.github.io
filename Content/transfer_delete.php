<?php
include("../condb.php");

$id = $_POST["transferIDU"];

$sql = "DELETE FROM transfer WHERE ID = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute(array($id));
    
if ($result) {
    header('Location: ../money.php');
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[0] . " - " . $errorInfo[1] . " - " . $errorInfo[2];
}
?>
