<?php
require_once 'Order.php';

class OrderController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new order
    public function createOrder($total, $price, $product_id, $supplier_id)
    {
        // Sanitize order input before using in the query to prevent SQL injection
        $total = mysqli_real_escape_string($this->connection, $total);
        $price = mysqli_real_escape_string($this->connection, $price);
        $supplier_id = (int)$supplier_id; // Convert to integer for safety
        $product_id = (int)$product_id;

        // Prepare the SQL statement
        $query = "INSERT INTO orders (total, price, product_id, supplier_id)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssss", $total, $price, $product_id, $supplier_id);

        // Execute the query
        if ($stmt->execute()) {
            // Insert successful
            return true;
        } else {
            // Insert failed
            return false;
        }
    }

    // Update an existing order
    public function updateOrder($id, $total, $price, $product_id, $supplier_id)
    {
        // Sanitize order input before using in the query to prevent SQL injection
        $id = (int)$id; // Convert to integer for safety
        $total = (int)$total;
        $price = (int)$price;
        $supplier_id = (int)$supplier_id; // Convert to integer for safety
        $product_id = (int)$product_id;

        // Prepare the SQL statement
        $query = "UPDATE orders SET total = ?, price = ?, supplier_id = ?, product_id = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("iiiii", $total, $price, $supplier_id, $product_id, $id);

        // Execute the query
        if ($stmt->execute()) {
            // Update successful
            return true;
        } else {
            // Update failed
            return false;
        }
    }

    // Delete a order
    public function deleteOrder($order_id)
    {
        // Sanitize order input before using in the query to prevent SQL injection
        $order_id = (int)$order_id; // Convert to integer for safety

        $query = "DELETE FROM orders WHERE id = $order_id";

        return $this->connection->query($query);
    }

    // Get order by ID
    public function getOrderById($order_id)
    {
        // Sanitize order input before using in the query to prevent SQL injection
        $order_id = (int)$order_id; // Convert to integer for safety

        $query = "SELECT * FROM orders WHERE id = $order_id";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Order(
                $row['id'],
                $row['total'],
                $row['price'],
                $row['product_id'],
                $row['supplier_id']
            );
        }

        return null;
    }

    // Get all orders
    public function getAllOrders()
    {
        $query = "SELECT * FROM orders";
        $result = $this->connection->query($query);

        $orders = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $order = new Order(
                $row['id'],
                $row['total'],
                $row['price'],
                $row['product_id'],
                $row['supplier_id']
                );
                $orders[] = $order;
            }
        }

        return $orders;
    }
}

?>
