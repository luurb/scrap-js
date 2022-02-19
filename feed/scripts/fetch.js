import * as Print from './modules/fetch/print-init.mjs';
import * as CountDown from './modules/fetch/count-down.mjs';

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
            CountDown.initTimer(Number(time.textContent) * 60000, makeRequest);
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

//Testing
/*function makeRequest() {
    fetch('./feed/games.json')
        .then(response => {
            if (! response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'application/json') {
                throw new TypeError('Expected text/html, got ' + type);
            }

            return response.json();
        })
        .then(response => {
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
}*/

//Refresh timer and add some blinking to tbody table
refreshButton.addEventListener('click', () => {
    CountDown.clearCountDown();
    setTimeout(makeRequest, 1000);
    let tbody = document.querySelector('.main-table__table tbody');
    tbody.className = 'tbody-blink';
});

makeRequest();