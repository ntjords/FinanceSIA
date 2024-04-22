<?php
include 'connect.php';

if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    $sql = "DELETE FROM expenses WHERE expense_id = :delete_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: Finance.php");
    exit();
}
?>