import {dbConnectAwait} from './modules/indexedDb/db-connect.mjs';
import {getGamesArr} from './modules/indexedDb/db-operation.mjs';
import {printNewTableBody, createNewTrList} 
from './modules/fetch/print-games.mjs';

let carets = document.querySelectorAll('.filters__caret');
let select = document.querySelector('.filters__select');
let columnNumObj = {
    'Delay': 9,
    'Date': 3,
    'Odd': 6,
    'Value': 7
};

carets.forEach(caret => {
    caret.addEventListener('click', () => {
        let columnToSortBy = select.options[select.selectedIndex].textContent;
        console.log('Select element value: ' + columnToSortBy);
        if (columnToSortBy !== 'Choose') {
            let columnNum = columnNumObj[columnToSortBy];
            let sortDirection = -1;
            if (caret.classList.contains('filters__caret-down')) 
                sortDirection = 1;

            dbConnectAwait('games')
            .then(gamesDb => getGamesArr(gamesDb, 'games'))
            .then(gamesArr => {
                sort(gamesArr, columnNum, sortDirection);
                printNewTableBody(gamesArr);
            });
        }
    })
});

function sort(arr, column, sortDirection) {
    arr.sort((first, second) => {
        if (column === 0) {
            let firstDelay = new Date(Date.now()) - first[column];
            let secondDelay = new Date(Date.now()) - second[column];
            return sortDirection * ((firstDelay > secondDelay) ? -1 : 1);
        } else if (column === 3) {
            return sortDirection * ((first[column] > second[column]) ? -1 : 1); 
        } else {
            return sortDirection * (first[column] - second[column]);
        }
    });

    return arr;
}