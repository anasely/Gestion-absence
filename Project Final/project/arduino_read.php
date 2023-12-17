<?php

$serialPort = fopen("/dev/cu.usbmodem14401", "r");
// set_time_limit(2);

if ($serialPort) {      // Initialisation du temps de début pour gérer le timeout

  $start_time = time();
  $buffer = '';// Initialisation du buffer pour stocker les données
 // Boucle infinie pour lire les données du port série

  while (true) {
    $data = fgets($serialPort, 128);// Lecture des données du port série

    if ($data !== false) {// Ajout des données lues au buffer
      $buffer .= $data;

      if (strpos($buffer, "\n") !== false) {
        list($cardID, $buffer) = explode("\n", $buffer, 2);
  // Vérification optionnelle de la longueur du cardID (dans le commentaire)
        if (strlen($cardID) === 9) {
          echo $cardID . "<br>";// Sortie de la boucle après avoir lu une ligne complète
          break;
        }
      }
    }
 // Vérification du timeout (5 secondes)

    if (time() - $start_time > 120) {
      echo "Timeout\n";
      break;
    }

    usleep(100000);// Pause de 100000 microsecondes (0,1 seconde) entre les lectures pour éviter une utilisation excessive du processeur
  }

  fclose($serialPort);
} else {
  echo "Failed to open serial port\n";
}
