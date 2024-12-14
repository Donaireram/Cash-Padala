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
    
         .input-group {
            display: flex;
            align-items: center;
        }

        .input-group input {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
            width: 200px;
        }

        .input-group img {
            width: 20px;
            height: 20px;
        }

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
                        <i class="fas fa-solid fa-user"  aria-hidden="true"></i>
                        <span>User List</span>

                    </a>
                </li>
                    <li>
                    <a href="fee.php">
                        <i class="fas fa-regular fa-table"  aria-hidden="true"></i>
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
                        <i class="fas fa-solid fa-trash-can-arrow-up"  aria-hidden="true"></i>
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

        <style>
    /* Styling for Add Button */
button[name="btn"] {
    background: linear-gradient(135deg, #1b4d3e, #388e3c);
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-block;
    top:  0px;
   
}

button[name="btn"]:hover {
    background-color: #388e3c; /* Lighter green on hover */
}

/* Responsive Design for Button */
@media (max-width: 768px) {
    button[name="btn"] {
        padding: 8px 16px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    button[name="btn"] {
        padding: 6px 12px;
        font-size: 12px;
        width: 100%; /* Full-width on small screens */
    }
}

</style>
<section   class="section-1">
 <body>
    <main class="table">
        <section class="table__header">

            <h1 style="font-size: 30px;">List of Branch</h1>
 <a href="branch_add.php">
           <button name="btn" type="submit" name="add" >+Add</button>
            </a>
           
           
        </section>
        <section class="table__body">
      <body class="b_ody">
    <div class="header_fixed">
        <table id="data-table">
            <thead>
                    <tr>
                       
                        <th> Branch Name </th>
                        <th> Address </th>
                        <th> Date Created </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                  	<?php
                	$sql = "SELECT * FROM branches";
                	$result = $conn->query($sql);
                	while ($row = $result->fetch_assoc()) {
                		?>
 						<tr>
                        
                        <td><?php echo $row["branch_name"] ?></td>
                        <td><?php echo $row["address"] ?></td>
                        <td><?php echo $row["created_at"] ?></td>                                        
                      <?php


                $selectOptions = '<td>';
                $selectOptions .= '<select class="hiddenSelect" >'; // Hidden select for action options
                $selectOptions .= '<option value="#">Action</option>';
                $selectOptions .= '<option value="branch_update.php?id=' . $row["branch_id"] . '">Edit</option>';
                $selectOptions .= '<option value="branch_del.php?id=' . $row["branch_id"] . '">Delete</option>';
                $selectOptions .= '</select>';
                $selectOptions .= '</td>';

                echo $selectOptions;
                ?>

                       
                    </tr>
                    <?php
                	}
                
                	?>
                   
                </tbody>
            </table>
        </section>
    </main>
</body>
</section>
	</div>
    <script>
    history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>

    <script>
    history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        history.go(1);
    };

    document.querySelectorAll('.actionButton').forEach(button => {
    button.addEventListener('click', function() {
        var select = this.nextElementSibling;
        if (select) {
            select.classList.toggle('show');
        }
    });
});

document.querySelectorAll('.hiddenSelect').forEach(select => {
    select.addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue !== '#') {
            window.location = selectedValue; // Redirect to the selected action
        }
    });
});
</script>

</body>
</html>
