<?php

require_once 'Permission.php';

class PermissionController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new permission in the database
    public function createPermission($name, $notes)
    {
        // Escape input to prevent SQL injection
        $name = $this->connection->real_escape_string($name);
        $notes = $this->connection->real_escape_string($notes);

        $query = "INSERT INTO permissions (name, notes) VALUES ('$name', '$notes')";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve a permission from the database by ID
    public function getPermissionById($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "SELECT * FROM permissions WHERE id = '$id'";

        $result = $this->connection->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new Permission($row['id'], $row['name'], $row['notes']);
        } else {
            return null;
        }
    }

    // Update an existing permission in the database
    public function updatePermission($id, $name, $notes)
    {
        $id = $this->connection->real_escape_string($id);
        $name = $this->connection->real_escape_string($name);
        $notes = $this->connection->real_escape_string($notes);

        $query = "UPDATE permissions SET name = '$name', notes = '$notes' WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a permission from the database by ID
    public function deletePermission($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "DELETE FROM permissions WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPermissions()
    {
        $query = "SELECT * FROM permissions";
        $result = $this->connection->query($query);

        $permissions = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $permission = new Permission($row['id'], $row['name'], $row['notes']);
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}

?>
