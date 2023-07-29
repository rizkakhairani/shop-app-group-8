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
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
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
            transition: background-color 0.3s ease;
        }

        .box:hover {
            background-color: #0056b3;
        }

        .box-container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <?php include ('sidebar.php'); ?>
    <div class="container">
        <h1>Group 8</h1>

        <table>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
            </tr>
            <tr>
                <td>2602311086</td>
                <td>Aditya Muhammad Fallen</td>
            </tr>
            <tr>
                <td>2602291626</td>
                <td>Gede Abdullah</td>
            </tr>
            <tr>
                <td>2602299824</td>
                <td>Rizka Khairani</td>
            </tr>
            <tr>
                <td>2602287061</td>
                <td>Zikri Zakaria Salam</td>
            </tr>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
