<?php 
include 'connect.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
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
    .container header{
        position: relative;
        font-size: 20px;
        font-weight: 600px;
        color: #333;


    }
    .container header::before{

        position: absolute;
        left: 0;
        bottom: -2px;
        height: 3px;
        width: 27px;
        border-radius: 8px;
        background-color: #343a40;
    }
    .container form{
        position: relative;
        margin-top: 16px;
        min-height:490px ;

        
    }
    .container form .details{
        margin-top: 10px;

    }
    .container form .title{
        font-size: 22px;
        font-weight: 500;
        margin: 6px 0;
        color: #333;
    }
    .container form .field{
        
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
    form .field .input-field{
        display: flex;
        width: calc(100% / 3 - 15px);
        flex-direction: column;
    }


    .input input{
        outline: none;
        font-size: 14px;
        font-weight: 100;
        color: #333;
        border:1px solid #aaa;
        padding: 0 15px;
        height: 15px;
        margin: 8px 0;
    }
    .input-field input{
        outline: none;
        font-size: 14px;
        font-weight: 400;
        color: #333;
        border-radius: 5px ;
        border:1px solid #aaa;
        padding: 0 15px;
        height: 42px;
        margin: 8px 0;
    }
    main.table {
        padding: 20px;
        width: 82vw;
        height: 100vh;
        background-color: #fff5;
        backdrop-filter: blur(7px);
        box-shadow: 0 .4rem .8rem #0005;
        border-radius: .8rem;
        overflow: auto;


    }


</style>
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
       <section  style="color: white; overflow: hidden;" class="section-1">
    <main class="table" style="width:1110px; background-color: rgba(0, 0, 0, 0.3);">

                <div class="container">

  <h1 style="margin-top:-10px; margin-left:0px; font-size:38px ;">Transaction Details</h1>
  <br>

<?php
include 'connect.php';

if (isset($_GET['tracking_number'])) {
    $tracking_number = $_GET['tracking_number'];

    $sql = "SELECT *, b.branch_name FROM transactions t JOIN branches b ON t.branch_from = b.branch_id WHERE t.tracking_code = '$tracking_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="Print">';
            echo '<div style="color:white; margin-left:0px;">';
            echo '<h3>Tracking Code:</h3>';
            echo '<p style="font-size: 20px; background-color:;">' . (isset($row['tracking_code']) ? $row['tracking_code'] : '') . '</p>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
            echo '<h3>Sender Details:</h3>';
            echo '<table>';
            echo '<tr><td>Name:</td><td>' . (isset($row['s_lastname']) ? $row['s_lastname'] . ' ' . $row['s_middlename'] : '') . '</td></tr>';
            echo '<tr><td>Contact:</td><td>' . (isset($row['s_contact']) ? $row['s_contact'] : '') . '</td></tr>';
            echo '<tr><td>Address:</td><td>' . (isset($row['s_address']) ? $row['s_address'] : '') . '</td></tr>';
            echo '</table>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
            echo '<div>';
            echo '<h3>Receiver Details:</h3>';
            echo '<table>';
            echo '<tr><td>Name:</td><td>' . (isset($row['r_lastname']) ? $row['r_lastname'] . ' ' . $row['r_middlename'] : '') . '</td></tr>';
            echo '<tr><td>Contact:</td><td>' . (isset($row['r_contact']) ? $row['r_contact'] : '') . '</td></tr>';
            echo '<tr><td>Address:</td><td>' . (isset($row['r_address']) ? $row['r_address'] : '') . '</td></tr>';
            echo '</table>';
            echo '</div>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
            echo '<h3>Details:</h3>';
            echo '<table>';
            echo '<tr><td>Amount:</td><td>' . (isset($row['amount']) ? $row['amount'] : '') . '</td></tr>';
            echo '<tr><td>Purpose:</td><td>' . (isset($row['purpose']) ? $row['purpose'] : '') . '</td></tr>';
            echo '<tr><td>Sent From:</td><td>' . (isset($row['branch_name']) ? $row['branch_name'] : '') . '</td></tr>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Transaction not found.";
    }
}
?>




<br>
 <form method="POST" action="recieve.php">
<label style="font-size: 20px; font-weight: bold;">Recieving Details:</label>
<form method="POST">

                            <div class="btn">

                                <br>
                                <button style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: green; scroll-margin-bottom: 50px;"  formaction="recieve.php"  required>Done</button>
                               
                                <div class="btn" style="margin-left: 200px; margin-top: -76px">

                                <br>
                                <button style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: deepskyblue; margin-top:20px"  name=""  required onclick="printTransaction()">Print Details</button>
                            </div>

            </form>
    </div>
    </main>


</section>
<script>
function printTransaction() {
    var printContents = document.getElementsByClassName('Print')[0].innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}


</script>
<script>
    history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
