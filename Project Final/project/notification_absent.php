<?php
include('db_connection.php');


function insertNotification($studentId, $notificationText)
{
  $sql = "INSERT INTO notifications (student_id, text) VALUES (?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("is", $studentId, $notificationText);
  $stmt->execute();
  $stmt->close();

}

function isStudentAbsent($studentId, $mysqli)
{
  $sql = "SELECT COUNT(*) FROM attendance WHERE student_id = ? AND status = 'Absent'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $studentId);
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
  $stmt->bind_param("is", $studentId, $notificationText);
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

      sendNotification($studentId, "Vous etes marque absent", $mysqli);
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