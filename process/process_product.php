<?php
require_once __DIR__ . '/../classes/ProductController.php';
require_once __DIR__ . '/../classes/LoginController.php';
require_once __DIR__ . '/../db/connection.php';

$productController = new ProductController($connection);
$loginController = new LoginController($connection);

// Check if the form is submitted for creating or updating products
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if product_id is provided (if it's an edit operation)
    if (isset($_POST["product_id"])) {
        $currentUserId = $loginController->currentUserId();
        if ($currentUserId === false) {
            header("Location: ../public/login.php");
        }
        
        $productId = $_POST["product_id"];
        $name = $_POST["name"];
        $notes = $_POST["notes"];
        $unitOfMeasure = $_POST["unit_of_measure"];
        $userId = $currentUserId;

        // Update the existing product
        if ($productController->updateProduct($productId, $name, $notes, $unitOfMeasure, $userId)) {
            // Redirect to manage_product.php after successful update
            header("Location: ../public/manage_product.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error updating product.";
        }
    } else {
        // It's a new product, create it
        $currentUserId = $loginController->currentUserId();
        if ($currentUserId === false) {
            header("Location: ../public/login.php");
        }

        $name = $_POST["name"];
        $notes = $_POST["notes"];
        $unitOfMeasure = $_POST["unit_of_measure"];
        $userId = $currentUserId;

        if ($productController->createProduct($name, $notes, $unitOfMeasure, $userId)) {
            // Redirect to manage_product.php after successful creation
            header("Location: ../public/manage_product.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error creating product.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editProductId = $_GET["edit"];

        // Retrieve the product data for editing
        $product = $productController->getProductById($editProductId);

        if ($product) {
            $editProduct = $product;
        }
    } elseif (isset($_GET["delete"])) {
        $deleteProductId = $_GET["delete"];

        // Delete the product
        if ($productController->deleteProduct($deleteProductId)) {
            // Redirect to manage_product.php after successful deletion
            header("Location: ../public/manage_product.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting product.";
        }
    }
}

// Retrieve all products for displaying in the table
$products = $productController->getAllProducts();

?>
