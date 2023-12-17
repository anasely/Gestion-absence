<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

  <title>Student Chat</title>
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
          <!-- <?php echo $student_name; ?> -->
        </h5>
        <div class="items mt-5">
          <div class="item text-center d-flex align-items-start">
            <img src="./images/dashboard-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentDashboard.php">Consulter mes absences</a< /span>
          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/notification-white.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentNotification.php">Mes notification</a></span>
          </div>
          <div class="item-selected text-center mt-3 d-flex align-items-start">
            <img src="./images/chat-blue.png" alt="dashboard" />
            <span class="ml-3"><a class="text-white" href="./StudentChat.php">Chat</a></span>

          </div>
          <div class="item text-center mt-3 d-flex align-items-start">
            <img src="./images/logout.png" alt="dashboard" />
            <span class="ml-3">Se deconnecter</span>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <h5 class="mt-5">Chat</h5>
        <div class="row">
          <div class="col-md-5">
            <div class="d-flex align-items-center">
              <div>
                <img src="./images/person.png" alt="person" class="mr-2" />
              </div>
              Anas
            </div>

          </div>
          <div class="col-md-7">
            <div class="card w-100">
              <div class="card-body">
                <div class="col-md-7">
                  <div id="chat-box">
                    <!-- Messages will be displayed here -->
                  </div>
                  <form id="message-form">
                    <input type="text" id="message" placeholder="Type your message here">
                    <button type="submit">Send</button>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Function to send a message using AJAX
      function sendMessage() {

        var message = $("#message").val();
        if (message.trim() === "") {
          return;
        }

        $.ajax({
          type: "POST",
          url: "send_message.php", // Replace with your PHP script to handle message sending
          data: {
            message: message,
            receiver_id: 1, // Replace with the receiver's ID
          },
          success: function(response) {
            // Clear the input field after sending
            console.log('Send success');
            $("#message").val("");
          },
          error: function(error) {
            console.error("ERROR");
          }
        });
      }

      // Function to load and display messages using AJAX
      function loadMessages() {
        $.ajax({
          type: "GET",
          url: "get_messages.php", // Replace with your PHP script to retrieve messages
          data: {
            receiver_id: 1, // Replace with the receiver's ID
          },
          success: function(response) {
            console.log(response)
            $("#chat-box").empty();

            // Loop through the messages and append them to the chat box
            response.forEach(function(message) {
              var formattedMessage = "";
              if (message.sender_id == '<?php echo $_SESSION['user_id']; ?>') {
                formattedMessage = "Toi : " + message.message;
              } else {
                formattedMessage = "Prof: " + message.message;
              }
              $("#chat-box").append("<p>" + formattedMessage + "</p>");
            });
          },
          error: function(error) {
            console.error(error);
          }
        });
      }

      // Submit the message form
      $("#message-form").submit(function(e) {
        e.preventDefault();
        sendMessage();
      });

      // Load and display messages initially
      loadMessages();

      // Poll for new messages every 5 seconds (adjust as needed)
      setInterval(function() {
        loadMessages();
      }, 1000);
    });
  </script>


</body>

</html>