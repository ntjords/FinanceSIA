<?php
include 'connect.php';
include 'delete.php';
include 'edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Finance.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>Document</title>
</head>
<body>

<div class="overview">

    <div class="sidebar">
        <div class="title"><br>
            <h1> Tech Talk</h1>
        </div>
        <div class="nav-selector">
            <ul>
                <li><a href=""><i class="bi bi-columns-gap"></i> Dashboard</a></li>
                <li><a href=""><i class="bi bi-bell"></i> Notification</a></li>
                <li><a href=""><i class="bi bi-clipboard-data"></i> Sales</a></li>
                <li><a href=""><i class="bi bi-boxes"></i> Inventory</a></li>
                <li><a href=""><i class="bi bi-cash-coin"></i> Finance</a></li>
                <li><a href=""><i class="bi bi-tag"></i> Purchase Order</a></li>
                <li><a href=""><i class="bi bi-person-vcard"></i> Human Resources</a></li>
                <br> <br>
                <li><a href=""><i class="bi bi-box-arrow-left"></i> Log Out</a></li>
            </ul>
        </div> <br><br>

        <div class="external-link">

            <div class="contact">
                <a href=""> Contact Us </a>
            </div>

            <div class="About">
                <a href=""> About Us</a>

            </div>

            <div class="Soc-Media">
                <ul>
                    <li><a href=""><i class="bi bi-envelope-at-fill"></i></a></li>
                    <li><a href=""><i class="bi bi-facebook"></i></a></li>
                    <li><a href=""><i class="bi bi-twitter"></i></a></li>
                </ul>

            </div>

            <div class="Why-Us">
                <a href="">Why Us?</a>
            </div>

        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="title">
            <h1><i class="bi bi-cash-coin"></i>Finance</h1>
        </div>
        <!-----------EDITABLE CONTENT ( YUNG MALAKING PUTI SA LOOB)--------->
            <div class="editable-content">
               
                <div class="tables">
                    <table class="profit-table">
                        <h2><i class="bi bi-bank"></i>Profit</h2>
                        <th><i class="bi bi-wallet-fill"></i> Today</th>
                        <th><i class="bi bi-wallet-fill"></i> Monthly</th>
                        <tr>
                            <td>123</td>
                            <td>123</td>
                        </tr>
                    </table>

                    <h2><i class="bi bi-wallet2"></i>Expenses</h2>
