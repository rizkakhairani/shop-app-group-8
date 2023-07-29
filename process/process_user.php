<?php
require_once __DIR__ . '/../classes/UserController.php';
require_once __DIR__ . '/../db/connection.php';

$userController = new UserController($connection);

// Check if the form is submitted for creating or updating permissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if permission_id is provided (if it's an edit operation)
    if (isset($_POST["user_id"])) {
        $userId = $_POST["user_id"];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $permission_id = $_POST['permission_id'];

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Call the createUser method in UserController
        if ($userController->updateUser($userId, $username, $hashedPassword, $first_name, $last_name, $phone, $address, $permission_id)) {
            // User created successfully, redirect to manage_users.php
            header("Location: ../public/manage_user.php");
            exit();
        } else {
            echo "Error updating user.";
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $permission_id = $_POST['permission_id'];

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Call the createUser method in UserController
        if ($userController->createUser($username, $hashedPassword, $first_name, $last_name, $phone, $address, $permission_id)) {
            // User created successfully, redirect to manage_users.php
            header("Location: ../public/manage_user.php");
            exit();
        } else {
            echo "Error creating user.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["edit"])) {
        $editUserId = $_GET["edit"];

        // Retrieve the user data for editing
        $user = $userController->getUserById($editUserId);

        if ($user) {
            $editUser = $user;
        }
    } elseif (isset($_GET["delete"])) {
        $deletePermissionId = $_GET["delete"];

        // Delete the user
        if ($userController->deleteUser($deletePermissionId)) {
            // Redirect to manage_permission.php after successful deletion
            header("Location: ../public/manage_user.php");
            exit(); // Important to exit after redirection
        } else {
            echo "Error deleting user.";
        }
    }
}

$users = $userController->getAllUsers();

?>
