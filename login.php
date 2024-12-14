<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT user_id, role, image, first_name FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_role, $user_image, $user_firstname);
        $stmt->fetch();
        $stmt->close();

        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['user_image'] = $user_image;
            $_SESSION['user_firstname'] = $user_firstname;

            if ($user_role == 'staff') {
                // Get the branch ID associated with the logged-in user and store it in the session
                $query_branch_id = "SELECT branch_id FROM branches WHERE user_id = ?";
                $stmt_branch_id = $conn->prepare($query_branch_id);
                
                if ($stmt_branch_id) {
                    $stmt_branch_id->bind_param("i", $user_id);
                    $stmt_branch_id->execute();
                    $stmt_branch_id->bind_result($branch_id);
                    $stmt_branch_id->fetch();
                    $stmt_branch_id->close();

                    $_SESSION['branch_id'] = $branch_id;
                } else {
                    echo "Error preparing statement for branch_id query: " . $conn->error;
                }
            }

            // Redirect based on user role
            switch ($user_role) {
                case 'admin':
                    header("Location: admin_dashboard.php");
                    exit();
                case 'staff':
                    header("Location: sender_dashboard.php");
                    exit();
                default:
                    echo "Invalid user role.";
            }
        } else {
            echo "<script>alert('Incorrect username or password')</script>";
            echo "<script>window.location.replace('login.php')</script>";
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script>
        function preventBack(){window.history.forward()};
        setTimeout("preventBack()",0);
        window.onunload=function(){null;}
    </script>
</head>
<style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("img/bground.jpg");
        background-size: cover;
    }

    nav {
        font-family: var(--poppins);
        background: linear-gradient(135deg, rgba(6,64,43, 0.4), rgba(12, 12, 30, 0.5));        color: white;
        padding: 5px;
    }
    
    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    nav ul li {
        margin-right: 20px;
    }

    nav ul li img {
        width: 70px; height:60px; border-radius:8px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
    }

    main {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container {
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        font-size: 20px;
        color: white;
    }
    h1 {
        margin-bottom: 20px;
        font-size: 20px;
        color: white;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .input-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #E6E7E8;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px 20px;
        background-color: #4285f4;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2a66b8;
    }

    .container {
        margin-top: 100px;
        background: linear-gradient(135deg, rgba(6,64,43, 0.8), rgba(12, 12, 30, 0.8));
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 40px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
        border-radius: 10px;
    }

    .input-field {
        margin-top: 20px;
        width: 250px;
    }

    .input-field label {
        color: #E6E7E8;
        font-weight: 400;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        border: none;
        background: #211F1f;
        padding: 10px;
        color: #E6E7E8;
        outline: none;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        transition: 0.5s linear;
        border-bottom: 1px solid #E6E7E8;
    }

    .container button {
        cursor: pointer;
        margin-top: 20px;
        padding: 10px 20px;
        font-weight: 700;
        border-radius: 5px;
        border: none;
        outline: none;
        background-color: #0984e3;
        color: #E6E7E8;
    }

    .container button:hover {
        transition: 0.3s linear;
        color: #0984e3;
        background-color: #E6E7E8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin-top: 50px;
            width: 80%;
        }

        .input-field {
            width: 90%;
        }

        h2 {
            font-size: 18px;
        }

        nav ul {
            flex-direction: column;
            align-items: flex-start;
        }

        nav ul li {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }

    @media (max-width: 480px) {
        .container {
            width: 90%;
            padding: 15px;
        }

        .input-field {
            width: 100%;
        }

        h2 {
            font-size: 16px;
        }
    }
 </style>

<body>

    <nav>
        <ul>
            <li>
                <img src="img/pay.jpg" >
            </li>
            <li>
                <h1>CASH PADALA</h1>
            </li>
        </ul>
    </nav>

    <form method="POST">
        <div class="container">
            <h2>Login</h2>
            <div class="input-field">
                <input class="box" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <input class="box" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-field">
                <input type="checkbox">
                <label>Remember Me</label>
            </div>
            <button class="loginbtn" type="submit" name="submit">Sign in</button>
        </div>
    </form>

</body>
</html>
