import * as Print from './modules/print-games.mjs';

let minutes;
let seconds;
let iter;
let request = new XMLHttpRequest();

function makeRequest() {
    request.onreadystatechange = checkConnection;
    request.open('GET', './feed/json.php');
    request.responseType = 'text';
    request.send();
}

//Function check if response status is correct
function checkConnection() {
    if (request.readyState === XMLHttpRequest.DONE) {
        if (request.status === 200) {
            Print.print(request);
            initTimer(60000);
        } else {
            alert('Not working');
        }
    }
}

function initTimer(interval) {
    seconds = interval / 1000;
    minutes = Math.round(seconds / 60);
    seconds = seconds - minutes * 60;
    printTimer();
    iter = setInterval(setTimer, 1000);
}

function printTimer() {
    let timerBox = document.querySelector('.nav-box__timer');
    if (seconds < 10) {
        seconds = '0' + seconds;
    }

    timerBox.textContent = '0' + minutes + ':' + seconds;
}

function setTimer() {
    if (seconds == '00' && minutes == 0) {
        clearInterval(iter);
        iter = null;
        makeRequest();
    } else {
        if (seconds === '00') {
            seconds = 59;
            minutes = Number(minutes);
            minutes--;
        } else {
            seconds = Number(seconds);
            seconds--;
        }
        printTimer();
    }
}

makeRequest();
