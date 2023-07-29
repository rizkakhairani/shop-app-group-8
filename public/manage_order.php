<?php
require_once __DIR__ . '/../process/process_order.php';
require_once __DIR__ . '/../process/process_product.php';
require_once __DIR__ . '/../process/process_supplier.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Pembelian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php
        include ('sidebar.php'); 
        if ($orderAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <h2 class="my-4">Manage Pembelian</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Pembelian</h3>
            <form action="../process/process_order.php" method="post">
                <?php if (isset($editOrderId)): ?>
                    <input type="hidden" name="order_id" value="<?php echo $editOrderId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="ordername">Jumlah Pembelian</label>
                    <input type="number" class="form-control" id="total" name="total" value="<?php echo isset($editOrder) ? $editOrder->getTotal() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga Beli</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo isset($editOrder) ? $editOrder->getPrice() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="product_id">Barang</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        <option value="">Pilih Barang</option>
                        <?php
                        // Loop through products and display in dropdown
                        foreach ($products as $product) {
                            $selected = (isset($editOrder) && $editOrder->getProductId() == $product->getId()) ? "selected" : "";
                            echo "<option value='{$product->getId()}' $selected>{$product->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select class="form-control" id="supplier_id" name="supplier_id" required>
                        <option value="">Pilih Supplier</option>
                        <?php
                        // Loop through suppliers and display in dropdown
                        foreach ($suppliers as $supplier) {
                            $selected = (isset($editOrder) && $editOrder->getSupplierId() == $supplier->getId()) ? "selected" : "";
                            echo "<option value='{$supplier->getId()}' $selected>{$supplier->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editOrderId) ? 'Update Order' : 'Create Order'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Pembelian</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jumlah Pembelian</th>
                        <th>Harga Beli</th>
                        <th>Barang</th>
                        <th>Supplier</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order->getId(); ?></td>
                            <td><?php echo $order->getTotal(); ?></td>
                            <td><?php echo $order->getPrice(); ?></td>
                            <td><?php 
                                $product = $productController->getProductById($order->getProductId()); 
                                echo $product->getName();
                                ?></td>
                            <td><?php 
                                $supplier = $supplierController->getSupplierById($order->getSupplierId()); 
                                echo $supplier->getName();
                                ?></td>
                            <td>
                                <a href="?edit=<?php echo $order->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $order->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>