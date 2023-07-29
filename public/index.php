<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/main.css" />
    <style>
        body {
            padding: 20px;
        }

        .box {
            width: 180px;
            height: 130px;
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .box:hover {
            background-color: #0056b3;
        }

        .box-container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        h2 {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <?php include ('sidebar.php'); ?>
    <div class="container">
        <h2>Beranda</h2>
        <div class="box-container">
            <!-- Box 1: Manage Permissions -->
            <a href="manage_permission.php">
                <div class="box">
                    <h5>Manage Hak Akses</h5>
                </div>
            </a>

            <!-- Box 2: Manage Users -->
            <a href="manage_user.php">
                <div class="box">
                    <h5>Manage Pengguna</h5>
                </div>
            </a>
            
            <!-- Box 3: Manage Products -->
            <a href="manage_product.php">
                <div class="box">
                    <h5>Manage Barang</h5>
                </div>
            </a>
        </div>

        <div class="box-container">
            <!-- Box 1: Manage Permissions -->
            <a href="manage_permission.php">
                <div class="box">
                    <h5>Manage Hak Akses</h5>
                </div>
            </a>

            <!-- Box 2: Manage Users -->
            <a href="manage_user.php">
                <div class="box">
                    <h5>Manage Pengguna</h5>
                </div>
            </a>
            
            <!-- Box 3: Manage Products -->
            <a href="manage_product.php">
                <div class="box">
                    <h5>Manage Barang</h5>
                </div>
            </a>
        </div>

        <div class="box-container">
            <!-- Box 1: Manage Permissions -->
            <a href="manage_permission.php">
                <div class="box">
                    <h5>Manage Hak Akses</h5>
                </div>
            </a>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
