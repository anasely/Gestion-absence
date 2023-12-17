<?php
include('db_connection.php');

session_start();

$student_id = $_SESSION['user_id'];

$query = "SELECT nom_etudiant FROM students WHERE id = '$student_id'";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
  // Fetch the student's name
  $row = $result->fetch_assoc();
  $student_name = $row['nom_etudiant'];

  // Fetch notifications for the student
  $notifications_query = "SELECT text FROM notifications WHERE student_id = '$student_id'";
  $notifications_result = $mysqli->query($notifications_query);

  // Fetched notifications array
  $notifications = [];

  while ($notification_row = $notifications_result->fetch_assoc()) {
    $notifications[] = $notification_row['text'];
  }

} else {
  // Handle the case where the student is not found
  $student_name = "Unknown";
  $notifications = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

  <title>Student Notifications</title>
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
        <h5 class="text-white mt-3"> Bonjour
          <?php echo $student_name; ?>
        </h5>
        <div class="items mt-5">
          <div class="item text-center d-flex align-items-start">
            <img src="./images/dashboard-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentDashboard.php">Consulter mes absences</a></span>
          </div>
          <div class="item-selected text-center mt-3 d-flex align-items-start">
            <img src="./images/notification-blue.png" alt="dashboard" />
            <span class="ml-3"><a class="" href="./StudentNotification.php">Mes notifications</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/chat-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentChat.php">Chat</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/logout.png" alt="dashboard" />
            <span class="ml-3">Se deconnecter</span>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <h5 class="mt-5">Vos notification</h5>
        <!-- Display notifications from PHP -->
        <?php foreach ($notifications as $notification): ?>
          <div class="alert alert-primary" role="alert">
            <img src="./images/notification-blue.png" alt="notification-image" />
            <?php echo $notification; ?>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</body>

</html>