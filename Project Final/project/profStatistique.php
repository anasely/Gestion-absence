<?php
include('db_connection.php');
include('check_auth.php');


$student_id = $_SESSION['user_id'];

// Retrieve the counts of students who are present and absent
$sqlPresent = "SELECT COUNT(*) AS present_count FROM attendance WHERE status = 'present'";
$sqlAbsent = "SELECT COUNT(*) AS absent_count FROM attendance WHERE status = 'absent'";
// Retrieve the total number of students
$sqlTotalStudents = "SELECT COUNT(*) AS total_students FROM students";

$resultTotalStudents = $mysqli->query($sqlTotalStudents);

$totalStudentsCount = $resultTotalStudents->fetch_assoc()['total_students'];

$resultPresent = $mysqli->query($sqlPresent);
$resultAbsent = $mysqli->query($sqlAbsent);

$presentCount = $resultPresent->fetch_assoc()['present_count'];
$absentCount = $resultAbsent->fetch_assoc()['absent_count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

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
                <div class="items mt-5">
                    <div class="item text-center d-flex align-items-start">
                        <img src="./images/dashboard-white.png" alt="dashboard" />
                        <span class="ml-3"><a class="text-white" href="./ProfDashboard.php">Les etudiants
                                absents</a></span>
                    </div>
                    <div class="item-selected text-center mt-3 d-flex align-items-start">
                        <img src="./images/dashboard-blue.png" alt="dashboard" />
                        <span class="ml-3"><a class="" href="./profStatistique.php">Statistique</a></span>
                    </div>

                    <div class="item text-center mt-3 d-flex align-items-start">
                        <img src="./images/chat-white.png" alt="dashboard" />
                        <span class="ml-3"><a class="text-white" href="./ProfChat.php">Chat</a></span>
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
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Students</h5>
                                    <p class="card-text">
                                        <?php echo $totalStudentsCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Students Present</h5>
                                    <p class="card-text">
                                        <?php echo $presentCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Students Absent</h5>
                                    <p class="card-text">
                                        <?php echo $absentCount; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p>Date aujourd'hui:
                            <?php echo date("Y-m-d"); ?>
                        </p>
                        <p>Filiere: THYP</p>
                        <p>Matiere: IOT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>







</body>

</html>