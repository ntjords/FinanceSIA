<?php
include 'connect.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $expenseId = $_POST['expense_id'];
    $expenseType = $_POST['expense_type'];
    $productName = $_POST['product_name'];
    $amount = $_POST['amount'];

    try {
        // Prepare SQL statement to update the expense
        $sql = "UPDATE expenses SET expense_type = :expense_type, product_name = :product_name, amount = :amount WHERE expense_id = :expense_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':expense_type', $expenseType, PDO::PARAM_STR);
        $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindParam(':expense_id', $expenseId, PDO::PARAM_INT);

        // Execute the SQL statement
        $stmt->execute();

        // Send a success response
        http_response_code(200);
        echo "Expense updated successfully";
    } catch (PDOException $e) {
        // Send an error response
        http_response_code(500);
        echo "Error updating expense: " . $e->getMessage();
    }
} else {
    // Send a method not allowed response if the request method is not POST
    http_response_code(405);
    echo "Method Not Allowed";
}
?>