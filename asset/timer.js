//TIMER 
let timerInterval;
let timerRunning = false;
let seconds;

function startTimer(setSeconds) {
    if(setSeconds !== undefined && setSeconds !== ''){
        seconds = setSeconds;
    } else {
        seconds = 25 * 60;
    }
    
    if (!timerRunning) {
        const minutesElement = document.querySelector('.minutes');
        const secondsElement = document.querySelector('.seconds');
        const stopTimer = document.querySelector('.stopTimer');
        const setTimer = document.querySelector('.setTimer');
        const restartTimer = document.querySelector('.restartTimer');
        const resumeTimer = document.querySelector('.resumeTimer');
        setTimer.style.display = "none";
        stopTimer.style.display = "block";
        restartTimer.style.display = "none";
        resumeTimer.style.display = "none";

        timerInterval = setInterval(function() {
            //TIMER LOGIC
            let minutes = Math.floor(seconds / 60);
            let remainingSeconds = seconds % 60;

            if (remainingSeconds < 10) {
                remainingSeconds = "0" + remainingSeconds;
            }

            minutesElement.textContent = minutes;
            secondsElement.textContent = remainingSeconds;

            if (seconds <= 0) {
                
                clearInterval(timerInterval);
                // Play alert sound or display message
                alert("Timer is up!");
                // You can also play an alert sound like this:
                // var audio = new Audio('path_to_your_audio_file.mp3');
                // audio.play();

                const stopTimer = document.querySelector('.stopTimer');
                stopTimer.style.display = "none";
                resetTimer();
            } else {
                seconds--;
            }
        }, 1000);

        timerRunning = true;
    }
}

function stopTimer(){
    clearInterval(timerInterval);
        timerRunning = false;
        const stopTimer = document.querySelector('.stopTimer');
        const resumeTimer = document.querySelector('.resumeTimer');
        const restartTimer = document.querySelector('.restartTimer');
        resumeTimer.style.display = "block";
        restartTimer.style.display = "block";
        stopTimer.style.display = "none";
}

function resetTimer(){
    const minutesElement = document.querySelector('.minutes');
    const secondsElement = document.querySelector('.seconds');
    minutesElement.textContent = "00";
    secondsElement.textContent = "00";
    const resumeTimer = document.querySelector('.resumeTimer');
    const restartTimer = document.querySelector('.restartTimer');
    const setTimer = document.querySelector('.setTimer');
    resumeTimer.style.display = "none";
    restartTimer.style.display = "none";
    setTimer.style.display = "block";

}
function resumeTimer(){
    timerInterval = setInterval(function() {
        //TIMER LOGIC
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;

        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }

        minutesElement.textContent = minutes;
        secondsElement.textContent = remainingSeconds;

        seconds--;

        if (seconds < 0) {
            clearInterval(timerInterval);
        }
    }, 1000);
    
    timerRunning = true;
}

function setTimer() {
    let minutes = parseInt(minValue.textContent);
    let seconds = parseInt(secondValue.textContent);
    let totalSeconds = minutes * 60 + seconds;
    startTimer(totalSeconds);
    closeSetTime();
}



function resumeTimer() {
    const minutesElement = document.querySelector('.minutes');
    const secondsElement = document.querySelector('.seconds');
    const stopTimer = document.querySelector('.stopTimer');
    const resumeTimer = document.querySelector('.resumeTimer');
    const restartTimer = document.querySelector('.restartTimer');
    
    stopTimer.style.display = "block";
    resumeTimer.style.display = "none";
    restartTimer.style.display = "none";
    
    timerInterval = setInterval(function() {
        //TIMER LOGIC
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;

        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }

        minutesElement.textContent = minutes;
        secondsElement.textContent = remainingSeconds;

        seconds--;

        if (seconds < 0) {
            clearInterval(timerInterval);
        }
    }, 1000);

    timerRunning = true;
}

//SETTING TIME
const increaseMinute = document.getElementById("increaseMinute");
const decreaseMinute = document.getElementById("decreaseMinute");
const increaseSecond = document.getElementById("increaseSecond");
const decreaseSecond = document.getElementById("decreaseSecond");
const minValue = document.querySelector(".minValue");
const secondValue = document.querySelector(".secondValue");

// Event listeners for minute increment and decrement
increaseMinute.addEventListener("click", function() {
    let currentValue = parseInt(minValue.textContent);
    if (currentValue === 59) {
        minValue.textContent = "00";
    } else {
        minValue.textContent = currentValue + 1 < 10 ? "0" + (currentValue + 1) : currentValue + 1;
    }
});

decreaseMinute.addEventListener("click", function() {
    let currentValue = parseInt(minValue.textContent);
    if (currentValue === 0) {
        minValue.textContent = "59";
    } else {
        minValue.textContent = currentValue - 1 < 10 ? "0" + (currentValue - 1) : currentValue - 1;
    }
});

// Event listeners for second increment and decrement
increaseSecond.addEventListener("click", function() {
    let currentValue = parseInt(secondValue.textContent);
    if (currentValue === 60) {
        secondValue.textContent = "00";
    } else {
        secondValue.textContent = currentValue + 1 < 10 ? "0" + (currentValue + 1) : currentValue + 1;
    }
});

decreaseSecond.addEventListener("click", function() {
    let currentValue = parseInt(secondValue.textContent);
    if (currentValue === 0) {
        secondValue.textContent = "59";
    } else {
        secondValue.textContent = currentValue - 1 < 10 ? "0" + (currentValue - 1) : currentValue - 1;
    }
});


function closeSetTime(){
    const popUpContainer = document.querySelector('.popUp');
    const setTime = document.querySelector('.setTime');
    setTime.style.display="none";
    popUpContainer.style.display="none";
    minValue.innerHTML= "00";
    secondValue.innerHTML= "00";
}

