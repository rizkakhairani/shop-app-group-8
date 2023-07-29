<?php
require_once __DIR__ . '/../classes/OrderController.php';
require_once __DIR__ . '/../db/connection.php';

$orderController = new OrderController($connection);

// Check if the form is submitted for creating or updating permissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if supplier_id is provided (if it's an edit operation)
    if (isset($_POST["order_id"])) {
        $orderId = $_POST["order_id"];
        $total = $_POST['total'];
        $price = $_POST['price'];
        $supplier_id = $_POST['supplier_id'];
        $product_id = $_POST['product_id'];

        // Call the createOrder method in OrderController
        if ($orderController->updateOrder($orderId, $total, $price, $product_id, $supplier_id)) {
            // Order created successfully, redirect to manage_orders.php
            header("Location: ../public/manage_order.php");
            exit();
        } else {
            echo "Error updating order.";
        }
    } else {
        $total = $_POST['total'];
        $price = $_POST['price'];
        $supplier_id = $_POST['supplier_id'];
        $product_id = $_POST['product_id'];


        // Call the createOrder method in OrderController
        if ($orderController->createOrder($total, $price, $product_id, $supplier_id)) {
            // Order created successfully, redirect to manage_orders.php
            header("Location: ../public/manage_order.php");
            exit();
        } else {
            echo "Error creating order.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editOrderId = $_GET["edit"];

        // Retrieve the order data for editing
        $order = $orderController->getOrderById($editOrderId);

        if ($order) {
            $editOrder = $order;
        }
    } elseif (isset($_GET["delete"])) {
        $orderId = $_GET["delete"];

        // Delete the order
        if ($orderController->deleteOrder($orderId)) {
            // Redirect to manage_permission.php after successful deletion
            header("Location: ../public/manage_order.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting order.";
        }
    }
}

$orders = $orderController->getAllOrders();

?>
