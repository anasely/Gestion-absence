<?php
// Include the database connection file
include('db_connection.php');
include('check_auth.php');


// fetch data

// Retrieve the counts from your tables
$sqlStudents = "SELECT COUNT(*) AS student_count FROM students";
$sqlProfessors = "SELECT COUNT(*) AS professor_count FROM professors";
$sqlAdmins = "SELECT COUNT(*) AS admin_count FROM user";
$sqlAttendance = "SELECT COUNT(*) AS attendance_count FROM attendance where status = 'Absent'";

$resultStudents = $mysqli->query($sqlStudents);
$resultProfessors = $mysqli->query($sqlProfessors);
$resultAdmins = $mysqli->query($sqlAdmins);
$resultAttendance = $mysqli->query($sqlAttendance);

$studentCount = $resultStudents->fetch_assoc()['student_count'];
$professorCount = $resultProfessors->fetch_assoc()['professor_count'];
$adminCount = $resultAdmins->fetch_assoc()['admin_count'];
$attendanceCount = $resultAttendance->fetch_assoc()['attendance_count'];
// Close the database connection
$mysqli->close();

// Now, you can use the $mysqli object for database operations in this page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Statistique</title>
    <style>
        .leftSide {
            background-color: #ee1c25;
        }

        .item-selected {
            background-color: white;
            border-radius: 30px;
            padding: 10px;
            color: #ee1c25;
        }

        .item {
            border-radius: 30px;
            padding: 10px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-md-3 leftSide">
                <h5 class="text-white mt-3">Bonjour Anas</h5>
                <div class="item-selected text-center mt-3 d-flex align-items-startr">
                    <img src="./images/dashboard-blue.png" alt="dashboard" />
                    <span class="ml-3">Statistique</span>
                </div>
                <div class="items">
                    <div class="item text-center mt-3 d-flex align-items-startr">
                        <img src="./images/dashboard-white.png" alt="dashboard" />
                        <span class="ml-3"><a class="text-white" href="./AdminDashboardStudents.php">Gestion des
                                Etudiant</a></span>
                    </div>
                    <div class="item text-center mt-3 d-flex align-items-start">
                        <img src="./images/dashboard-white.png" alt="dashboard" />
                        <span class="ml-3"><a class="text-white" href="./admin_Dashboard_prof.php">Gestion des
                                professeur</a></span>
                    </div>
                    <div class="item text-center mt-3 d-flex align-items-start">
                        <img src="./images/dashboard-white.png" alt="dashboard" />
                        <span class="ml-3"><a class="text-white" href="./admin_dashboard_user.php">Gestion des
                                utilisateur</a></span>
                    </div>
                    <div class="item text-center mt-3 d-flex align-items-start">
                        <img src="./images/logout.png" alt="dashboard" />
                        <span class="ml-3"><a href="logout.php"> Se deconnecter</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h5 class="mt-5">Statistique</h5>


                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Tottal etudiants</h5>
                                    <p class="card-text">
                                        <?php echo $studentCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Tottal d'enseignants</h5>
                                    <p class="card-text">
                                        <?php echo $professorCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Tottal admins</h5>
                                    <p class="card-text">
                                        <?php echo $adminCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Absences aujourdhui</h5>
                                    <p class="card-text">
                                        <?php echo $attendanceCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>