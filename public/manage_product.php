<?php
require_once __DIR__ . '/../process/process_product.php';
require_once __DIR__ . '/../process/process_login.php';

$isAllowed = $loginController->isAllowed("barang");
if ($isAllowed === false) {
    header("Location: ../public/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Barang</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php include ('sidebar.php'); ?>
    <div class="container">
        <?php
        // Include the process_product.php file to handle the CRUD operations
        require_once '../process/process_product.php';
        ?>

        <h2 class="my-4">Manage Barang</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Barang</h3>
            <form action="../process/process_product.php" method="post">
                <?php if (isset($editProductId)): ?>
                    <input type="hidden" name="product_id" value="<?php echo $editProductId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($editProduct) ? $editProduct->getName() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="notes">Keterangan:</label>
                    <textarea class="form-control" name="notes" id="notes" required><?php echo isset($editProduct) ? $editProduct->getNotes() : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="unit_of_measure">Satuan:</label>
                    <input type="text" class="form-control" name="unit_of_measure" id="unit_of_measure" value="<?php echo isset($editProduct) ? $editProduct->getUnitOfMeasure() : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editProductId) ? 'Ubah Barang' : 'Tambah Barang'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Barang</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Satuan</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product->getId(); ?></td>
                            <td><?php echo $product->getName(); ?></td>
                            <td><?php echo $product->getNotes(); ?></td>
                            <td><?php echo $product->getUnitOfMeasure(); ?></td>
                            <td>
                                <a href="?edit=<?php echo $product->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $product->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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