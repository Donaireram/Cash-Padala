<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" href="css/bar.css">
	 <link rel="stylesheet" type="text/css" href="css/send2.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name">PERA <b>PADALA</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<img src="img/pera.jpg" ></img>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="img/avatar.jpg">
				<h4>Admin</h4>
			</div>
			<ul>
				<li>
					<a href="dashboard.php">
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
					<a href="list.php">	
						<i class="fas fa-regular fa-table-list" aria-hidden="true"></i>
						<span>List</span>
					</a>
				</li>
				<li>
					<a href="report.php">
						<i class="fas fa-light fa-file" aria-hidden="true"></i>
						<span>Reports</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span>Maintenance</span>
					</a>
				</li>
				<li>
					<a href="branch.php">
						<i class="fas fa-code-branch" style="color: #ffffff;" aria-hidden="true"></i>
						<span>Branch List</span>

					</a>
				</li>
				<br><br><br>
				<li>
					<a href="login.php">
						<i class="fa fa-power-off" style="color: #ffffff;" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
					
			</ul>
		</nav>
		<section  style="color: white; background-color: ;" class="section-1">
    <main class="table">
        <section class="table__header">
        	<h2 style="margin-top: 20px; ">Add New Transaction</h2>       
        	 </section>
        	 <hr>
        	<div class="container">
			 <form method="POST">
				<div class="form first">
					<div class="details">
						<span class="title" style="color:white;">Sender Details</span>
</div><br>
<div>
						<div class="field">
							<div class="input-field">
								<label>First Name</label>
								<input type="text" name="firstname"  required>
							</div>

							<div class="input-field">
								<label>Last Name</label>
								<input type="text" name="lastname"  required>
							</div>

							<div class="input-field">
								<label>Middle Name</label>
								<input type="text" name="middle"  required>
							</div>

							<div class="input-field">
								<label>Contact</label>
								<input type="text" name="phone" required>
							</div>

							<div class="input-field">
								<label>Address</label>
								<input type="text" name="address" style="padding: 25px;" required>
							</div>

						</div>
					</div>
				</div>
				<br>
				<hr>

				<div class="form first">
					<div class="details">
						<span class="title" style="color:white;">Reciver Details</span>
</div><br>
<div>
						<div class="field">
							<div class="input-field">
								<label>First Name</label>
								<input type="text" name="firstname"  required>
							</div>

							<div class="input-field">
								<label>Last Name</label>
								<input type="text" name="lastname"  required>
							</div>

							<div class="input-field">
								<label>Middle Name</label>
								<input type="text" name="middle"  required>
							</div>

							<div class="input-field">
								<label>Contact</label>
								<input type="text" name="phone" required>
							</div>

							<div class="input-field">
								<label>Address</label>
								<input type="text" name="address" style="padding: 25px;" required>
							</div>

						</div>
					</div>
				</div>
				<br>
				<hr>

				<div class="form first">
					<div class="details">
						<span class="title" style="color:white;">Details</span>
</div><br>
<div>
						<div class="field-area2">
								<label >Amount to Send</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px;width: 475px; "  type="number" name="firstname"  required>
							</div>
						<div class="field-area2" style="margin-left: 500px; margin-top: -72px;">
								<label>Transaction Fee</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px;width: 475px;" type="number" name="lastname"  required>
							</div>
						<div class="field-area3" style="margin-top: 20px;">
								<label>Payable Amount</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px;width: 475px;"  type="number" name="email" required>
							</div>
						<div class="field-area4" style="margin-top: 20px">
								<label>Purpose/Remarks</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px;width: 475px;" type="number" name="phone"  required>
							</div>

						<div class="field-area5" style="margin-top: 20px">
								<label>address</label>
								<br>
								<br>
								<input style="padding: 10px; border-radius: 5px; width: 475px;" type="number" name="address" required>
							</div>

						</div>
					</div>
				</div>
				<br>

				<div class="btn" ">

								<br>
								<input style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: green; scroll-margin-bottom: 50px; " type="submit" name="save"  required></input>

								<br>
								<button style="padding: 10px ; border-radius: 5px; width: 150px; color: white; background-color: gray; margin-top:20px"  name="save"  required ><a href="#" style="color:white">Cancel</a> </button>
							</div>
							
				
			</form>
	</div>
    </main>
</section>
	</div>

</body>
</html>