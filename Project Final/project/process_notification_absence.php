<?php
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

$sql = "SELECT * FROM students";
$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $studentId = $row['id'];

    if (isStudentAbsent($studentId, $mysqli)) {
      sendNotification($studentId, "Vous êtes absent !", $mysqli);
    }
  }
}

$mysqli->close();
