<?php

require_once __DIR__ . '/../classes/LoginController.php';
require_once __DIR__ . '/../classes/PermissionController.php';
require_once __DIR__ . '/../db/connection.php';

$loginController = new LoginController($connection);
$permissionController = new PermissionController($connection);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Authenticate the user
    $user = $loginController->authenticateUser($username, $password);

    if ($user !== null) {
        // User authenticated successfully, start the session
        $permission = $permissionController->getPermissionById($user->getId());
        $loginController->startSession($user, $permission);

        // Redirect to the dashboard or any other protected page
        header("Location: ../public/index.php"); // Change "index.php" to the desired protected page
        exit();
    } else {
        // Authentication failed, show an error message or redirect to the login page with an error flag
        header("Location: ../public/login.php?error=1"); // Redirect to login page with error flag
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the URL contains an "edit" or "delete" parameter
    if (isset($_GET["logout"])) {
        $loginController->logout();
        header("Location: ../public/login.php");
        exit();
    }
}

?>
