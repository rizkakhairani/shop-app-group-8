<?php
require_once __DIR__ . '/../process/process_customer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Pelanggan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php
        include ('sidebar.php'); 
        if ($customerAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <h2 class="my-4">Manage Pelanggan</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Pelanggan</h3>
            <form action="../process/process_customer.php" method="post">
                <?php if (isset($editCustomerId)): ?>
                    <input type="hidden" name="customer_id" value="<?php echo $editCustomerId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($editCustomer) ? $editCustomer->getName() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor HP:</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($editCustomer) ? $editCustomer->getPhone() : ''; ?>" required>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo isset($editCustomer) ? $editCustomer->getAddress() : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editCustomerId) ? 'Ubah Pelanggan' : 'Tambah Pelanggan'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Pelanggan</h3>
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
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td rowspan="2"><?php echo $customer->getId(); ?></td>
                            <td rowspan="2"><?php echo $customer->getName(); ?></td>
                            <td rowspan="2"><?php echo $customer->getPhone(); ?></td>
                            <td rowspan="2"><?php echo $customer->getAddress(); ?></td>
                            <td>
                                <a href="?edit=<?php echo $customer->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $customer->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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