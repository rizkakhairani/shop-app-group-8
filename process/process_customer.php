<?php
require_once __DIR__ . '/../classes/CustomerController.php';
require_once __DIR__ . '/../db/connection.php';

$customerController = new CustomerController($connection);

// Check if the form is submitted for creating or updating customers
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if customer_id is provided (if it's an edit operation)
    if (isset($_POST["customer_id"])) {
        
        $customerId = $_POST["customer_id"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        // Update the existing customer
        if ($customerController->updateCustomer($customerId, $name, $phone, $address)) {
            // Redirect to manage_customer.php after successful update
            header("Location: ../public/manage_customer.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error updating customer.";
        }
    } else {
        // It's a new customer, create it

        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        if ($customerController->createCustomer($name, $phone, $address)) {
            // Redirect to manage_customer.php after successful creation
            header("Location: ../public/manage_customer.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error creating customer.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editCustomerId = $_GET["edit"];

        // Retrieve the customer data for editing
        $customer = $customerController->getCustomerById($editCustomerId);

        if ($customer) {
            $editCustomer = $customer;
        }
    } elseif (isset($_GET["delete"])) {
        $deleteCustomerId = $_GET["delete"];

        // Delete the customer
        if ($customerController->deleteCustomer($deleteCustomerId)) {
            // Redirect to manage_customer.php after successful deletion
            header("Location: ../public/manage_customer.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting customer.";
        }
    }
}

// Retrieve all customers for displaying in the table
$customers = $customerController->getAllCustomers();

?>
