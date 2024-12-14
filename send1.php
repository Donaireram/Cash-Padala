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
	<style>
		body{
			overflow: auto;
		}
	</style>

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

<section  style="color: white;overflow: auto;" class="section-1">
    <main class="table" style="width:1110px; background-color: rgba(0, 0, 0, 0.3);">
        <section class="table__header">
        	<h2 style="margin-top: 20px; ">Add New Transaction</h2>       
        	 </section>
        	 <hr>
        	<div class="container">

			 <form method="POST" id="amountForm" action="insert.php">

				<div class="form first">
					<div class="details">
						<span class="title" style="color:white;">Sender Details</span>
					</div>
					<br>
						<div>
						<div class="field">
							

							<div class="input-field">
								<label>First Name</label>
								<input type="text" name="s_lastname"  required>
							</div>

							<div class="input-field">
								<label>Last Name</label>
								<input type="text" name="s_middlename"  required>
							</div>

							<div class="input-field">
								<label>Contact</label>
								<input type="number" name="s_contact" required>
							</div>

							<div class="input-field">
								<label>Address</label>
								<input type="text" name="s_address" style="padding: 25px;" required>
							</div>

						</div>
					</div>
				</div>
				<br>
				<hr>
						<!--------------------------------Reciver area-------------------------------->

				<div class="form first">
					<div class="details">

						<span class="title" style="color:white;">Reciver Details</span>
</div><br>
<div>
						<div class="field">
							
							
							<div class="input-field">
								<label>First Name</label>
								<input type="text" name="r_lastname"  required>
							</div>

							<div class="input-field">
								<label>Last Name</label>
								<input type="text" name="r_middlename"  required>
							</div>

							<div class="input-field">
								<label>Contact</label>
								<input type="number" name="r_contact" required>
							</div>

							<div class="input-field">
								<label>Address</label>
								<input type="text" name="r_address" style="padding: 25px;" required>
							</div>


						</div>
					</div>
				</div>
				<br>
				<hr>

		<!--------------------------------Details area-------------------------------->

				<div class="form first">
					<div class="details">
						<span class="title" style="color:white;">Details</span>
</div><br>
<div>
						<div class="field-area2">

		<!--------------------------------Calculation area-------------------------------->
		 
        <label for="amount">Amount to Send</label>
        <br>
		<br>
        <input style="padding: 10px; border-radius: 5px;width: 475px; " type="number" id="amount" name="tamount" oninput="calculateTotalAmount()" required>
</div>
<div class="field-area2" style="margin-left: 500px; margin-top: -72px;">
        <label for="fee">Transaction Fee</label>
        <br>
		<br>
        <input style="padding: 10px; border-radius: 5px;width: 475px; " type="text" id="fee" name="fee" readonly>
</div>
<div class="field-area3" style="margin-top: 20px;">
        <label for="totalAmount">Payable Amount</label>
        <br>
		<br>
        <input style="padding: 10px; border-radius: 5px;width: 475px; " type="text" id="totalAmount" name="amount" readonly value="<?php echo isset($totalAmount) ? $totalAmount : ''; ?>">
	</div>
        
<!--------------------------------Calculation area-------------------------------->

						<div class="field-area4" style="margin-top: 20px">
								<label>Purpose/Remarks</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px;width: 475px;" type="text" name="purpose"  required>

							</div>
							<div class="field-area4" style="margin-top: 20px">
								<label>Select Branch From</label>
								<br>
								
								<select name="branch_from" style="padding: 10px; border-radius: 5px;width: 475px;margin-top: 20px">
            <?php
            
            include 'connect.php';

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT branch_id, branch_name FROM branches";
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['branch_id'] . "'>" . $row['branch_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No branches available</option>";
            }
            ?>
        </select>
								
							</div>
							<div class="field-area4" style="margin-top: 20px">
								<label>Select Sender</label>
								<br>
								
								<select name="sender_id" style="padding: 10px; border-radius: 5px;width: 475px;margin-top: 20px">
            <?php
            
            include 'connect.php';

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT user_id, first_name FROM users";
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['user_id'] . "'>" . $row['first_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No branches available</option>";
            }
            ?>
        </select>
								
							</div>

							<div class="field-area3" style="margin-left: 500px;margin-top: -280px;">
							
							<div class="input-field">
								<label>Select Branch To:</label>
								
								
        <select name="branch_id" style="padding: 10px; border-radius: 5px;width: 475px;margin-top: 20px">
            <?php
            
            include 'connect.php';

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT branch_id, branch_name FROM branches";
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['branch_id'] . "'>" . $row['branch_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No branches available</option>";
            }
            ?>
        </select>
							</div>
							<div class="field-area3" style="margin-left: -5px; margin-top: 40px;">
							
							<div class="input-field">
								<label>Select Receiver:</label>
								
								
        <select name="receiver_id" style="padding: 10px; border-radius: 5px;width: 475px;margin-top: 20px">
            <?php
            
            include 'connect.php';

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT user_id, first_name FROM users";
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['user_id'] . "'>" . $row['first_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No branches available</option>";
            }
            ?>
        </select><br><br>
							</div>

							<div class="form first">
					<div class="details">

					
</div><br>
<div>
						</div>
					</div>
				</div>
				<br>

				<div class="btn" style="margin-left:-500px; margin-top:90px">

								<br>
								<input style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: green; scroll-margin-bottom: 50px; " type="submit" name="submit"  required></input>

								<div class="btn" style="margin-left: 200px; margin-top: -76px">

								<br>
								<button style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: gray; margin-top:20px"  name=""  required ><a href="send1.php" style="color:white">Cancel</a> </button>
							</div>
				
			</form>
	</div>
    </main>

</section>
<?php
$sql = "SELECT * FROM fee_structure";
$result = $conn->query($sql);

$feeStructure = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feeStructure[] = $row;
    }
}

?>
	
	</div>
	
<script>

    var feeStructure = <?php echo json_encode($feeStructure); ?>;

    function calculateTotalAmount() {
        var amountInput = document.getElementById('amount');
        var feeInput = document.getElementById('fee');
        var totalAmountInput = document.getElementById('totalAmount');

        var amount = parseFloat(amountInput.value);

        // Get the fee percentage for the given amount
        var feePercentage = getFeePercentage(amount);

        if (!isNaN(amount)) {
            var fee = amount * (feePercentage / 100); // Calculate fee as percentage
            var totalAmount = amount + fee;           // Add fee to total amount

            feeInput.value = fee.toFixed(2);
            totalAmountInput.value = totalAmount.toFixed(2);
        } else {
            feeInput.value = '';
            totalAmountInput.value = '';
        }
    }

    function getFeePercentage(amount) {
        for (var i = 0; i < feeStructure.length; i++) {
            if (amount >= feeStructure[i].amount_from && amount <= feeStructure[i].amount_to) {
                return feeStructure[i].fee_percentage;
            }
        }
        return 0; // Default if no structure matches
    }

</script>
</body>
</html>