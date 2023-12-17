<?php
// Include the database connection file
include('db_connection.php');

function isStudentAbsent($studentId, $mysqli)
{
  $sql = "SELECT COUNT(*) FROM attendance WHERE student_id = ? AND status = 'Absent'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $studentId);
  $stmt->execute();
  $stmt->bind_result($absentCount);
  $stmt->fetch();
  $stmt->close();

  // If there are any "Absent" records, consider the student as absent
  return ($absentCount > 0);
}



function sendNotification($studentId, $notificationText, $mysqli)
{
  $sql = "INSERT INTO notifications (student_id, text) VALUES (?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $studentId, $notificationText);
  $stmt->execute();
  $stmt->close();
}

// Fetch data from the database
$sql = "SELECT * FROM students";
$result = $mysqli->query($sql);

// Initialize an array to store the fetched data
$studentData = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Add each row of data to the $studentData array
    $studentId = $row['id'];

    $absentStatus = isStudentAbsent($studentId, $mysqli);
    if ($absentStatus == "Absent") {

      // sendNotification($studentId, "You are late", $mysqli);
    }

    $row['absentStatus'] = isStudentAbsent($row['id'], $mysqli) ? "Absent" : "Present";
    $studentData[] = $row;
  }
}

// fetch data

// Close the database connection
$mysqli->close();

// Now, you can use the $mysqli object for database operations in this page
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <title>Prof Dashboard</title>
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
        <h5 class="text-white mt-3 d-flex align-items-start">Bonjour Anas</h5>
        <div class="items mt-5">
          <div class="item-selected text-center mt-3 d-flex align-items-start">
            <img src="./images/dashboard-blue.png" alt="dashboard" />
            <span class="ml-3">Les etudiant absents</span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/chat-white.png" alt="dashboard" />
            <span class="ml-3"> <a class="text-white" href="ProfChat.php">Chat</a>
            </span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/logout.png" alt="dashboard" />
            <span class="ml-3">Se deconnecter</span>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-baseline">
          <h5 class="mt-5">Les absences</h5>

          <button class="btn btn-dark" id="notifyAbsentButton">
            Notifier les absences
          </button>
          <button class="btn btn-dark" id="notifyButton">
            Notifier les retards
          </button>
        </div>
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">id</th>

              <th scope="col">Etudiant</th>
              <th scope="col">Date</th>
              <th scope="col">Horaire</th>
              <th scope="col">Contact</th>
            </tr>
          </thead>
          <?php foreach ($studentData as $student) : ?>
            <?php
            $rowColor = $student['absentStatus'] == "Absent" ? "style='background-color: red;'" : "";
            ?>
            <?php echo "<tr $rowColor>"; ?>
            <td>
              <?= $student['id'] ?>
            </td>
            <td>
              <?= $student["nom_etudiant"] ?>
            </td>
            <td>
              <?= date("Y-m-d") ?>
            </td>
            <td>9-12</td>
            <td>
              <a href="deleteStudent.php?student_id=<?= $student["id"] ?>" class="btn btn-warning">clicker ici</a>
            </td>
            </tr>


          <?php endforeach; ?>


        </table>
      </div>
    </div>
  </div>


  <script>
    document.getElementById('notifyButton').addEventListener('click', function() {
      fetch('process_notification.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Assuming the response is in JSON format
        })
        .then(data => {
          console.log('Notification process successful', data);
        })
        .catch(error => {
          console.error('Error processing notifications', error);
        });
    });

    document.getElementById('notifyAbsentButton').addEventListener('click', function() {
      fetch('process_notification_absence.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Assuming the response is in JSON format
        })
        .then(data => {
          console.log('Notification process successful', data);
        })
        .catch(error => {
          console.error('Error processing notifications', error);
        });
    });
  </script>


</body>

</html>