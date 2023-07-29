<?php
require_once __DIR__ . '/../process/process_permission.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Hak Akses</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php
        include ('sidebar.php'); 
        if ($permissionAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <h2 class="my-4">Manage Hak Akses</h2>
        <div class="mb-4">
            <h3>Tambah/Ubah Hak Akses</h3>
            <form action="../process/process_permission.php" method="post">
                <?php if (isset($editPermissionId)): ?>
                    <input type="hidden" name="permission_id" value="<?php echo $editPermissionId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($editPermission) ? $editPermission->getName() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="notes">Keterangan:</label>
                    <textarea class="form-control" name="notes" id="notes" required><?php echo isset($editPermission) ? $editPermission->getNotes() : ''; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editPermissionId) ? 'Ubah Hak Akses' : 'Tambah Hak Akses'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Hak Akses</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th class="table-actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permissions as $permission): ?>
                        <tr>
                            <td><?php echo $permission->getId(); ?></td>
                            <td><?php echo $permission->getName(); ?></td>
                            <td><?php echo $permission->getNotes(); ?></td>
                            <td>
                                    <a href="?edit=<?php echo $permission->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                    <a href="?delete=<?php echo $permission->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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