function fetchJSON() {
    let request = new XMLHttpRequest();
    makeRequest();

    function makeRequest() {
        request.onreadystatechange = checkConnection;
        request.open('GET', './feed/json.php');
        request.responseType = 'text';
        request.send();
    }

    //Function check if response status is correct
    function checkConnection() {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                print();
            } else {
                alert('Not working');
            }
        }
    }

    //Functiion print main table with games
    function print() {
        const games = JSON.parse(request.response);
        let table = document.querySelector('.main-table__table');
        let tbody = table.querySelector('tbody');
        let tr = tbody.querySelectorAll('tr');

        //Delete old body of games table
        for (let i = 0; i < tr.length; i++)
            tr[i].remove();

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
                    td.innerHTML = '<span class="main-table__sport-span">' + games[i][j] + '</span>'
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

        addSportIcon();
    }

    //Function adding correct image depends on which sport td represent
    function addSportIcon(){
        let el = document.querySelector('.main-table__table');
        el = el.querySelector('tbody').querySelectorAll('tr');
    
        for (let i = 0; i < el.length; i++) {
            let td = el[i].querySelectorAll('td');
    
            switch(td[2].textContent){
                case 'Football':
                    td[2].innerHTML += '<img src="./img/football.svg" class="main-table__img none"/>';
                    break;
                case 'Basketball':
                    td[2].innerHTML += '<img src="./img/basketball.svg" class="main-table__img none"/>';
                    break;
                case 'Tennis':
                    td[2].innerHTML += '<img src="./img/tennis-ball.svg" class="main-table__img none"/>';
                    break;
                case 'Volleyball':
                    td[2].innerHTML += '<img src="./img/volleyball.svg" class="main-table__img none"/>';
                    break;
                case 'Esport':
                    td[2].innerHTML += '<img src="./img/esport.svg" class="main-table__img none"/>';
                    break;
            }
        }
    }
    setInterval(makeRequest, 120000);
    //setInterval(makeRequest, 2000);

}

fetchJSON();
