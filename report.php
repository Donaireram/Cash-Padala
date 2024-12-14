<?php
session_start();
include('connect.php');

$sql = "SELECT t.transaction_id, t.created_at, t.tracking_code, u1.first_name AS sender_name, b1.branch_name AS branch_from_name, u2.first_name AS receiver_name, b2.branch_name AS branch_to_name, t.amount, t.status, t.s_lastname 
        FROM transactions t 
        JOIN users u1 ON t.sender_id = u1.user_id
        JOIN users u2 ON t.receiver_id = u2.user_id
        JOIN branches b1 ON t.branch_from = b1.branch_id
        JOIN branches b2 ON t.branch_to = b2.branch_id";

// Check if the filter is applied (from date and to date are set)
if (isset($_POST['filter'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    // Check if both dates are provided
    if (!empty($from_date) && !empty($to_date)) {
        // Prevent SQL injection by using prepared statements
        $sql .= " WHERE t.created_at BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $from_date, $to_date);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // If dates are not provided, fetch all records
        $result = $conn->query($sql);
    }
} elseif (isset($_POST['today'])) {
    $current_date = date("Y-m-d");

    // Prevent SQL injection by using prepared statements
    $sql .= " WHERE DATE(t.created_at) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $current_date);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // No filter applied, fetch all records
    $result = $conn->query($sql);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
</head>
 <style>
        #navbtn {
    display: inline-block;
    margin-left: 20px;
    font-size: 20px;
    transition: 500ms color;
    }

    #checkbox {
    display: none;
    }

    #checkbox:checked ~ .body .side-bar {
    width: 60px;
    }

    #checkbox:checked ~ .body .side-bar .user-p {
    visibility: hidden;
    }

    #checkbox:checked ~ .body .side-bar a span {
    display: none;
    }
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

    #checkbox:checked ~ .side-bar {
        width: 0;
    }

    /* Header */
    header {
        background: linear-gradient(136deg, var(--dark-green), #0c0c1e);
        padding: 8px 300px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
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
    }

    .head-title h1 {
        font-size: 28px;
        color: white;
    }

    .head-title .breadcrumb li {
        color: var(--dark-grey);
    }

    .box-info {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 24px;
        margin-top: 50px;
    }

    .box-info li {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }

    .box-info li .bx {
        font-size: 36px;
        background-color: var(--light-green);
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box-info li .text h3 {
        font-size: 24px;
        font-weight: 600;
    }

    .box-info li .text span {
        color: var(--dark-grey);
    }

    /* Chart */
    #incomeChart {
        max-width: 800px;
        width: 100%;
        margin: 50px auto;
        border-radius: 12px;
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
<style>
	/* Table Styles */
#data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, #1b4d3e, #388e3c); /* Dark green gradient background */
}

#data-table thead {
    background-color: #0c3c29; /* Dark green for header */
    color: white;
    text-align: left;
    font-weight: bold;
}

#data-table th, #data-table td {
    padding: 12px 20px;
    border-bottom: 1px solid #2C6E44; /* Dark green border for the cells */
    text-align: left;
}

#data-table tr:nth-child(even) {
    background-color: #3c6e4d; /* Slightly lighter green for even rows */
}

#data-table tr:hover {
    background-color: #2e4d39; /* Darker green for hover effect */
    cursor: pointer;
}

#data-table td.status {
    font-weight: bold;
    color: #28a745; /* Bright green for statuses */
}

#data-table .hiddenSelect {
    width: 100px;
    height: 35px;
    background-color: #4a7c57; /* Dark green background for select */
    color: white; /* White text for better contrast */
    border: 1px solid #4a7c57;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    padding: 5px 10px;
}

#data-table .hiddenSelect:hover {
    background-color: #388e3c; /* Lighter green hover effect */
    border-color: #388e3c;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    #data-table th, #data-table td {
        padding: 10px;
        font-size: 14px;
    }

    #data-table {
        font-size: 16px;
    }

    #data-table .hiddenSelect {
        width: 100%;
        padding: 8px;
    }

    .body {
        margin-left: 0;
    }

    .box-info {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    #data-table {
        font-size: 14px;
    }

    #data-table td {
        padding: 8px;
    }

    #data-table .hiddenSelect {
        width: 100%;
        padding: 8px;
    }
}

