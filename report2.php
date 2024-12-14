<?php
include('connect.php');

if (isset($_POST['filter'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $sql = "SELECT * FROM transaction_list WHERE date_created BETWEEN '$from_date' AND '$to_date'";
} else {
    $sql = "SELECT * FROM transaction_list";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" href="css/bar.css">
	 <link rel="stylesheet" type="text/css" href="css/table.css">
</head>

<body class="">
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
				<img src="img/avatar.jpg">
				<h4>Admin</h4>
			</div>
			<ul>
				<li>
					<a href="reciever_dashboard.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="recieve.php">
						<i class="fas fa-hands-holding" aria-hidden="true"></i>
						<span>Recieve</span>
					</a>
				</li>
				<li>
					<a href="report2.php">
						<i class="fas fa-light fa-file" aria-hidden="true"></i>
						<span>Reports</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span>Maintenance</span>
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


 <section style="color: white; background-color: black;" class="section-1">
            <body>
                <main class="table">
                    <section class="table__header" style="background-color:  rgba(0, 0, 0, 0.3); border-radius: 8px;">
                        <h1>Transaction List</h1>
                        <div class="input-group">
                            <input type="search">
                            <img src="img/search.png" alt="">
                        </div>
                    </section>
                    <br>
                    <form method="POST" style="background-color:  rgba(204, 209, 209, 0.3); padding: 15px	;border-radius: 8px;">
                            <label for="from_date">From Date:</label>
                            <input type="date" name="from_date" id="from_date">
                            <label for="to_date">To Date:</label>
                            <input type="date" name="to_date" id="to_date">
                            <button type="submit" name="filter" style="width: 80px; height: 40px; background-color: lightblue;border-radius: 7px; ">Filter</button>
                        </form>
                    <section class="table__body">
                        
                        <table>
                            <thead>
                                <tr>
                                    <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Date Created <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Transaction #<span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Client <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>$row[id]</td>
                                        <td>$row[date_created]</td>
                                        <td>$row[tracking_code]</td>
                                        <td>$row[s_firstname]</td>
                                        <td></td>
                                        <td>$row[amount]</td>
                                        
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </body>
        </section>
</div>

</body>
</html>