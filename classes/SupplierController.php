<?php

require_once 'Supplier.php';

class SupplierController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new supplier in the database
    public function createSupplier($name, $phone, $address)
    {
        // Escape input to prevent SQL injection
        $name = $this->connection->real_escape_string($name);
        $phone = $this->connection->real_escape_string($phone);
        $address = $this->connection->real_escape_string($address);

        $query = "INSERT INTO suppliers (name, phone, address) VALUES ('$name', '$phone', '$address')";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve a supplier from the database by ID
    public function getSupplierById($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "SELECT * FROM suppliers WHERE id = '$id'";

        $result = $this->connection->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new Supplier($row['id'], $row['name'], $row['phone'], $row['address']);
        } else {
            return null;
        }
    }

    // Update an existing supplier in the database
    public function updateSupplier($id, $name, $phone, $address)
    {
        $id = $this->connection->real_escape_string($id);
        $name = $this->connection->real_escape_string($name);
        $phone = $this->connection->real_escape_string($phone);
        $address = $this->connection->real_escape_string($address);

        $query = "UPDATE suppliers SET name = '$name', phone = '$phone', address = '$address' WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a supplier from the database by ID
    public function deleteSupplier($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "DELETE FROM suppliers WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSuppliers()
    {
        $query = "SELECT * FROM suppliers";
        $result = $this->connection->query($query);

        $suppliers = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $supplier = new Supplier($row['id'], $row['name'], $row['phone'], $row['address']);
                $suppliers[] = $supplier;
            }
        }

        return $suppliers;
    }
}

?>
