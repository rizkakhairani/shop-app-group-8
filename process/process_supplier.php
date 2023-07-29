<?php
require_once __DIR__ . '/../classes/SupplierController.php';
require_once __DIR__ . '/../db/connection.php';

$supplierController = new SupplierController($connection);

// Check if the form is submitted for creating or updating suppliers
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if supplier_id is provided (if it's an edit operation)
    if (isset($_POST["supplier_id"])) {
        
        $supplierId = $_POST["supplier_id"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        // Update the existing supplier
        if ($supplierController->updateSupplier($supplierId, $name, $phone, $address)) {
            // Redirect to manage_supplier.php after successful update
            header("Location: ../public/manage_supplier.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error updating supplier.";
        }
    } else {
        // It's a new supplier, create it

        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        if ($supplierController->createSupplier($name, $phone, $address)) {
            // Redirect to manage_supplier.php after successful creation
            header("Location: ../public/manage_supplier.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error creating supplier.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editSupplierId = $_GET["edit"];

        // Retrieve the supplier data for editing
        $supplier = $supplierController->getSupplierById($editSupplierId);

        if ($supplier) {
            $editSupplier = $supplier;
        }
    } elseif (isset($_GET["delete"])) {
        $deleteSupplierId = $_GET["delete"];

        // Delete the supplier
        if ($supplierController->deleteSupplier($deleteSupplierId)) {
            // Redirect to manage_supplier.php after successful deletion
            header("Location: ../public/manage_supplier.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting supplier.";
        }
    }
}

// Retrieve all suppliers for displaying in the table
$suppliers = $supplierController->getAllSuppliers();

?>
