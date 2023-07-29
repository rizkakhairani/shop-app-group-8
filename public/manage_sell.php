<?php
require_once __DIR__ . '/../process/process_sell.php';
require_once __DIR__ . '/../process/process_product.php';
require_once __DIR__ . '/../process/process_customer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Penjualan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php
        include ('sidebar.php'); 
        if ($sellAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <h2 class="my-4">Manage Penjualan</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Penjualan</h3>
            <form action="../process/process_sell.php" method="post">
                <?php if (isset($editSellId)): ?>
                    <input type="hidden" name="sell_id" value="<?php echo $editSellId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="sellname">Jumlah Penjualan</label>
                    <input type="number" class="form-control" id="total" name="total" value="<?php echo isset($editSell) ? $editSell->getTotal() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga Beli</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo isset($editSell) ? $editSell->getPrice() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="product_id">Barang</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        <option value="">Pilih Barang</option>
                        <?php
                        // Loop through products and display in dropdown
                        foreach ($products as $product) {
                            $selected = (isset($editSell) && $editSell->getProductId() == $product->getId()) ? "selected" : "";
                            echo "<option value='{$product->getId()}' $selected>{$product->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <select class="form-control" id="customer_id" name="customer_id" required>
                        <option value="">Pilih Customer</option>
                        <?php
                        // Loop through customers and display in dropdown
                        foreach ($customers as $customer) {
                            $selected = (isset($editSell) && $editSell->getProductId() == $customer->getId()) ? "selected" : "";
                            echo "<option value='{$customer->getId()}' $selected>{$customer->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editSellId) ? 'Update Sell' : 'Create Sell'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Penjualan</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jumlah Penjualan</th>
                        <th>Harga Beli</th>
                        <th>Barang</th>
                        <th>Customer</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sells as $sell): ?>
                        <tr>
                            <td><?php echo $sell->getId(); ?></td>
                            <td><?php echo $sell->getTotal(); ?></td>
                            <td><?php echo $sell->getPrice(); ?></td>
                            <td><?php 
                                $product = $productController->getProductById($sell->getProductId()); 
                                echo $product->getName();
                                ?></td>
                                <td><?php 
                                $customer = $customerController->getCustomerById($sell->getCustomerId()); 
                                echo $customer->getName();
                                ?></td>
                            <td>
                                <a href="?edit=<?php echo $sell->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $sell->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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