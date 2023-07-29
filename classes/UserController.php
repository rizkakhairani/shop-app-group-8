<?php
require_once 'User.php';

class UserController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new user
    public function createUser($username, $password, $first_name, $last_name, $phone, $address, $permission_id)
    {
        // Sanitize user input before using in the query to prevent SQL injection
        $username = mysqli_real_escape_string($this->connection, $username);
        $first_name = mysqli_real_escape_string($this->connection, $first_name);
        $last_name = mysqli_real_escape_string($this->connection, $last_name);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $address = mysqli_real_escape_string($this->connection, $address);
        $permission_id = (int)$permission_id; // Convert to integer for safety

        // Prepare the SQL statement
        $query = "INSERT INTO users (username, password, first_name, last_name, phone, address, permission_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssss", $username, $password, $first_name, $last_name, $phone, $address, $permission_id);

        // Execute the query
        if ($stmt->execute()) {
            // Insert successful
            return true;
        } else {
            // Insert failed
            return false;
        }
    }

    // Update an existing user
    public function updateUser($id, $username, $password, $first_name, $last_name, $phone, $address, $permission_id)
    {
        // Sanitize user input before using in the query to prevent SQL injection
        $id = (int)$id; // Convert to integer for safety
        $username = mysqli_real_escape_string($this->connection, $username);
        $first_name = mysqli_real_escape_string($this->connection, $first_name);
        $last_name = mysqli_real_escape_string($this->connection, $last_name);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $address = mysqli_real_escape_string($this->connection, $address);
        $permission_id = (int)$permission_id; // Convert to integer for safety
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

        // Prepare the SQL statement
        $query = "UPDATE users SET username = ?, password = ?, first_name = ?, last_name = ?, phone = ?, address = ?, permission_id = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssssi", $username, $password, $first_name, $last_name, $phone, $address, $permission_id, $id);

        // Execute the query
        if ($stmt->execute()) {
            // Update successful
            return true;
        } else {
            // Update failed
            return false;
        }
    }

    // Delete a user
    public function deleteUser($user_id)
    {
        // Sanitize user input before using in the query to prevent SQL injection
        $user_id = (int)$user_id; // Convert to integer for safety

        $query = "DELETE FROM users WHERE id = $user_id";

        return $this->connection->query($query);
    }

    // Get user by ID
    public function getUserById($user_id)
    {
        // Sanitize user input before using in the query to prevent SQL injection
        $user_id = (int)$user_id; // Convert to integer for safety

        $query = "SELECT * FROM users WHERE id = $user_id";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
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

        return null;
    }

    // Get all users
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query);

        $users = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $user = new User(
                    $row['id'],
                    $row['username'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['phone'],
                    $row['address'],
                    $row['permission_id'],
                    $row['password']
                );
                $users[] = $user;
            }
        }

        return $users;
    }
}

?>
