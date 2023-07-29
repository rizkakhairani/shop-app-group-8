<?php
require_once 'Report.php';

class ReportController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Get all orders
    public function getAllReports()
    {
        $query = 'SELECT product_id,
	product_name,
	total_harga_jual - (ROUND(total_harga_beli / total_pembelian, 2) * total_penjualan) AS profit,
	total_pembelian - total_penjualan as stock
FROM
	(
	SELECT
	    p.id as product_id,
	    p.name as product_name,
	    COALESCE(o.total_harga_beli, 0) AS total_harga_beli,
	    COALESCE(o.total_pembelian, 0) AS total_pembelian,
	    COALESCE(s.total_harga_jual, 0) AS total_harga_jual,
	    COALESCE(s.total_penjualan, 0) AS total_penjualan
	FROM
	    products p
	LEFT JOIN (
	    SELECT
	        product_id,
	        SUM(price * total) AS total_harga_beli,
	        SUM(total) AS total_pembelian
	    FROM
	        orders
	    GROUP BY
	        product_id
	) o ON o.product_id = p.id
	LEFT JOIN (
	    SELECT
	        product_id,
	        SUM(price * total) AS total_harga_jual,
	        SUM(total) AS total_penjualan
	    FROM
	        sells
	    GROUP BY
	        product_id
	) s ON s.product_id = p.id
	) AS temp_transaction;';
        $result = $this->connection->query($query);

        $orders = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $order = new Report(
                $row['product_id'],
                $row['product_name'],
                $row['profit'],
                $row['stock']
                );
                $orders[] = $order;
            }
        }

        return $orders;
    }
}

?>
