<?php
// Include the database connection file
include('db_connection.php');
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $nom_etudiant = $_POST["nom_etudiant"];
  $niveau = $_POST["niveau"];
  $password = $_POST["password"];
  $username = $_POST["username"];
  $filiere = $_POST["filiere"];

  // Insert data into the database
  $sql = "INSERT INTO students (nom_etudiant, niveau, password, username, filiere) VALUES (?, ?, ?, ?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sssss", $nom_etudiant, $niveau, $password, $username, $filiere);

  if ($stmt->execute()) {
    // Insertion successful, you can redirect or display a success message here
    header("Location: AdminDashboardStudents.php"); // Redirect to a success page
    exit();
  } else {
    // Insertion failed, you can redirect or display an error message here
    header("Location: AdminDashboardStudents.php"); // Redirect to an error page
    exit();
  }



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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
        <h5 class="text-white mt-3">Bonjour Anas</h5>
        <div class="items mt-5">
          <div class="item-selected text-center mt-3 d-flex align-items-startr">
            <img src="./images/dashboard-blue.png" alt="dashboard" />
            <span class="ml-3">Gestion des Etudiant</span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/dashboard-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./admin_Dashboard_prof.php">Gestion des professeur</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/dashboard-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./admin_dashboard_user.php">Gestion des utilisateur</a></span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/logout.png" alt="dashboard" />
            <span class="ml-3">Se deconnecter</span>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <h5 class="mt-5">Gestion des Etudiant</h5>
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal">
          Ajouter un étudiant
        </button>

        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Ajouter un étudiant</h4>
                <button type="button" class="close" data-dismiss="modal">
                  &times;
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">




                <form method="POST" action="#" id="studentForm">
                  <div class="form-group">
                    <label for="nomEtudiant">Nom étudiant:</label>
                    <input type="text" class="form-control" id="nomEtudiant" name="nom_etudiant"
                      placeholder="Entrez le nom de l'étudiant" />
                  </div>
                  <div class="form-group">
                    <label for="niveau">Niveau:</label>
                    <input type="text" class="form-control" id="niveau" name="niveau" placeholder="Entrez le niveau" />
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" class="form-control" id="password" name="password"
                      placeholder="Entrez le mot de passe" />
                  </div>
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"
                      placeholder="Entrez le nom d'utilisateur" />
                  </div>
                  <div class="form-group">
                    <label for="filiere">Filière:</label>
                    <input type="text" class="form-control" id="filiere" name="filiere"
                      placeholder="Entrez la filière" />
                  </div>
                  <!-- Add more form fields here as needed -->
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>

              </div>
              <!-- Modal footer -->

            </div>
          </div>
        </div>

        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">id</th>

              <th scope="col">Etudiant</th>
              <th scope="col">Username</th>
              <th scope="col">Password</th>
              <th scope="col">Niveau</th>
              <th scope="col">Filier</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <?php
          // Loop through the $studentData array to display the data in the table
          foreach ($studentData as $student) {
            echo "<tr>";
            echo "<td>" . $student["id"] . "</td>";

            echo "<td>" . $student["nom_etudiant"] . "</td>";
            echo "<td>" . $student["username"] . "</td>";
            echo "<td>" . $student["password"] . "</td>";
            echo "<td>" . $student["niveau"] . "</td>";
            echo "<td>" . $student["filiere"] . "</td>";
            echo '<td>
            <a href="deleteStudent.php?student_id=' . $student["id"] . '" class="btn btn-danger">supprimer</a>
        </td>';
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>