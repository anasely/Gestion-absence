<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />

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
              <span class="ml-3">Chat</span>
            </div>
            <div class="item text-center mt-3 d-flex align-items-start">
              <img src="./images/logout.png" alt="dashboard" />
              <span class="ml-3">Se deconnecter</span>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <h5 class="mt-5">Tableau de bord</h5>
          <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">Etudiant</th>
                <th scope="col">Date</th>
                <th scope="col">Horaire</th>
                <th scope="col">Contact</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Anas</td>
                <td>11/11/2023</td>
                <td>9-12</td>
                <td><a href="#"> Cliquez-ici</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
