<?php
require_once __DIR__ . '/../process/process_login.php';
?>

<div class="sidebar">
    <div class="sidebar-header">
        <a href="index.php"><img src="../assets/long-logo.png" class="logo-img" alt="Logo"></a>
    </div>
    <ul class="nav flex-column">
        <?php $permissionAccess = $loginController->isAllowed("hakakses");
            if ($permissionAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_permission.php">Hak Akses</a>
        </li>
        <?php } ?>

        <?php $userAccess = $loginController->isAllowed("pengguna");
            if ($userAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_user.php">Pengguna</a>
        </li>
        <?php } ?>

        <?php $supplierAccess = $loginController->isAllowed("supplier");
            if ($supplierAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_supplier.php">Supplier</a>
        </li>
        <?php } ?>

        <?php $customerAccess = $loginController->isAllowed("pelanggan");
            if ($customerAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_customer.php">Pelanggan</a>
        </li>
        <?php } ?>

        <?php $productAccess = $loginController->isAllowed("barang");
            if ($productAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_product.php">Barang</a>
        </li>
        <?php } ?>

        <?php $orderAccess = $loginController->isAllowed("pembelian");
            if ($orderAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_order.php">Pembelian</a>
        </li>
        <?php } ?>

        <?php $sellAccess = $loginController->isAllowed("penjualan");
            if ($sellAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_sell.php">Penjualan</a>
        </li>
        <?php } ?>

        <?php $reportAccess = $loginController->isAllowed("laporankeuntungan");
            if ($reportAccess !== false) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_report.php">Laporan Keuntungan</a>
        </li>
        <?php } ?>
    </ul>
    <div class="button-centered">
        <a class="btn btn-danger" href="../process/process_login.php?logout=true">Logout</a>
    </div>
    <hr>
</div>