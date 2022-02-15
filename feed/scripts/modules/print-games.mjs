import * as AddIcons from './add-icons.mjs';

 //Function print main table with games
function print(games) {
    let table = document.querySelector('.main-table__table');
    let tbody = table.querySelector('tbody');
    let tr = tbody.querySelectorAll('tr'); 
    
    let newGames = findNewGames(games, tr);
    tbody.remove();
    tbody = document.createElement('tbody');

    //Create new body of games table
    for (let i = 0; i < games.length; i++) {
        tr = document.createElement('tr');
        let td;
        for (let j = 0; j < games[i].length; j++) {
            td = document.createElement('td');
            //Set link for teams
            if (j === 4) {
                let a = document.createElement('a');
                a.setAttribute("href", "https://www.oddsportal.com/search/");
                a.setAttribute("target", "_blank");
                a.textContent = games[i][j];
                td.appendChild(a);
            } else if (j === 2) {
                td.innerHTML = '<span class="main-table__sport-span">' + games[i][j] + '</span>';
            } else {
                td.textContent = games[i][j];
            }
            tr.appendChild(td);
        }
        td = document.createElement('td');
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
        tbody.appendChild(tr);
    }

    table.appendChild(tbody);
    tr = tbody.querySelectorAll('tr');

    //Add blink animation for new games
    for (let i = 0; i < newGames.length; i++) {
        tr[newGames[i]].style.animation = '2s blinker 0s linear 2';
    }
    AddIcons.addSportIcon();
}

 //Function find index of games that are new and save
 //this index in newGames array
 function findNewGames(games, tr) {
    let td;
    let newGames = [];
    let iter = 0;
    let check;
    for (let i = 0; i < games.length; i++) {
        check = 0;
        //If table is empty break loop
        if (tr.length === 0) 
            break;
        for (let j = 0; j < tr.length; j++) {
            td = tr[j].querySelectorAll('td');
            if (td[4].textContent === games[i][4] && td[5].textContent === games[i][5]) {
                check = 1;
                break;
            }
        }
        if (check === 0) {
            newGames[iter] = i;
            iter++;
        }
    }
    return newGames;
}

export {print};