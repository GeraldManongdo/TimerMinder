//LOADING PAGE
// window.onload = function() {    
//     document.querySelector('section.mainSection').style.display = 'none';
//     document.querySelector('.loadingContainer').style.display = 'flex';
//     setTimeout(function() {
//         document.querySelector('.loadingContainer').style.display = 'none';
//         document.querySelector('section.mainSection').style.display = 'flex';
//         document.querySelector('.sideNav').style.display = 'block';
//         document.querySelector('.mainSection').style.display = 'block';
//     }, 3500);
// };

//NAVIGATION SCRIPT
const mainSection = document.querySelector('.First');
const calendarMainContainer = document.querySelector('.Third');
const settingsContainer = document.querySelector('.Second');
const profileSettings = document.querySelector('.Forth');


function homeButton(){
    window.location.href = "task.php";

}
function calendarButton(){
    window.location.href = "calendar.php";
}

function aboutUs(){
    window.location.href = "aboutUs.php";
}

function profileSetting(){
    window.location.href = "profile.php";
}



//Adding TASK FUNCTION
let addTask = document.querySelector(".addTask");

function showAddTask(){
    const popUpContainer = document.querySelector('.popUp');
    const setTime = document.querySelector('.setTime');
    const addTask = document.querySelector('.addTask');
    addTask.style.display= "block";
    setTime.style.display="none";
    popUpContainer.style.display="flex";
}
function exitAddTask(){
    const popUpContainer = document.querySelector('.popUp');
    const setTime = document.querySelector('.setTime');
    const addTask = document.querySelector('.addTask');
    addTask.style.display= "none";
    setTime.style.display="none";
    popUpContainer.style.display="none";
}


function openSetTime(){
    const popUpContainer = document.querySelector('.popUp');
    const setTime = document.querySelector('.setTime');
    const addTask = document.querySelector('.addTask');
    addTask.style.display= "none";
    setTime.style.display="block";
    popUpContainer.style.display="flex";
}


//task and calendar script
