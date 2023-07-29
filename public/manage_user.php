<?php
require_once __DIR__ . '/../process/process_user.php';
require_once __DIR__ . '/../process/process_permission.php';
require_once __DIR__ . '/../process/process_login.php';

$isAllowed = $loginController->isAllowed("barang");
if ($isAllowed === false) {
    header("Location: ../public/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Pengguna</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php include ('sidebar.php'); ?>
    <div class="container">
        <h2 class="my-4">Manage Pengguna</h2>

        <div class="mb-4">
            <h3>Tambah/Ubah Pengguna</h3>
            <form action="../process/process_user.php" method="post">
                <?php if (isset($editUserId)): ?>
                    <input type="hidden" name="user_id" value="<?php echo $editUserId; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($editUser) ? $editUser->getUsername() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" <?php echo isset($editUser) ? "placeholder='Leave blank to keep current password'" : "required"; ?>>
                </div>
                <div class="form-group">
                    <label for="first_name">Nama Depan</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($editUser) ? $editUser->getFirstName() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nama Belakang</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($editUser) ? $editUser->getLastName() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">No HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($editUser) ? $editUser->getPhone() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($editUser) ? $editUser->getAddress() : ""; ?>" required>
                </div>
                <div class="form-group">
                    <label for="permission_id">Hak Akses</label>
                    <select class="form-control" id="permission_id" name="permission_id" required>
                        <option value="">Pilih Hak Akses</option>
                        <?php
                        // Loop through permissions and display in dropdown
                        foreach ($permissions as $permission) {
                            $selected = (isset($editUser) && $editUser->getPermissionId() == $permission->getId()) ? "selected" : "";
                            echo "<option value='{$permission->getId()}' $selected>{$permission->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($editUserId) ? 'Update User' : 'Create User'; ?></button>
            </form>
        </div>

        <hr>

        <h3 class="mb-4">Pengguna</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengguna</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user->getId(); ?></td>
                            <td><?php echo $user->getUsername(); ?></td>
                            <td><?php echo $user->getFirstName(); ?></td>
                            <td><?php echo $user->getLastName(); ?></td>
                            <td><?php echo $user->getPhone(); ?></td>
                            <td><?php echo $user->getAddress(); ?></td>
                            <td><?php 
                                $permission = $permissionController->getPermissionById($user->getPermissionId()); 
                                echo $permission->getName();
                                ?></td>
                            <td>
                                <a href="?edit=<?php echo $user->getId(); ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="?delete=<?php echo $user->getId(); ?>" class="btn btn-sm btn-danger">Hapus</a>
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