<?php
include 'connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM expenses");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($logs as $log) {
        echo "<tr>";
        echo "<td>" . $log['expense_id'] . "</td>";
        echo "<td>" . $log['expense_type'] . "</td>";
        echo "<td>" . $log['product_name'] . "</td>";
        echo "<td>" . $log['amount'] . "</td>";
        echo "<td>" . $log['date_time'] . "</td>";
        echo "<td><button class='edit-btn'><i class='bi bi-pencil-square'></i></button><button class='remove-btn' style='background-color: red;'><i class='bi bi-trash3'></i></button></td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
