import * as DbConnect from './modules/indexedDb/db-connect.mjs';
import * as DbOperation from './modules/indexedDb/db-operation.mjs';
import * as Game from './modules/classes/Game.mjs';

let filterBtn = document.querySelector('.main-table__button');
filterBtn.addEventListener('click', () => {
    let checkbox = document.querySelectorAll('.main-table__checkbox:checked');
    let checkBoxLength = checkbox.length;

    for (let i = 0; i < checkBoxLength; i++) {
        let tr = checkbox[i].parentNode.parentNode.parentNode;
        let game = createGame(tr);
        let condition = checkbox[i].className.indexOf('del');
        (condition === -1) ? addGametoHistory(game, tr) : hideGame(game, tr);
    }
});

function createGame(tr) {
    let game = new Game.Game(
        tr.childNodes[4].textContent,
        tr.childNodes[5].textContent, 
        tr.childNodes[3].textContent);
    return game;
}

function hideGame(game, tr) {
    DbConnect.dbConnect( db => {
        DbOperation.addGame({game: game}, db);
    });
    tr.className = 'tr-delete-blink';
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
