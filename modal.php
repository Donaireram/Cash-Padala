
<?php
session_start();
include 'connect.php';
?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
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

    </head>
    <body>
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
        <section class="section-1">
           
      <?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tracking_number'])) {
        $tracking_number = $_POST['tracking_number'];

        
        header("Location: view_transaction.php?tracking_number=$tracking_number");
        exit();
    }
}

$sql = "SELECT transaction_id, sender_id, status, tracking_code FROM transactions";
$result = $conn->query($sql);
$pendingTransactions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["status"] == 'pending') {
            $pendingTransactions[] = $row;
        }
    }

    if (!empty($pendingTransactions)) {
    }
}
        ?>

        <center>
            <form action='update_status.php' method='POST'>
                <label style="color:white;">Enter Tracking Number</label>
                <br>
                <br>
            <input type='hidden' name='transaction_id' value='<?php echo $pendingTransactions[0]['transaction_id']; ?>'>
            <input type='text' name='tracking_number' placeholder='' style="background: linear-gradient(45deg, white, #243b55); color: black; width: 250px; height: 40px; border-radius:7px;"></input>
<br><br>
           <button type='submit' value='Receive' style="width: 50px; height: 30px;  background: linear-gradient(45deg, skyblue, #243b55);border-radius: 7px; ">Find</button>

        </form>
        <br>
         <a href="recieve.php">
           <button name="" type="" name="add" style=" width: 50px; height: 30px;  background: linear-gradient(45deg, skyblue, #243b55);border-radius: 7px; ">Cancel</button>
            </a>
        </center>
 




        </section>
    </div>

</body>
<script>
    history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>

</body>
</html>