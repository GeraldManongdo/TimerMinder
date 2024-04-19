<?php
include("backend/addtask.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--LINK FOR POPPINS FONT-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Noto+Sans:wdth,wght@62.5..100,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@100..900&display=swap" rel="stylesheet"> 
<!--LINK FOR BOX ICON-->
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link rel="stylesheet" href="asset/style.css">
<title>Fixed Side Navigation</title>
<style>

</style>
</head>
<body>
    <?php
    include("layout/navigation.php");
    include("layout/popup.php");
    include("layout/popup.php");
    ?>


    <section>
    <!--Header Container-->
        <div class="header">
            <h2>Welcome  <?php echo $user_name;?>!</h2>
            <div class="profile" onclick=" profileSetting()"><i class='bx bxs-user' ></i></div>
        </div>
        <!--Third Container-->
        <div class="First">
            <div class="TaskListContainer">
                
                <ul><h3>Task List</h3>
                    <?php
                    if ($result !== false && $result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<li data-id='" . $row["id"] . "'>";
                            echo "<div>
                                    <input type='checkbox' class='task-checkbox' data-id='" . $row["id"] . "' />
                                    <span class='task-text'>" . $row["task"] . "</span>
                                </div>";
                            // Delete button
                            echo "<button class='delete-btn' data-id='" . $row["id"] . "'>Delete</button>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li>0 tasks found</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="ClockButton"></div>
            <div class="thing"></div>
            <div class="ClockContainer"><div class="thing"></div>
                <div class="clock">
                    
                    <div class="timerContainer">
                        <div class="timerTitle">
                            <span>minutes</span>
                            <span>seconds</span>
                        </div>
                        <div class="timer">
                            <span class="minutes">00</span> : <span class="seconds">00</span>
                        </div>
                    </div>
                    <div class="timerButton">
                        <button class="stopTimer start" onclick="stopTimer()">Stop</button>
                        <button class="resumeTimer start" onclick=" resumeTimer()">Resume</button>
                        <button class="restartTimer start" onclick="resetTimer()">Restart</button>
                        <button class="setTimer " onclick=" openSetTime()">Set Time</button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="asset/script.js"></script>
    <script src="asset/timer.js"></script>
    <script>
        document.querySelectorAll('.day-cell').forEach(cell => {
            cell.addEventListener('click', event => {
                let date = cell.getAttribute('data-date');
                fetchTasks(date);
            });
        });

        function fetchTasks(date) {
            fetch('fetch_tasks.php?date=' + date)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('task-container').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Restore checked state of checkboxes from localStorage
            let checkboxes = document.querySelectorAll('.task-checkbox');
            checkboxes.forEach(checkbox => {
                let taskId = checkbox.dataset.id;
                let isChecked = localStorage.getItem('task_' + taskId) === 'true';
                checkbox.checked = isChecked;
                if (isChecked) {
                    toggleTaskCompletion(taskId, true);
                }
            });
        });

        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', event => {
                let taskId = event.target.dataset.id;
                let isChecked = event.target.checked;
                localStorage.setItem('task_' + taskId, isChecked);
                toggleTaskCompletion(taskId, isChecked);
            });
        });

        function toggleTaskCompletion(taskId, isChecked) {
            let taskItem = document.querySelector('li[data-id="' + taskId + '"] span');
            if (isChecked) {
                taskItem.classList.add('crossed-out');
            } else {
                taskItem.classList.remove('crossed-out');
            }
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-btn')) {
                let taskId = event.target.dataset.id;
                let confirmation = confirm('Are you sure you want to delete this task?');
                if (confirmation) {
                    deleteTask(taskId);
                }
            }
        });

        function deleteTask(taskId) {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let taskItem = document.querySelector('li[data-id="' + taskId + '"]');
                        taskItem.parentNode.removeChild(taskItem);
                    } else {
                        console.error('Error deleting task:', xhr.responseText);
                    }
                }
            };
            xhr.open('POST', 'fetch_tasks.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('delete_id=' + encodeURIComponent(taskId));
        }
    </script>
</body>
</html>
