<?php
include('db_connection.php'); // Inclure votre fichier de connexion à la base de données
// Vérifier si la requête est de type POST et si "studentId" est défini dans la requête
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["studentId"])) {
    $studentId = $_POST["studentId"];
    // Préparer la requête SQL pour mettre à jour la présence de l'étudiant

   
    $sql = "UPDATE attendance SET status = 'Present' WHERE student_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $studentId);
    // Exécuter la requête
²
    if ($stmt->execute()) {
        echo $studentId . " student marked as present successfully.";
    } else {
        echo $studentId . "Failed to mark student as present.";
    }

    $stmt->close();
}

// Fermer la connexion à la base de données

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>for arduino</title>
</head>

<body>

    <div id="cardData"></div>

    <script>
            // Récupérer les données de 'arduino_read.php' en utilisant fetch API

        function fetchData() {
            fetch('arduino_read.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('cardData').innerHTML = data.replace('<br>', '');
                    if (data) {
                        document.getElementById('studentId').value = data.replace('<br>', '');;
                        document.getElementById('formId').submit();
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                })
        }
        fetchData();
    </script>

    <form action="#" method="POST" id='formId' style="visibility: hidden;">
        <input type="text" placeholder="id" name="studentId" id="studentId"> <br>
        <input type="submit" value="Valide">
    </form>

</body>

</html>