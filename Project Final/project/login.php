<?php
// Include the database connection file
include('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the credentials match any of the three tables
    $userType = '';
    $userId = ''; // Initialize the user ID variable

    // Check in the "students" table
    $sql = "SELECT * FROM students WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $userType = 'student';
        $row = $result->fetch_assoc();
        $userId = $row['id']; 
    }
    
    // Check in the "user" table
    if (!$userType) {
        $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $userType = 'user';
            $row = $result->fetch_assoc();
            $userId = $row['id']; 
        }
    }
    
    // Check in the "professors" table
    if (!$userType) {
        $sql = "SELECT * FROM professors WHERE login = ? AND password = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $userType = 'prof';
            $row = $result->fetch_assoc();
            $userId = $row['id']; 
        }
    }

    // Determine the user type and redirect accordingly
    if ($userType) {
        // Successful login, redirect to the appropriate page based on user type
        $_SESSION['user_id'] = $userId;

        if ($userType === 'student') {
            header("Location: StudentDashboard.php");
        } elseif ($userType === 'user') {
            header("Location: admin_dashboard_user.php");
        } elseif ($userType === 'prof') {
            header("Location: ProfDashboard.php");
        }
        exit();
    } else {
        // Invalid login, redirect to an error page or show an error message
        header("Location: login.php");
        exit();
    }
}

// Close the database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Login</title>
    <style>
        .leftSide {
            background-color: #EE1C25;
        }

        .loginButton {
            background-color: #7B96D4;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-md-6 leftSide p-5 d-flex flex-column justify-content-center">
                <h3 class="text-center text-white">Connexion a votre compte</h3>
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="username">Nom d’utilisateur :</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Entrez votre nom d'utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Entrez le mot de passe" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Se connecter</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="./images/book.png" />
            </div>

        </div>
    </div>

</body>

</html>