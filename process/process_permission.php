<?php
require_once __DIR__ . '/../classes/PermissionController.php';
require_once __DIR__ . '/../db/connection.php';

$permissionController = new PermissionController($connection);

// Check if the form is submitted for creating or updating permissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if permission_id is provided (if it's an edit operation)
    if (isset($_POST["permission_id"])) {
        $permissionId = $_POST["permission_id"];
        $name = $_POST["name"];
        $notes = str_replace(" ","",strtolower($_POST["notes"]));

        // Update the existing permission
        if ($permissionController->updatePermission($permissionId, $name, $notes)) {
            // Redirect to manage_permission.php after successful update
            header("Location: ../public/manage_permission.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error updating permission.";
        }
    } else {
        // It's a new permission, create it
        $name = $_POST["name"];
        $notes = str_replace(" ","",strtolower($_POST["notes"]));

        if ($permissionController->createPermission($name, $notes)) {
            // Redirect to manage_permission.php after successful creation
            header("Location: ../public/manage_permission.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error creating permission.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editPermissionId = $_GET["edit"];

        // Retrieve the permission data for editing
        $permission = $permissionController->getPermissionById($editPermissionId);

        if ($permission) {
            $editPermission = $permission;
        }
    } elseif (isset($_GET["delete"])) {
        $deletePermissionId = $_GET["delete"];

        // Delete the permission
        if ($permissionController->deletePermission($deletePermissionId)) {
            // Redirect to manage_permission.php after successful deletion
            header("Location: ../public/manage_permission.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting permission.";
        }
    }
}

// Retrieve all permissions for displaying in the table
$permissions = $permissionController->getAllPermissions();

?>
