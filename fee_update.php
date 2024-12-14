<?php
session_start();
include 'connect.php';

// Initialize variables to avoid undefined variable errors
$amount_from = $amount_to = $fee_percentage = "";

// Fetch data for updating if 'id' is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data based on the ID
    $sql_fetch = "SELECT amount_from, amount_to, fee_percentage FROM fee_structure WHERE id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("i", $id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $amount_from = $row['amount_from'];
        $amount_to = $row['amount_to'];
        $fee_percentage = $row['fee_percentage'];
    } else {
        echo "Record not found.";
        exit();
    }

    $stmt_fetch->close();
}

// Handle form submission (update operation)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['amount_from']) && isset($_POST['amount_to']) && isset($_POST['fee_percentage'])) {
        $id = $_POST['id'];
        $amount_from = $_POST['amount_from'];
        $amount_to = $_POST['amount_to'];
        $fee_percentage = $_POST['fee_percentage'];

        // Update the record
        $sql_update = "UPDATE fee_structure SET amount_from = ?, amount_to = ?, fee_percentage = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("dddi", $amount_from, $amount_to, $fee_percentage, $id);

        if ($stmt_update->execute()) {
            echo "Record updated successfully.";
            header('Location:fee.php');
            
        } else {
            echo "Error: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Invalid form submission.";
    }
}
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
/* Form Layout and Button Styling */
.container form {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.container form .input-field {
    width: 100%;
    max-width: 400px;
    margin: 12px auto;
}

.container form .input-field label {
    display: block;
    font-size: 16px;
    font-weight: 500;
    color: #ccc;
    margin-bottom: 6px;
}

.container form .input-field input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    color: #333;
    border: 1px solid #aaa;
    border-radius: 5px;
    margin-top: 6px;
}

.container form .input-field input:focus {
    border-color: var(--green);
    outline: none;
}

/* Submit Button */
.container form input[type="submit"] {
    width: 100%;
    max-width: 200px;
    background-color: var(--green);
    color: white;
    font-size: 16px;
    font-weight: 600;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    transition: background-color 0.3s;
    
}

.container form input[type="submit"]:hover {
    background-color: #218838;
}

.container form input[type="submit"]:focus {
    outline: none;
    
}
.container form input[type="button"] {
    width: 100%;
    max-width: 200px;
    background-color: var(--red);
    color: white;
    font-size: 16px;
    font-weight: 600;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    transition: background-color 0.3s;
    
}

.container form input[type="button"]:hover {
    background-color: #218838;
}

.container form input[type="button"]:focus {
    outline: none;
    
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
                        <i class="fas fa-light fa-money-bill"aria-hidden="true"></i>
                        <span>Income</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="fas fa-solid fa-user" style="color: #ffffff;" aria-hidden="true"></i>
                        <span>User List</span>

                    </a>
                </li>
                    <li>
                    <a href="fee.php">
                        <i class="fas fa-regular fa-table" style="color: #ffffff;" aria-hidden="true"></i>
                        <span>Fee List</span>

                    </a>
                </li>
                    <li>
                    <a href="branch.php">
                        <i class="fas fa-code-branch" style="color: #ffffff;" aria-hidden="true"></i>
                        <span>Branch List</span>

                    </a>
                </li>
                <li>
                    <a href="archive1.php">
                        <i class="fas fa-solid fa-trash-can-arrow-up" style="color: #ffffff;" aria-hidden="true"></i>
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
    

<section  style="color: white;" class="section-1">
    <main class="table" style="width:1110px; background-color: rgba(0, 0, 0, 0.3);">
        <section class="table__header">
            <h2 style="margin-top: 20px; ">Update</h2>       
             </section>
             <hr>
            <div class="container">

            <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

    <div class="input-field">
        <label>Amount From</label>
        <input type="text" name="amount_from" value="<?php echo htmlspecialchars($amount_from); ?>" required>
    </div>

    <div class="input-field">
        <label>Amount To</label>
        <input type="text" name="amount_to" value="<?php echo htmlspecialchars($amount_to); ?>" required>
    </div>

    <div class="input-field">
        <label>Percent</label>
        <input type="text" name="fee_percentage" value="<?php echo htmlspecialchars($fee_percentage); ?>" required>
    </div>

    <input type="submit" name="submit" value="Update">
    <input type="button" value="Cancel" name="button" onclick="window.location.href='branch.php';">
</form>


    </div>
    </main>

</section>
    
    </div>

</body>
</html>