<table class="expenses-table">
    <thead>
        <th><i class="bi bi-wallet-fill"></i> Daily</th>
        <th><i class="bi bi-wallet-fill"></i> Monthly</th>
    </thead>
    <tbody>
        <?php
        // Dito ang calcualte
        try {
            //  Dito ang  Retrieve total expenses sa database
            $totalExpenses = 0;
            $stmt = $pdo->query("SELECT SUM(amount) AS total FROM expenses WHERE expense_type != 'Salary Payout'");
            $totalRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalExpenses = $totalRow['total'];
            
            // dito ang Calculate monthly expenses
            $monthlyExpenses = $totalExpenses * 30; // editable
            
            // dito ang display total expenses
            echo "<tr>";
            echo "<td>{$totalExpenses}</td>";
            echo "<td>{$monthlyExpenses}</td>";
            echo "</tr>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </tbody>
</table>

                </table>

                <h2><i class="bi bi-person-fill"></i>Staff Salary</h2>
<table class="salary-table">
    <thead>
        <th><i class="bi bi-person-workspace"></i> 15 Days</th>
        <th><i class="bi bi-person-workspace"></i> Monthly</th>
        <th><i class="bi bi-cash-coin"></i> Payout</th> 
    </thead>
    <tbody>
        <?php
        // dito calculate and display total staff salary
        try {
            // eto Retrieve Data from the Database
            $stmt = $pdo->query("SELECT SUM(salary) AS total_salary FROM staff");
            $totalSalaryRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // eto calculate Total Salary
            $totalSalary = $totalSalaryRow['total_salary'];
            
            //  Display Total Salary
            
            $salaryPer15Days = $totalSalary / 2; 
            
            // dito nag rretrieve salary payout amount from the database
            $stmt = $pdo->query("SELECT SUM(amount) AS total_payout FROM expenses WHERE expense_type = 'Salary Payout'");
            $payoutRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalPayout = $payoutRow['total_payout'];
            
            // eto ang last calculated values
            echo "<tr>";
            echo "<td>{$salaryPer15Days}</td>";
            echo "<td>{$totalSalary}</td>";
            echo "<td>{$totalPayout}</td>";
            echo "</tr>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </tbody>
</table>
                </div>

                <div class="table-2">
                    <h3>Add Expenses</h3>
                    <form action="handle_expenses.php" method="POST">
    <label for="expense">Type of Expense:</label>
    <select name="expense" id="">
        <option value="Refunded Item">Refunded Item</option>
        <option value="Delivered Products">Delivered Products</option>
        <option value="Charged Item">Charged Item</option>
        <option value="Salary Payout">Salary Payout</option>
        <option value="Additional Expenses">Additional Expenses</option>
    </select>
    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name">
    <label for="amount">Enter Amount:</label>
    <input type="number" name="amount" min="0" required>
    <button type="submit">Submit</button>
</form>

                    <table class="table-logs">
                        <h1>Financial Logs</h1>
                        <th>ID</th>
                        <th>Expense Type</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                        <tr>
                            


      <!---------------END-------------------------------------------------->

        </div>
    </div>
</div>

    
</body>
</html>

<?php
include 'connect.php';

// Check if a request to delete an expense has been submitted
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    // Perform deletion operation here
    $sql = "DELETE FROM expenses WHERE expense_id = :delete_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    $stmt->execute();
    // dito mag redirect to Finance.php after deleting
    header("Location: Finance.php");
    exit();
}

try {
    $stmt = $pdo->query("SELECT * FROM expenses");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($logs as $log) {
        echo "<tr>";
        echo "<td>" . $log['expense_id'] . "</td>";
        echo "<td class='expense-type'>" . $log['expense_type'] . "</td>";
        echo "<td class='product-name'>" . $log['product_name'] . "</td>";
        echo "<td class='amount'>" . $log['amount'] . "</td>";
        echo "<td>" . $log['date_time'] . "</td>";
        echo "<td>
                <button type='button' class='edit-btn' onclick='editExpense(this)'><i class='bi bi-pencil-square'></i></button>
                <form action='Finance.php' method='post' style='display:inline;'>
                    <input type='hidden' name='delete_id' value='" . $log['expense_id'] . "'>
                    <button type='submit' class='remove-btn' style='background-color: red;'><i class='bi bi-trash3'></i></button>
                </form>
            </td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<script> //STACKOVERFLOW 
function editExpense(button) {
    var row = button.parentNode.parentNode;
    var expenseId = row.querySelector('td:first-child').textContent; // Get the expense ID from the first column
    var expenseType = row.querySelector('.expense-type');
    var productName = row.querySelector('.product-name');
    var amount = row.querySelector('.amount');

    // Convert expense type, product name, and amount to editable fields
    expenseType.innerHTML = "<input type='text' class='expense-type-edit' value='" + expenseType.textContent + "'>";
    productName.innerHTML = "<input type='text' class='product-name-edit' value='" + productName.textContent + "'>";
    amount.innerHTML = "<input type='number' class='amount-edit' value='" + amount.textContent + "'>";

    // Change edit button to save button
    button.innerHTML = "<i class='bi bi-check-square'></i>";
    button.setAttribute('onclick', 'saveExpense(this, ' + expenseId + ')');
}

function saveExpense(button, expenseId) {
    var row = button.parentNode.parentNode;
    var expenseType = row.querySelector('.expense-type-edit').value;
    var productName = row.querySelector('.product-name-edit').value;
    var amount = row.querySelector('.amount-edit').value;

    // Update the displayed values
    row.querySelector('.expense-type').textContent = expenseType;
    row.querySelector('.product-name').textContent = productName;
    row.querySelector('.amount').textContent = amount;

    // Change save button back to edit button
    button.innerHTML = "<i class='bi bi-pencil-square'></i>";
    button.setAttribute('onclick', 'editExpense(this)');

    // Send AJAX request to update the expense in the database
    // Include expenseId in the data sent to update_expense.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Display success message if the expense was updated successfully
            console.log("Expense updated successfully:", this.responseText);
        } else if (this.readyState == 4 && this.status != 200) {
            // Display error message if there was an issue updating the expense
            console.error("Error updating expense:", this.status, "-", this.responseText);
        }
    };
    xhttp.open("POST", "update_expense.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("expense_id=" + expenseId + "&expense_type=" + encodeURIComponent(expenseType) + "&product_name=" + encodeURIComponent(productName) + "&amount=" + amount);
}
</script>