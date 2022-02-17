import * as Print from './modules/print-games.mjs';

let minutes;
let seconds;
let iter;
let time = document.querySelector('.filters__refresh-num');
let refreshButton = document.querySelector('.filters__refresh');

function makeRequest() {
    fetch('./feed/json.php')
        .then(response => {
            if (! response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'text/html; charset=UTF-8') {
                throw new TypeError('Expected text/html, got ' + type);
            }

            return response.text();
        })
        .then(response => {
            response = JSON.parse(response);
            Print.print(response);
            initTimer(Number(time.textContent) * 60000);
        })
        .catch(e => {
            if (e.name == 'NetworkError') {
                alert('Check your Internet connection');
            } else if (e instanceof TypeError) {
                alert('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
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
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    minutes = (minutes < 10) ? '0' + minutes : minutes;

    timerBox.textContent = minutes + ':' + seconds;
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
            minutes = Number(minutes);
            seconds--;
        }
        printTimer();
    }
}

//Refresh timer and add some blinking to tbody table
refreshButton.addEventListener('click', () => {
    clearInterval(iter);
    iter = null;
    setTimeout(makeRequest, 1000);
    let tbody = document.querySelector('.main-table__table');
    tbody = tbody.querySelector('tbody');
    tbody.style.animation = '1s blinker 0s linear 1';
});

makeRequest();
