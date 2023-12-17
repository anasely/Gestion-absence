<?php
include('db_connection.php');
include('check_auth.php');
include('check_auth.php');


$student_id = $_SESSION['user_id'];


$query = "SELECT nom_etudiant FROM students WHERE id = '$student_id'";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
  // Fetch the student's name
  $row = $result->fetch_assoc();
  $student_name = $row['nom_etudiant'];

  // Now you have the student's name in the $student_name variable
} else {
}

$sql = "SELECT date
        FROM attendance
        WHERE student_id = '$student_id' AND status = 'absent'";

$result = $mysqli->query($sql);

// Initialize an array to store absence records
$absenceRecords = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $absenceRecords[] = $row;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

  <title>Student Dashboard</title>
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
        <h5 class="text-white mt-3">Bonjour
          <?php echo $student_name; ?>

        </h5>
        <div class="items mt-5">
          <div class="item-selected text-center mt-3 d-flex align-items-startr">
            <img src="./images/dashboard-blue.png" alt="dashboard" />
            <span class="ml-3">Consulter mes absences</span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/notification-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentNotification.php">Mes notification</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/chat-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentChat.php">Chat</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/logout.png" alt="dashboard" />
            <span class="ml-3"><a href="logout.php"> Se deconnecter</a>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <h5 class="mt-5">Tableau de bord</h5>
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">Matiere</th>
              <th scope="col">Date</th>
              <th scope="col">Horaire</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($absenceRecords as $record) {
              $absenceDate = $record['date'];

              echo "<tr>
                    <td>ITC</td>
                    <td>$absenceDate</td>
                    <td>9-12</td>
                  </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>