<?php 
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">

    <script>
        // Function to print only the Transaction Information section
        function printTransaction() {
            var printContent = document.getElementById('printContent');
            var printWindow = window.open('', '', 'height=400, width=800');
            printWindow.document.write('<html><head><title>Transaction Information</title></head><body>');
            printWindow.document.write(printContent.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close(); // Important for IE
            printWindow.print();
        }
    </script>

    <style>
        /* Global Styles */
        :root {
            --poppins: 'Poppins', sans-serif;
            --lato: 'Lato', sans-serif;
            --light: #F9F9F9;
            --blue: #3C91E6;
            --dark-green: #1b4d3e;
            --light-green: #388e3c;
            --grey: #333;
            --dark-grey: #AAAAAA;
            --dark: #2C3E50;
            --red: #DB504A;
            --yellow: #FFCE26;
            --orange: #FD7238;
            --green: #28a745;
        }

        /* Reset */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--poppins);
            background: linear-gradient(135deg, var(--dark-green), #0c0c1e);
            color: white;
            height: 100%;
        }

        body, html {
            height: 100%;
        }

        .container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
        }

        /* Sidebar */
        .side-bar {
            background: linear-gradient(135deg, var(--dark-green), #0c0c1e);
            color: white;
            width: 250px;
            height: 100%;
            position: fixed;
            padding-top: 20px;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: width 0.3s ease-in-out;
        }

        .side-bar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 15px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .side-bar a:hover {
            background-color: var(--green);
        }

        .side-bar .user-p {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        .side-bar .user-p img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }

        .side-bar .user-p h4 {
            font-size: 16px;
            margin-top: 10px;
            font-weight: 500;
        }

        /* Header */
        header {
            background: linear-gradient(136deg, var(--dark-green), #0c0c1e);
            padding: 8px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h2 {
            font-size: 24px;
        }

        header i {
            font-size: 24px;
            cursor: pointer;
        }

        /* Main Content */
        .body {
            margin-left: 260px;
            padding-top: 80px;
            overflow: hidden;
        }

        .head-title h1 {
            font-size: 28px;
            color: white;
        }

        /* Transaction Details Section */
        .table {
            background-color: rgba(0, 0, 0, 0.3);
            margin-top: 80px;
            padding: 20px;
            border-radius: 12px;
        }

        .table h1 {
            font-size: 38px;
            margin-bottom: 20px;
        }

        .Print table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .Print table, .Print th, .Print td {
            border: 1px solid #ddd;
        }

        .Print th, .Print td {
            padding: 12px;
            text-align: left;
        }

        .Print th {
            background-color: #1b4d3e;
            color: white;
        }

        .Print td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Button */
        button {
            padding: 10px;
            border-radius: 5px;
            width: 120px;
            color: white;
            background-color: var(--green);
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: var(--dark-green);
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .side-bar {
                width: 100%;
                position: relative;
                margin-top: 60px;
            }

            .body {
                margin-left: 0;
            }

            header {
                padding: 10px 20px;
            }

            .box-info {
                grid-template-columns: 1fr 1fr;
            }

            .box-info li {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            header h2 {
                font-size: 20px;
            }

            .box-info {
                grid-template-columns: 1fr;
            }

            .box-info li {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">PERA <b>PADALA</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <i class="fa fa-user" aria-hidden="true"></i>
    </header>
    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <img style="height:60px; width:60px;" src="<?php echo $_SESSION['user_image']; ?>">
                <h4><?php echo $_SESSION['user_firstname']; ?></h4>
            </div>
            <ul>
                <li><a href="admin_dashboard.php"><i class="fa fa-desktop" aria-hidden="true"></i><span>Dashboard</span></a></li>
                <li><a href="list.php"><i class="fas fa-regular fa-table-list" aria-hidden="true"></i><span>Transaction List</span></a></li>
                <li><a href="report.php"><i class="fas fa-light fa-file" aria-hidden="true"></i><span>Reports</span></a></li>
                <li><a href="income.php"><i class="fas fa-light fa-money-bill"aria-hidden="true"></i><span>Income</span></a></li>
                <li><a href="user.php"><i class="fas fa-solid fa-user" style="color: #ffffff;" aria-hidden="true"></i><span>User List</span></a></li>
                <li><a href="fee.php"><i class="fas fa-regular fa-table" style="color: #ffffff;" aria-hidden="true"></i><span>Fee List</span></a></li>
                <li><a href="branch.php"><i class="fas fa-code-branch" style="color: #ffffff;" aria-hidden="true"></i><span>Branch List</span></a></li>
                <li><a href="archive1.php"><i class="fas fa-solid fa-trash-can-arrow-up" style="color: #ffffff;" aria-hidden="true"></i><span>Archive</span></a></li>
                <li><a href="log-out.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
        <div class="container">
            <div class="table">
                <div class="Print" id="printContent">
                    <h1>Transaction Information</h1>
                    <?php
                        include 'connect.php';

                        if (isset($_GET['id'])) {
                            // Sanitize the input to prevent SQL injection
                            $transaction_id = mysqli_real_escape_string($conn, $_GET['id']);

                            $sql = "SELECT *, b.branch_name FROM transactions t JOIN branches b ON t.branch_from = b.branch_id WHERE transaction_id = '$transaction_id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                echo '<div>';
                                echo '<h3>Tracking Code:</h3>';
                                echo '<p style="font-size: 20px;">' . (isset($row['tracking_code']) ? $row['tracking_code'] : '') . '</p>';
                                echo '<hr>';
                                echo '<h3>Sender Details:</h3>';
                                echo '<table>';
                                echo '<tr><td>Name:</td><td>' . (isset($row['s_lastname']) ? $row['s_lastname'] . ' ' . $row['s_middlename'] : '') . '</td></tr>';
                                echo '<tr><td>Contact:</td><td>' . (isset($row['s_contact']) ? $row['s_contact'] : '') . '</td></tr>';
                                echo '<tr><td>Address:</td><td>' . (isset($row['s_address']) ? $row['s_address'] : '') . '</td></tr>';
                                echo '</table>';
                                echo '<br>';
                                echo '<hr>';
                                echo '<h3>Receiver Details:</h3>';
                                echo '<table>';
                                echo '<tr><td>Name:</td><td>' . (isset($row['r_lastname']) ? $row['r_lastname'] . ' ' . $row['r_middlename'] : '') . '</td></tr>';
                                echo '<tr><td>Contact:</td><td>' . (isset($row['r_contact']) ? $row['r_contact'] : '') . '</td></tr>';
                                echo '<tr><td>Address:</td><td>' . (isset($row['r_address']) ? $row['r_address'] : '') . '</td></tr>';
                                echo '</table>';
                                echo '<br>';
                                echo '<hr>';
                                echo '<h3>Details:</h3>';
                                echo '<table>';
                                echo '<tr><td>Amount:</td><td>' . (isset($row['amount']) ? $row['amount'] : '') . '</td></tr>';
                                echo '<tr><td>Purpose:</td><td>' . (isset($row['purpose']) ? $row['purpose'] : '') . '</td></tr>';
                                echo '<tr><td>Sent From:</td><td>' . (isset($row['branch_name']) ? $row['branch_name'] : '') . '</td></tr>';
                                echo '</table>';
                            } else {
                                echo "No transaction found with ID: $transaction_id";
                            }
                        } else {
                            echo "Transaction ID is missing in the URL.";
                        }

                        // Close the database connection
                        $conn->close();
                    ?>
                    <button onclick="printTransaction()">Print</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
