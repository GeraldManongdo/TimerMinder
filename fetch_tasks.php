<?php
include("backend/connection.php");
session_start();
if(isset($_SESSION['user_details'])) {
    $user_details = $_SESSION['user_details'];
    $user_name = $user_details['user_name'];
    $tableName = "user_" . $user_name;
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete a task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    $sql = "DELETE FROM $tableName WHERE id=$delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Task deleted successfully";
    } else {
        echo "Error deleting task: " . $conn->error;
    }
    exit(); // Stop further execution
}

// Retrieve tasks for the selected date
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["date"])) {
    $date = $_GET["date"];

    $sql = "SELECT * FROM $tableName WHERE dates='$date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output tasks
        echo "<h2>Event in $date</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li data-id='" . $row["id"] . "'>" . $row["task"] . " <button class='delete-btn' data-id='" . $row["id"] . "'>Delete</button></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No tasks for $date</p>";
    }
}

$conn->close();
?>
