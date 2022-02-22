import {addSportIcon} from './add-icons.mjs';
import {checkboxSwitch} from './checked-switch.mjs'
import {printNewTableBody} from './print-games.mjs'; 
import {dbConnectAwait} from '../indexedDb/db-connect.mjs';
import {hideGamesDbFilter, getUpdatedArr} from 
'../indexedDb/db-operation.mjs';


//Function print main table with games
async function print(gamesArr) {
    let hideGamesDb = await dbConnectAwait('hide_games');
    if (hideGamesDb) {
        let filteredGamesArr = await hideGamesDbFilter(
            hideGamesDb, gamesArr, 'hide_games');
        if (filteredGamesArr) {
            dbConnectAwait('games')
            .then(gamesDb => 
                getUpdatedArr(gamesDb, filteredGamesArr, 'games')
            )
            .then(updatedGamesArr => {
                printNewTableBody(updatedGamesArr);
                let tbody = document.querySelector('.main-table__table tbody');
                addSportIcon();
                tbody.addEventListener('click', e => {
                    checkboxSwitch(e);
                });
            });
        }
    }
}

export {print};