<?php
include 'connect.php';

if(isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    echo "Edit button clicked for expense ID: $edit_id";
    exit();
}
?>