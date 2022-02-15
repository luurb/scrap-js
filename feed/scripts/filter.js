import * as Delete from './modules/game-delete.mjs';
import * as Game from './modules/classes/Game.js';

let filterBtn = document.querySelector('.main-table__button');
filterBtn.addEventListener('click', () => {
    let checkbox = document.querySelectorAll('.main-table__checkbox:checked');
    for (let i = 0; i < checkbox.length; i++) {
        let tr = checkbox[i].parentNode.parentNode.parentNode;
        let game = createGame(tr);
        let condition = checkbox[i].className.indexOf('del');
        (condition === -1) ? console.log('add') : Delete.gameDelete(game, tr);
    }
});

function createGame(tr) {
    let teams = tr.childNodes[4].textContent;
    let bet = tr.childNodes[5].textContent;
    let game = new Game.Game(teams, bet);
    return game;
}