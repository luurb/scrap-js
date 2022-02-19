import * as DbConnect from './modules/indexedDb/db-connect.mjs';
import * as DbOperation from './modules/indexedDb/db-operation.mjs';
import * as Game from './modules/classes/Game.mjs';

let filterBtn = document.querySelector('.main-table__button');
filterBtn.addEventListener('click', () => {
    let checkbox = document.querySelectorAll('.main-table__checkbox:checked');
    for (let i = 0; i < checkbox.length; i++) {
        let tr = checkbox[i].parentNode.parentNode.parentNode;
        let game = createGame(tr);
        let condition = checkbox[i].className.indexOf('del');
        (condition === -1) ? addGametoHistory(game, tr) : hideGame(game, tr);
    }
});

function createGame(tr) {
    let date = tr.childNodes[3].textContent;
    let teams = tr.childNodes[4].textContent;
    let bet = tr.childNodes[5].textContent;
    let game = new Game.Game(teams, bet, date);
    return game;
}

function hideGame(game, tr) {
    DbConnect.dbConnect( db => {
        let newGame = {game: game};
        DbOperation.addGame(newGame, db);
    });
    tr.style.animation = '2s blinker 0s linear 1';
    setTimeout(() => {
        tr.remove();
    }, 1000);
}

function addGametoHistory(game, tr) {
    hideGame(game, tr);
    console.log('Added game');
    /*
    Function add game to bet history on server side db
    */
}
