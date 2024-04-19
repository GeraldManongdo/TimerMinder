<div class="popUp">
        <div class="addTask">
            <div>
                <h1>Create a to-do!</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="task" required placeholder="To-do Name">
                    <input type="date" name="date" required placeholder="Select a date" />
                    <button type="submit">Save</button>
                </form>
                <span onclick=" exitAddTask()"><i class='bx bx-x'></i></span>
            </div>
        </div>

        <!--SET TIME-->
        <div class="setTime">
            <h1>Set The Timer!</h1>
            <div class="setedTime">
                <span class="minST">
                <i class='bx bx-chevron-up' id="increaseMinute"></i>
                <span class="minValue">00</span>
                <i class='bx bx-chevron-down' id="decreaseMinute"></i>
                </span>
                :
                <span class="secondST">
                <i class='bx bx-chevron-up'  id="increaseSecond"></i>
                <span class="secondValue">00</span>
                <i class='bx bx-chevron-down'  id="decreaseSecond"></i>
                </span>
            </div>
            <button onclick="setTimer()">START</button>
            <span class="exitSetTime" onclick="closeSetTime()"><i class='bx bx-x'></i></span>
        </div>
    </div>