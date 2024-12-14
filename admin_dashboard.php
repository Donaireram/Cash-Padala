<?php
	session_start();
	include 'connect.php';


	$sql = "SELECT MONTH(created_at) AS month, SUM(fee) AS total_income FROM transactions GROUP BY MONTH(created_at)";
	$result = $conn->query($sql);
	$labels = [];
	$data = [];
	while ($row = $result->fetch_assoc()) {
		$labels[] = date('F', mktime(0, 0, 0, $row['month'], 1));
		$data[] = $row['total_income'];
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
   function preventBack(){window.history.forward()};
   setTimeout("preventBack()",0);
   window.onunload=function(){null;}
</script>
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
<body >

	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name">CASH <b>PADALA</b>
		<label for="checkbox">
                
		</h2>
		
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img  src="<?php echo $_SESSION['user_image']; ?>">
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
		<section class="section-1">
			<?php
include 'connect.php';


$currentMonth = date('m');


$sql_monthly_income = "SELECT SUM(fee) AS monthly_income FROM transactions WHERE status = 'received' AND MONTH(created_at) = '$currentMonth'";
$result_monthly_income = $conn->query($sql_monthly_income);
$row_monthly_income = $result_monthly_income->fetch_assoc();
$monthly_income = $row_monthly_income['monthly_income'];


$nextMonth = date('m', strtotime('+1 month')); 
if ($nextMonth != $currentMonth) {
    $sql_total_income = "SELECT SUM(fee) AS total_income FROM transactions WHERE status = 'received'";
    $result_income = $conn->query($sql_total_income);
    $row_income = $result_income->fetch_assoc();
    $total_income = $row_income['total_income'];
} else {

    $total_income = $monthly_income;
}

$sql_total_count = "SELECT COUNT(*) AS total_count FROM transactions";
$result_total = $conn->query($sql_total_count);
$row_total = $result_total->fetch_assoc();
$total_count = $row_total['total_count'];

$conn->close();
?>

<?php
include 'connect.php';

function getTotalDailyTransactions($conn)
{
    // Get the current date in "Y-m-d" format
    $current_date = date("Y-m-d");

    // Prepare the SQL query to calculate the total of transactions for the current date with 'received' status
    $sql_daily_total = "SELECT SUM(fee) AS daily_total 
                        FROM transactions 
                        WHERE DATE(created_at) = CURDATE() AND status = 'received'";

    $result = $conn->query($sql_daily_total);

    // Check if the query executed successfully and fetch the result
    if ($result) {
        $row = $result->fetch_assoc();
        // Return the daily total, default to 0 if no rows are found
        return $row['daily_total'] ?? 0;
    } else {
        // Log or handle the error as needed
        return 0; // Default to 0 in case of error
    }
}

// Call the function to get the total daily transaction amount
$total_daily_transactions = getTotalDailyTransactions($conn);

// Close the database connection
$conn->close();
?>


<div class="body1" >

	<section id="content" >

		<main>
			<div class="head-title">
				<div class="left">
					<h1></h1>
									
				</div>

				
			</div>


			<ul class="box-info">
				<li>
					<i class='bx bx-line-chart'></i>
					<span class="text">
						<h3><?php echo $total_count; ?></h3>
						<strong><span>Total Transaction</span></strong>
					</span>
				</li>
				
				<li>
					<i class='bx bx-bar-chart-alt-2' ></i>
					<span class="text">
						<h3>₱<?php  echo $total_income; ?></h3>
						<strong><span>Total Income</span></strong>
					</span>
				</li>
			<li>
					<i class='bx bx-bar-chart-alt-2' ></i>
					<span class="text">
						<h3>₱<?php  echo $total_daily_transactions; ?></h3>
						<strong><span>Daily income</span></strong>
					</span>
				</li>
				<li>
					<i class='bx bx-calendar-check'></i>
					<span class="text">
						<h3>₱<?php  echo $monthly_income; ?></h3>
						<strong><span>Monthly Income</span></strong>
					</span>
				</li>
				
				
			</ul>


		</main>

		 <div>
            <canvas id="incomeChart"></canvas>
        </div>
	
</div>

       <script>
	var labels = <?php echo json_encode($labels); ?>; // Your fetched month names array
	var data = <?php echo json_encode($data); ?>; // Your fetched income data array

	var allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

	var allMonthsLabels = allMonths.slice();
	var allMonthsData = Array(12).fill(0);

	for (var i = 0; i < labels.length; i++) {
	    var index = allMonths.indexOf(labels[i]);
	    allMonthsData[index] = data[i];
	}

	var ctx = document.getElementById('incomeChart').getContext('2d');

	var chart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: allMonthsLabels,
	        datasets: [{
	            label: 'Monthly Income',
	            data: allMonthsData,
	            backgroundColor: 'rgba(54, 162, 235, 0.2)',
	            borderColor: 'rgba(54, 162, 235, 1)',
	            borderWidth: 1,
	            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
	            pointRadius: 4,
	            pointHoverRadius: 6,
	            fill: true, // Enable area fill
	            tension: 0.4 // Adjust the curve tension
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }
	        },
	        plugins: {
	            stacked100: { enable: true } // Enable 100% stacked area chart
	        }
	    }
	});




</script>
<script>
       function preventBack() { window.history.forward(); }
       setTimeout("preventBack()", 0);
       window.onunload = function(){ null; }

       // Toggle function for the navbtn (hamburger menu)
       document.addEventListener("DOMContentLoaded", function() {
           const navbtn = document.getElementById("navbtn");
           const checkbox = document.getElementById("checkbox");

           navbtn.addEventListener("click", function() {
               checkbox.checked = !checkbox.checked; // Toggle the checkbox state
           });
       });
    </script>
</section>


</div>
</body>
</html>