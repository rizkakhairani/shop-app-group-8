<?php

require_once 'Customer.php';

class CustomerController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new customer in the database
    public function createCustomer($name, $phone, $address)
    {
        // Escape input to prevent SQL injection
        $name = $this->connection->real_escape_string($name);
        $phone = $this->connection->real_escape_string($phone);
        $address = $this->connection->real_escape_string($address);

        $query = "INSERT INTO customers (name, phone, address) VALUES ('$name', '$phone', '$address')";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve a customer from the database by ID
    public function getCustomerById($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "SELECT * FROM customers WHERE id = '$id'";

        $result = $this->connection->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new Customer($row['id'], $row['name'], $row['phone'], $row['address']);
        } else {
            return null;
        }
    }

    // Update an existing customer in the database
    public function updateCustomer($id, $name, $phone, $address)
    {
        $id = $this->connection->real_escape_string($id);
        $name = $this->connection->real_escape_string($name);
        $phone = $this->connection->real_escape_string($phone);
        $address = $this->connection->real_escape_string($address);

        $query = "UPDATE customers SET name = '$name', phone = '$phone', address = '$address' WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a customer from the database by ID
    public function deleteCustomer($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "DELETE FROM customers WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllCustomers()
    {
        $query = "SELECT * FROM customers";
        $result = $this->connection->query($query);

        $customers = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $customer = new Customer($row['id'], $row['name'], $row['phone'], $row['address']);
                $customers[] = $customer;
            }
        }

        return $customers;
    }
}

?>
