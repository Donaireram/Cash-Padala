<?php
session_start();
include('connect.php');


$receiver_id = $_SESSION['user_id'];
$current_date = date("Y-m-d");

if (isset($_POST['filter'])) {
    $filter_from_date = $_POST['from_date'];
    $filter_to_date = $_POST['to_date'];

    $sql = "SELECT t.transaction_id, t.created_at, t.tracking_code, u1.first_name AS sender_name, b1.branch_name AS branch_from_name, u2.first_name AS receiver_name, b2.branch_name AS branch_to_name, t.amount, t.status, t.s_lastname 
            FROM transactions t 
            JOIN users u1 ON t.sender_id = u1.user_id
            JOIN users u2 ON t.receiver_id = u2.user_id
            JOIN branches b1 ON t.branch_from = b1.branch_id
            JOIN branches b2 ON t.branch_to = b2.branch_id
            WHERE t.receiver_id = ? AND DATE(t.created_at) BETWEEN ? AND ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $receiver_id, $filter_from_date, $filter_to_date);
} else {
    $sql = "SELECT t.transaction_id, t.created_at, t.tracking_code, u1.first_name AS sender_name, b1.branch_name AS branch_from_name, u2.first_name AS receiver_name, b2.branch_name AS branch_to_name, t.amount, t.status, t.s_lastname 
            FROM transactions t 
            JOIN users u1 ON t.sender_id = u1.user_id
            JOIN users u2 ON t.receiver_id = u2.user_id
            JOIN branches b1 ON t.branch_from = b1.branch_id
            JOIN branches b2 ON t.branch_to = b2.branch_id
            WHERE t.receiver_id = ? AND DATE(t.created_at) = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $receiver_id, $current_date);
}

$stmt->execute();
$result = $stmt->get_result();

$sql_received_count = "SELECT COUNT(*) AS received_count FROM transactions WHERE receiver_id = ? AND status = 'received'";
$stmt_received = $conn->prepare($sql_received_count);
$stmt_received->bind_param("i", $receiver_id);
$stmt_received->execute();
$result_received = $stmt_received->get_result();
$row_received = $result_received->fetch_assoc();
$received_count = $row_received['received_count'];


$sql_pending_count = "SELECT COUNT(*) AS pending_count FROM transactions WHERE receiver_id = ? AND status = 'pending'";
$stmt_pending = $conn->prepare($sql_pending_count);
$stmt_pending->bind_param("i", $receiver_id);
$stmt_pending->execute();
$result_pending = $stmt_pending->get_result();
$row_pending = $result_pending->fetch_assoc();
$pending_count = $row_pending['pending_count'];


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
    <input type="checkbox" id="checkbox">
    <header class="header">
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
                    <a href="sender_dashboard.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="send1.php">
                        <i class="fas fa-send" aria-hidden="true"></i>
                        <span>Send</span>
                    </a>
                </li>
                    <li>
                    <a href="recieve.php">
                        <i class="fas fa-hands-holding" aria-hidden="true"></i>
                        <span>Recieve</span>
                    </a>
                </li>
                <li>
                    <a href="report1.php">
                        <i class="fas fa-light fa-file" aria-hidden="true"></i>
                        <span>Reports</span>
                    </a>
                </li>
               
                <br><br><br>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>


<section  class="section-1" >
            <body>
                <main class="table" style="width: 1100px;">
                  
                    
                    <form method="POST" style="border-radius: 8px;">

                    <h1 style="font-size:25px; margin-left:800px;">Reports</h1>


                            <label for="from_date" >From Date:</label>
                            <input type="date" name="from_date" id="from_date" style="padding:8px; border-radius: 5px;background: linear-gradient(45deg, white, skyblue);">
                            <label for="to_date">To Date:</label>
                            <input type="date" name="to_date" id="to_date" style="padding:8px; border-radius: 5px;background: linear-gradient(45deg, white, skyblue);">
                            <button type="submit" name="filter" style="width: 80px; height: 40px;  background: linear-gradient(45deg, deepskyblue, #243b55);border-radius: 7px; ">Filter</button>
                            <button onclick="printTable()" style="width: 80px; height: 40px;  background: linear-gradient(45deg, green, #243b55);border-radius: 7px; ">Print</button>

                        </form>
                        

    <section class="table__body">      
    <body class="b_ody">
    <div class="header_fixed" >
        <table id="data-table" >
            <thead >
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
               <?php

    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
        
        <td ><?php echo $row["created_at"] ?></td>
        <td ><?php echo $row["tracking_code"] ?></td>
        <td ><?php echo $row["s_lastname"] ?></td>
        <td>
        <strong><label>Processed By:</label></strong>&nbsp;<?php echo $row["sender_name"] ?>
        <br> <br>
        <strong><label>From:</label></strong>&nbsp;<?php echo $row["branch_from_name"] ?>
        <br><br>
        <strong><label>Processed By:</label></strong>&nbsp;<?php echo $row["receiver_name"] ?>
        <br> <br>
        <strong><label>to:</label></strong>&nbsp;<?php echo $row["branch_to_name"] ?>
        
        </td>
        <td ><?php echo $row["amount"] ?></td>
        
            <td class="status"><?php echo $row["status"] ?></td>

        </tr>
        <?php
   
}

$conn->close();

?>



            </tbody>
        </table>
  

                    </section>
                </main>
            </body>
        </section>
</div>
</body>
    <script>
        function printTable() {
            var printWindow = window.open('', '', 'height=600,width=800');

            var tableContent = document.getElementById('data-table').outerHTML;

            printWindow.document.write('<html><head><title>Reports</title></head><body>');
            printWindow.document.write('<h1>Report</h1>');
            printWindow.document.write(tableContent);
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        }
    </script>
    <script>
    history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>



</html>
