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
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link rel="stylesheet" href="asset/style.css">
<title>Fixed Side Navigation</title>
<style>
    .today {
    background-color: green;
    color: white;
    }
</style>
</head>
<body>
    <?php
    include("layout/navigation.php");
    include("layout/popup.php");
    ?>


    <section>
    <!--Third Container-->
    <div class="Third">
        <div class="calendar">
            <div class="calendarContainer">
                <div class="navigation">
                    <a href="?month=<?php echo ($month == 1) ? 12 : $month - 1; ?>&year=<?php echo ($month == 1) ? $year - 1 : $year; ?>"><i class='bx bx-chevron-left'></i></a>
                    <caption><?php echo date('F Y', mktime(0, 0, 0, $month, 1, $year)); ?></caption>
                    <a href="?month=<?php echo ($month == 12) ? 1 : $month + 1; ?>&year=<?php echo ($month == 12) ? $year + 1 : $year; ?>"><i class='bx bx-chevron-right'></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                            <th>Sun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Output empty cells for days before the first day of the month
                        echo '<tr>';
                        for ($i = 1; $i < $first_day_of_month; $i++) {
                            echo '<td></td>';
                        }

                        // Output days of the month
                        $day = 1;
                        while ($day <= $days_in_month) {
                            $date = date('Y-m-d', strtotime("$year-$month-$day"));
                            $class = ($date == $current_date) ? 'today' : ''; // Add 'today' class if the date is today
                            $class .= (in_array($day, $days_with_tasks)) ? ' task-day' : ''; // Add 'task-day' class if tasks exist for the day
                            echo '<td class="day-cell ' . $class . '" data-date="' . $date . '">' . $day . '</td>';
                            if (($first_day_of_month + $day - 1) % 7 == 0) {
                                echo '</tr><tr>';
                            }
                            $day++;
                        }

                        // Output empty cells for days after the last day of the month
                        while (($first_day_of_month + $days_in_month - 1) % 7 != 0) {
                            echo '<td></td>';
                            $days_in_month++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="listEventContainer">
            <h1>LIST FOR EVENT TODAY</h1>
            <div class="task-container" id="task-container">
                Click on a day to view tasks.
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
            let taskItem = document.querySelector('li[data-id="' + taskId + '"]');
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
                    location.reload();
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
