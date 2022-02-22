//Function create new body of games table
function printNewTableBody(gamesArr) {
    let table = document.querySelector('.main-table__table');
    let oldTbody = table.querySelector('tbody');
     
    let newTrList = createNewTrList(gamesArr);
    let newTbody = oldTbody.cloneNode();
    let trLength = newTrList.length;

    for (let i = 0; i < trLength; i++) {
        let tr = newTrList[i];
        newTbody.appendChild(tr);
        //Nedded to remove class for animation to be able
        //to add another animation to that element later
        if (tr.className === 'tr-add-blink') {
            setTimeout(() => {
                newTrList[i].classList.remove('tr-add-blink');
            }, 4000)
        }
    }

    oldTbody.remove();
    table.appendChild(newTbody); 
}

//Function create new row for valubets table with data 
//from game object
function createNewTrList(gamesArr) {
    let gamesLength = gamesArr.length;
    let trList = [];

    for (let i = 0; i < gamesLength; i++) {
        let tr = document.createElement('tr');
        let game = gamesArr[i];
        let gameLength = gamesArr[i].length;
        
        for (let j = 0; j < gameLength - 1; j++) {
            let td = document.createElement('td');
            switch (j) {
                case 0: {
                    td.innerHTML = '<i class="fa-regular fa-clock"></i>' +
                    '<span class="main-table__valuebets-clock"> < 1 min</span>';
                    break;
                }
                case 2: {
                    td.innerHTML = '<span class="main-table__sport-span">' 
                    + game[j] + '</span>';
                    break;
                }
                case 4: {
                    let a = document.createElement('a');
                    a.setAttribute("href", "https://www.oddsportal.com/search/");
                    a.setAttribute("target", "_blank");
                    a.textContent = game[j];
                    td.appendChild(a);
                    break;
                }
                default:
                    td.textContent = game[j];
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
        tr.className = game[8];
        trList.push(tr);
    }
    
    return trList;
}

function getClockTime(tr) {
    let time = tr.childNodes[0].textContent;
    console.log(time);

    if (time == '< 1 min') {

    }
    return tr;
}

export {printNewTableBody};