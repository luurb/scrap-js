import { dbConnectAwait } from './modules/indexedDb/db-connect.mjs';
import { getGamesArr } from './modules/indexedDb/db-operation.mjs';
import { printNewTableBody, createNewTrList }
    from './modules/fetch/print-games.mjs';

let carets = document.querySelectorAll('.filters__caret');
let select = document.querySelector('.filters__select');
let sortDirection; 
let columnNumObj = {
    'Delay': 9,
    'Date': 3,
    'Odd': 6,
    'Value': 7
};

carets.forEach(caret => {
    caret.addEventListener('click', () => {
        let columnToSortBy = select.options[select.selectedIndex].textContent;
        if (columnToSortBy !== 'Choose') {
            let columnNum = columnNumObj[columnToSortBy];
            if (caret.classList.contains('filters__caret-down'))
                sortDirection = -1;
            else sortDirection = 1;

            carets.forEach(clickedCaret => {
                clickedCaret.classList.remove('sorted');
            });
            caret.classList.add('sorted');
            initSort(columnNum);
        }
    })
});

select.addEventListener('change', () => {
    carets.forEach(caret => {
        if (caret.classList.contains('sorted')) {
            let columnToSortBy = select.options[select.selectedIndex].textContent;
            let columnNum = columnNumObj[columnToSortBy];
            initSort(columnNum);
        }
    })
});

function initSort(columnNum) {
    dbConnectAwait('games')
        .then(gamesDb => getGamesArr(gamesDb, 'games'))
        .then(gamesArr => {
            sort(gamesArr, columnNum);
            printNewTableBody(gamesArr);
        });
}

function sort(arr, column) {
    arr.sort((first, second) => {
        if (column === 9) {
            let firstDelay = new Date(Date.now()) - first[column];
            let secondDelay = new Date(Date.now()) - second[column];
            return sortDirection * ((firstDelay > secondDelay) ? 1 : -1);
        } else if (column === 3) {
            return sortDirection * ((first[column] > second[column]) ? 1 : -1);
        } else {
            return sortDirection * (first[column] - second[column]);
        }
    });

    return arr;
}