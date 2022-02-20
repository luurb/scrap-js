//Function adding correct image depends on which sport td represent
function addSportIcon(){
    let el = document.querySelector('.main-table__table');
    el = el.querySelector('tbody').querySelectorAll('tr');
    let elLength = el.length;

    for (let i = 0; i < elLength; i++) {
        let td = el[i].querySelectorAll('td');
        let sport = td[2].textContent;
        let sportSpan = '<span class="main-table__sport-span">' + sport + '</span>';

        switch (sport) {
            case 'Football':
                td[2].innerHTML = '<img src="./img/football.svg" class="main-table__img none"/>' + sportSpan;
                break;
            case 'Basketball':
                td[2].innerHTML = '<img src="./img/basketball.svg" class="main-table__img none"/>' + sportSpan;
                break;
            case 'Tennis':
                td[2].innerHTML = '<img src="./img/tennis-ball.svg" class="main-table__img none"/>' + sportSpan;
                break;
            case 'Volleyball':
                td[2].innerHTML = '<img src="./img/volleyball.svg" class="main-table__img none"/>' + sportSpan;
                break;
            case 'Esport':
                td[2].innerHTML = '<img src="./img/esport.svg" class="main-table__img none"/>' + sportSpan;
                break;
        }
    }
}

window.addEventListener('load', addSportIcon);

export {addSportIcon};
