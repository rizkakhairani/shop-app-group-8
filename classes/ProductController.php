<?php

require_once 'Product.php';

class ProductController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new product in the database
    public function createProduct($name, $notes, $unit_of_measure, $user_id)
    {
        // Escape input to prevent SQL injection
        $name = $this->connection->real_escape_string($name);
        $notes = $this->connection->real_escape_string($notes);
        $unit_of_measure = $this->connection->real_escape_string($unit_of_measure);
        $user_id = (int)$user_id;

        $query = "INSERT INTO products (name, notes, unit_of_measure, user_id) VALUES ('$name', '$notes', '$unit_of_measure', '$user_id')";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve a product from the database by ID
    public function getProductById($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "SELECT * FROM products WHERE id = '$id'";

        $result = $this->connection->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new Product($row['id'], $row['name'], $row['notes'], $row['unit_of_measure'], $row['user_id']);
        } else {
            return null;
        }
    }

    // Update an existing product in the database
    public function updateProduct($id, $name, $notes, $unit_of_measure, $user_id)
    {
        $id = $this->connection->real_escape_string($id);
        $name = $this->connection->real_escape_string($name);
        $notes = $this->connection->real_escape_string($notes);
        $unit_of_measure = $this->connection->real_escape_string($unit_of_measure);
        $user_id = (int)$user_id;

        $query = "UPDATE products SET name = '$name', notes = '$notes', unit_of_measure = '$unit_of_measure', user_id = '$user_id' WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a product from the database by ID
    public function deleteProduct($id)
    {
        $id = $this->connection->real_escape_string($id);
        $query = "DELETE FROM products WHERE id = '$id'";

        if ($this->connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->connection->query($query);

        $products = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product($row['id'], $row['name'], $row['notes'], $row['unit_of_measure'], $row['user_id']);
                $products[] = $product;
            }
        }

        return $products;
    }
}

?>
