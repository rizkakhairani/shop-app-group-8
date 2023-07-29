<?php
require_once 'Sell.php';

class SellController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new sell
    public function createSell($total, $price, $product_id, $customer_id)
    {
        // Sanitize sell input before using in the query to prevent SQL injection
        $total = mysqli_real_escape_string($this->connection, $total);
        $price = mysqli_real_escape_string($this->connection, $price);
        $customer_id = (int)$customer_id; // Convert to integer for safety
        $product_id = (int)$product_id;

        // Prepare the SQL statement
        $query = "INSERT INTO sells (total, price, customer_id, product_id)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("iiii", $total, $price, $customer_id, $product_id);

        // Execute the query
        if ($stmt->execute()) {
            // Insert successful
            return true;
        } else {
            // Insert failed
            return false;
        }
    }

    // Update an existing sell
    public function updateSell($id, $total, $price, $product_id, $customer_id)
    {
        // Sanitize sell input before using in the query to prevent SQL injection
        $id = (int)$id; // Convert to integer for safety
        $total = mysqli_real_escape_string($this->connection, $total);
        $price = mysqli_real_escape_string($this->connection, $price);
        $customer_id = (int)$customer_id; // Convert to integer for safety
        $product_id = (int)$product_id;

        // Prepare the SQL statement
        $query = "UPDATE sells SET total = ?, price = ?, customer_id = ?, product_id = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("iiiii", $total, $price, $customer_id, $product_id, $id);

        // Execute the query
        if ($stmt->execute()) {
            // Update successful
            return true;
        } else {
            // Update failed
            return false;
        }
    }

    // Delete a sell
    public function deleteSell($sell_id)
    {
        // Sanitize sell input before using in the query to prevent SQL injection
        $sell_id = (int)$sell_id; // Convert to integer for safety

        $query = "DELETE FROM sells WHERE id = $sell_id";

        return $this->connection->query($query);
    }

    // Get sell by ID
    public function getSellById($sell_id)
    {
        // Sanitize sell input before using in the query to prevent SQL injection
        $sell_id = (int)$sell_id; // Convert to integer for safety

        $query = "SELECT * FROM sells WHERE id = $sell_id";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Sell(
                $row['id'],
                $row['total'],
                $row['price'],
                $row['product_id'],
                $row['customer_id']
            );
        }

        return null;
    }

    // Get all sells
    public function getAllSells()
    {
        $query = "SELECT * FROM sells";
        $result = $this->connection->query($query);

        $sells = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $sell = new Sell(
                $row['id'],
                $row['total'],
                $row['price'],
                $row['product_id'],
                $row['customer_id']
                );
                $sells[] = $sell;
            }
        }

        return $sells;
    }
}

?>
