<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['expense'], $_POST['product_name'], $_POST['amount'])) {
        $expenseType = $_POST['expense'];
        $productName = $_POST['product_name'];
        $amount = $_POST['amount'];
        $dateTime = date("Y-m-d H:i:s");

        try {
            
            $stmt = $pdo->prepare("INSERT INTO expenses (expense_type, product_name, amount, date_time) VALUES (?, ?, ?, ?)");
            $stmt->execute([$expenseType, $productName, $amount, $dateTime]);

            
            header("Location: Finance.php");
            exit();
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
