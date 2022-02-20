//Function create new body of games table
function createNewTableBody(games) {
    let table = document.querySelector('.main-table__table');
    let oldTbody = table.querySelector('tbody');
    let oldTrList = oldTbody.querySelectorAll('tr'); 
    
    let newTrList = findNewGames(games, oldTrList);
    let newTbody = document.createElement('tbody');
    let trLength = newTrList.length;

    for (let i = 0; i < trLength; i++) {
        newTbody.appendChild(newTrList[i]);
    }
    oldTbody.remove();
    table.appendChild(newTbody);
}

//Function find index of games that are new and save
//this index in newGames array
function findNewGames(games, trList) {
    let trListArray = Array.from(trList);
    let gamesLength = games.length;
    let trListLength = trListArray.length;
    let newTrArray = [];

    if (trList.length === 0) {
        for (let i = 0; i < gamesLength; i++) {
            newTrArray.push(createNewTr(games[i]));
        }
    } else {
        for (let i = 0; i < trListLength; i++) {
            //Change NodeList of trs for array 
            trListArray[i] = Array.from(trListArray[i].childNodes);
            let childLength = trListArray[i].length;
    
            for (let j = 0; j < childLength; j++) {
                //Change array of tds for array of textContent 
                //of that tds
                trListArray[i][j] = trListArray[i][j].textContent; 
            }
        }
    
        for (let i = 0; i < gamesLength; i++) {
            let exists = trListArray.findIndex(arr => arr.includes(games[i][4]));
            let bet = trListArray.findIndex(arr => arr.includes(games[i][5]));
    
            if (exists === -1 || exists !== bet) {
                newTrArray.push(createNewTr(games[i]));
            } else {
                trList[exists].classList.remove('tr-blink');
                newTrArray.push(trList[exists]);
            }
        }
    }   
    
    return newTrArray;
}

//Function create new row for valubets table with data 
//from game object
function createNewTr(game) {
    let gameLength = game.length;
    let tr = document.createElement('tr');

    for (let i = 0; i < gameLength; i++) {
        let td = document.createElement('td');
        switch (i) {
            case 0: {
                td.innerHTML = '<i class="fa-regular fa-clock"></i>' +
                '<span class="main-table__valuebets-clock"> < 1 min</span>';
                break;
            }
            case 2: {
                td.innerHTML = '<span class="main-table__sport-span">' 
                + game[i] + '</span>';
                break;
            }
            case 4: {
                let a = document.createElement('a');
                a.setAttribute("href", "https://www.oddsportal.com/search/");
                a.setAttribute("target", "_blank");
                a.textContent = game[i];
                td.appendChild(a);
                break;
            }
            default:
                td.textContent = game[i];
        }
        tr.appendChild(td);
    }
    let td = document.createElement('td');
    td.innerHTML = 
    `<label>
        <input type="checkbox" class="main-table__checkbox main-table__checkbox--add none">                                           
        <span class="main-table__span main-table__valuebets-span">Add</span>
    </label>
    <label>
        <input type="checkbox" class="main-table__checkbox main-table__checkbox--del none">
        <span class="main-table__span main-table__valuebets-span">Del</span>
    </label>`;
    tr.appendChild(td);
    tr.className = 'tr-blink';

    return tr;  
}

function getClockTime(tbody) {

}

export {createNewTableBody};