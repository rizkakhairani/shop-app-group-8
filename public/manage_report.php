<?php
require_once __DIR__ . '/../classes/ReportController.php';
require_once __DIR__ . '/../db/connection.php';

$reportController = new ReportController($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuntungan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
</head>
<body>
    <?php   
        include ('sidebar.php'); 
        if ($reportAccess === false) {
            header("Location: index.php");
        }
    ?>
    <div class="container">

        <h3 class="mb-4">Laporan Keuntungan</h3>
        <div class="table-responsive">
            <table class="table table-breported">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Profit</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $reports=$reportController->getAllReports(); 
                    foreach ($reports as $report): ?>
                        <tr>
                            <td><?php echo $report->getProductId(); ?></td>
                            <td><?php echo $report->getProductName(); ?></td>
                            <td><?php echo $report->getProfit(); ?></td>
                            <td><?php echo $report->getStock(); ?></td>
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