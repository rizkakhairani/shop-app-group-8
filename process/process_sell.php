<?php
require_once __DIR__ . '/../classes/SellController.php';
require_once __DIR__ . '/../db/connection.php';

$sellController = new SellController($connection);

// Check if the form is submitted for creating or updating permissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if customer_id is provided (if it's an edit operation)
    if (isset($_POST["sell_id"])) {
        $sellId = $_POST["sell_id"];
        $total = $_POST['total'];
        $price = $_POST['price'];
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];



        // Call the createSell method in SellController
        if ($sellController->updateSell($sellId, $total, $price, $product_id, $customer_id)) {
            // Sell created successfully, redirect to manage_sells.php
            header("Location: ../public/manage_sell.php");
            exit();
        } else {
            echo "Error updating sell.";
        }
    } else {
        $total = $_POST['total'];
        $price = $_POST['price'];
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];


        // Call the createSell method in SellController
        if ($sellController->createSell($total, $price, $product_id, $customer_id)) {
            // Sell created successfully, redirect to manage_sells.php
            header("Location: ../public/manage_sell.php");
            exit();
        } else {
            echo "Error creating sell.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editSellId = $_GET["edit"];

        // Retrieve the sell data for editing
        $sell = $sellController->getSellById($editSellId);

        if ($sell) {
            $editSell = $sell;
        }
    } elseif (isset($_GET["delete"])) {
        $sellId = $_GET["delete"];

        // Delete the sell
        if ($sellController->deleteSell($sellId)) {
            // Redirect to manage_permission.php after successful deletion
            header("Location: ../public/manage_sell.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting sell.";
        }
    }
}

$sells = $sellController->getAllSells();

?>
