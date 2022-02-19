import * as AddIcons from './add-icons.mjs';
import * as Filter from '../gameFilter/hide-games.mjs';
import * as Switch from './checked-switch.mjs'
import * as PrintGames from './print-games.mjs';


//Function print main table with games
async function print(games) {
    let db = await Filter.findGamesToHide(games);
    //let newGames = findNewGames(games, tr);
    if (db) {
        let response = await Filter.filterGames(db, games);
        if (response) PrintGames.createNewTableBody(response);
        let tbody = document.querySelector('.main-table__table tbody');
        AddIcons.addSportIcon();
        tbody.addEventListener('click', e => {
            Switch.checkboxSwitch(e);
        });
    }
}

export {print};