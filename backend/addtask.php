<?php
include("connection.php");
session_start();
if(isset($_SESSION['user_details'])) {
    $user_details = $_SESSION['user_details'];
    $user_name = $user_details['user_name'];
    $email = $user_details['email'];
    $tableName = "user_" . $user_name;
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);

// If form is submitted, add task to database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    $task = $_POST["task"];
    $date = $_POST["date"];

    $sql = "INSERT INTO $tableName (task, dates) VALUES ('$task', '$date')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to prevent form resubmission on page reload
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// If delete button is clicked, delete task from database
if(isset($_POST['delete'])) {
    $sql = "DELETE FROM accountlist WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Account deleted successfully";
    } else {
        echo "Error deleting account: " . $stmt->error;
    }
    
    $stmt->close();
    
    $sql = "DROP TABLE IF EXISTS $tableName";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table deleted successfully";
    } else {
        echo "Error deleting table: " . $conn->error;
    }

    $conn->close();

    header("Location: index.php");
    exit();

}

// Default to current month and year if not provided
$month = isset($_GET['month']) ? $_GET['month'] : date('n');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Number of days in the month
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// First day of the month
$first_day_of_month = date('N', strtotime("$year-$month-01"));

// Last day of the month
$last_day_of_month = date('N', strtotime("$year-$month-$days_in_month"));

// Current date
$current_date = date('Y-m-d');

// Array to store days with tasks
$days_with_tasks = [];

// Fetch tasks for the month
$sql_tasks = "SELECT DISTINCT DATE(dates) AS task_date FROM $tableName WHERE MONTH(dates) = $month AND YEAR(dates) = $year";
$result_tasks = $conn->query($sql_tasks);
if ($result_tasks !== false && $result_tasks->num_rows > 0) {
    while ($row_task = $result_tasks->fetch_assoc()) {
        $days_with_tasks[] = date('j', strtotime($row_task['task_date']));
    }
}

?>