</style>
<body class="section-2">
    <header class="header" >
        <h2 class="u-name">CASH <b>PADALA</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
     
    </header>
    
    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <img style="height:60px; width:60px;" src="<?php echo $_SESSION['user_image']; ?>">
                <h4><?php echo $_SESSION['user_firstname']; ?></h4>
            </div>
            <ul>
                <li>
                    <a href="admin_dashboard.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="list.php">
                        <i class="fas fa-regular fa-table-list" aria-hidden="true"></i>
                        <span>Transaction List</span>
                    </a>
                </li>
                <li>
                    <a href="report.php">
                        <i class="fas fa-light fa-file" aria-hidden="true"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li>
                    <a href="income.php">
                        <i class="fas fa-light fa-money-bill" aria-hidden="true"></i>
                        <span>Income</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="fas fa-solid fa-user" ></i>
                        <span>User List</span>
                    </a>
                </li>
                <li>
                    <a href="fee.php">
                        <i class="fas fa-regular fa-table" ></i>
                        <span>Fee List</span>
                    </a>
                </li>
                <li>
                    <a href="branch.php">
                        <i class="fas fa-code-branch" ></i>
                        <span>Branch List</span>
                    </a>
                </li>
                <li>
                    <a href="archive1.php">
                        <i class="fas fa-solid fa-trash-can-arrow-up" ></i>
                        <span>Archive</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <section  class="section-1">
            <main class="table" >
            <form method="POST" class="filter-form">
    <h1>Reports</h1>

    <div class="filter-inputs">
        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" id="from_date" class="date-input">
        
        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" id="to_date" class="date-input">
    </div>

    <div class="filter-buttons">
        <button type="submit" name="filter" class="filter-btn">Filter</button>
        <button type="button" onclick="printTable()" class="print-btn">Print</button>
    </div>
</form>


                <section class="table__body">
                    <div class="header_fixed">
                        <table id="data-table">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Transaction Code</th>
                                    <th>Client</th>
                                    <th>Information</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr >
                                    <td><?php echo $row["created_at"]; ?></td>
                                    <td><?php echo $row["tracking_code"]; ?></td>
                                    <td><?php echo $row["s_lastname"]; ?></td>
                                    <td>
                                        <strong>Sender:</strong> <?php echo $row["sender_name"]; ?><br>
                                        <strong>Receiver:</strong> <?php echo $row["receiver_name"]; ?><br>
                                        <strong>From Branch:</strong> <?php echo $row["branch_from_name"]; ?><br>
                                        <strong>To Branch:</strong> <?php echo $row["branch_to_name"]; ?>
                                    </td>
                                    <td><?php echo $row["amount"]; ?></td>
                                    <td class="status"><?php echo ucfirst($row["status"]); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </section>
    </div>
<style>
    /* Filter Form Styles */
.filter-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.filter-inputs {
    display: flex;
    gap: 20px;
    align-items: center;
}

.filter-inputs label {
    color: white;
    font-size: 16px;
}

.date-input {
    padding: 8px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background: linear-gradient(45deg, white, darkgreen);
    color: #333;
    width: 200px;
}

.date-input:focus {
    border-color: var(--green);
}

/* Buttons Styling */
.filter-buttons {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.filter-btn, .print-btn {
    padding: 12px 25px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.filter-btn {
    background-color: var(--green);
    color: white;
}

.filter-btn:hover {
    background-color: #388e3c;
}

.print-btn {
    background-color: #2471a3;
    color: white;
}

.print-btn:hover {
    background-color: #ffb81c;
}

/* Hover effect for filter and print buttons */
.filter-btn:hover, .print-btn:hover {
    background-color: #28a745;
    color: white;
}

</style>
    <script>
        function printTable() {
            var printWindow = window.open('', '', 'height=600,width=800');
            var tableContent = document.getElementById('data-table').outerHTML;
            printWindow.document.write('<html><head><title>Print Table</title></head><body>');
            printWindow.document.write('<h1>Transaction Report</h1>');
            printWindow.document.write(tableContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        }
    </script>
</body>
</html>
