<?php

require_once 'User.php';

class LoginController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function authenticateUser($username, $password)
    {
        $username = mysqli_real_escape_string($this->connection, $username);

        // Fetch user from the database by username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, return the user
                return new User(
                    $row['id'],
                    $row['username'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['phone'],
                    $row['address'],
                    $row['permission_id'],
                    $row['password']
                );
            }
        }

        // Authentication failed
        return null;
    }

    public function startSession($user, $permission)
    {
        session_start();
        $_SESSION['userId'] = $user->getId();
        $_SESSION['permissionNotes'] = $permission->getNotes();
    }

    public function currentUserId()
    {        
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }
        
        return false;
    }

    public function isAllowed($page)
    {       
        session_start();
        if (isset($_SESSION['permissionNotes'])) {
            $permissionArr = explode(',', $_SESSION['permissionNotes']);
            
            if (in_array($page, $permissionArr)) {
                return true;
            }
        }
        
        return false;
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }
}

?>
