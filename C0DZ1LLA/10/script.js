// script.js

function closePopup() {
    $("#loginPopup").css("display", "none");
}

function submitLogin() {
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "authenticate.php",
        data: { username: username, password: password },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                // Authentication successful, hide the login popup
                closePopup();

                // Show the main content
                $("#mainContent").css("display", "block");
            } else {
                // Authentication failed, show an error message
                $("#loginMessage").text(response.message);
            }
        },
        error: function () {
            $("#loginMessage").text("An error occurred. Please try again.");
        }
    });
}


function submitVote() {
    var choice = $("input[name='choice']:checked").val();

    if (!choice) {
        showMessage("Please select an option.", "red");
        return;
    }

    $.ajax({
        type: "POST",
        url: "vote.php",
        data: { choice: choice },
        success: function (response) {
            if (response === "success") {
                showMessage("Vote submitted successfully!", "green");
                updateLiveResults(); // Update live results after submitting a vote
            } else if (response === "duplicate") {
                showMessage("You have already voted.", "orange");
            } else {
                showMessage("Error submitting vote.", "red");
            }
        }
    });
}

function showMessage(message, color) {
    var messageDiv = $("#message");
    messageDiv.text(message);
    messageDiv.css("color", color);
    messageDiv.fadeIn().delay(3000).fadeOut();
}

function updateLiveResults() {
    $.ajax({
        type: "GET",
        url: "get_results.php",
        success: function (response) {
            var results = response;

            $("#resultOption1").text("Option 1: " + results.option1 + " votes");
            $("#resultOption2").text("Option 2: " + results.option2 + " votes");

            // Update live chart
            updateLiveChart(results.option1, results.option2);
        }
    });
}

// Initial live results update
updateLiveResults();

// Set interval to update live results every 10 seconds (adjust as needed)
setInterval(updateLiveResults, 10000);
