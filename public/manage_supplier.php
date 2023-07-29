<?php
require_once __DIR__ . '/../process/process_supplier.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Supplier</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php
        include ('sidebar.php'); 
        if ($supplierAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <h2 class="my-4">Manage Supplier</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Supplier</h3>
            <form action="../process/process_supplier.php" method="post">
                <?php if (isset($editSupplierId)): ?>
                    <input type="hidden" name="supplier_id" value="<?php echo $editSupplierId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($editSupplier) ? $editSupplier->getName() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor HP:</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($editSupplier) ? $editSupplier->getPhone() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo isset($editSupplier) ? $editSupplier->getAddress() : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editSupplierId) ? 'Ubah Supplier' : 'Tambah Supplier'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Supplier</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td><?php echo $supplier->getId(); ?></td>
                            <td><?php echo $supplier->getName(); ?></td>
                            <td><?php echo $supplier->getPhone(); ?></td>
                            <td><?php echo $supplier->getAddress(); ?></td>
                            <td>
                                <a href="?edit=<?php echo $supplier->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $supplier->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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