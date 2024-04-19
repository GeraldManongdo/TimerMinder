<?php
session_start();
include("connection.php");



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['logEmail'];
    $password = $_POST['logPassword'];
    
    $sql = "SELECT * FROM accountlist WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $row['user_name']; 
            
            // Pass $row to main.php
            $_SESSION['user_details'] = $row;
            
            echo "<script>alert('Login successful');</script>";
            header("Location: task.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password');</script>";
            header("Location: index.php");
            exit();
        }
    } else {
       
        header("Location: index.php"); echo "<script>alert('User not found');</script>";
        exit();
    }
}

// Sign up
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $user_name = $_POST['signUsername'];
    $email = $_POST['signEmail'];
    $password = $_POST['signPassword'];

    $sql_check_email = "SELECT * FROM accountlist WHERE email='$email'";
    $result_check_email = $conn->query($sql_check_email);
    if ($result_check_email->num_rows > 0) {
        echo "<script>alert('Email is already in use');</script>";
        header("Location: index.php");
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO accountlist (user_name, email, password) VALUES ('$user_name', '$email', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        $tableName = "user_" . $user_name;
        $sqlCreateTable = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            dates VARCHAR(100) NOT NULL,
            task VARCHAR(100) NOT NULL
        )";

        if ($conn->query($sqlCreateTable) === TRUE) {
            echo "<script>alert('Registration successful');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Error creating table: " . $conn->error . "');</script>";
            header("Location: index.php");
            exit();
        }
    } else {
        echo "<script>alert('Error inserting user: " . $conn->error . "');</script>";
        header("Location: index.php");
        exit();
    }
}

mysqli_close($conn);
?>
