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
        let table = document.querySelector('.games-table');
        let tbody = table.querySelectorAll('tbody');

        //Delete old body of games table
        for (let i = 0; i < tbody.length; i++)
            tbody[i].remove();

        //Create new body of games table
        for (let i = 0; i < games.length; i++) {
            tbody = document.createElement('tbody');
            let tr = document.createElement('tr');
            for (let j = 0; j < games[i].length; j++) {
                let td = document.createElement('td');
                //Set link for teams
                if (j === 4) {
                    let a = document.createElement('a');
                    a.setAttribute("href", "https://www.oddsportal.com/search/");
                    a.setAttribute("target", "_blank");
                    a.textContent = games[i][j];
                    td.appendChild(a);
                } else {
                    td.textContent = games[i][j];
                }
                tr.appendChild(td);
            }
            /*<td>
                    <label>                                              
                    <input type="checkbox" class="add-checkbox">
                    <span class="add-delete-btn">Add</span>
                    </label>
                    <label>
                    <input type="checkbox" class="del-checkbox">
                    <span class="add-delete-btn">Delete</span>
                    </label>
                </td>*/
            tbody.appendChild(tr);
            table.appendChild(tbody);
        }
    }
    //setInterval(makeRequest, 120000);
    setInterval(makeRequest, 2000);

}

fetchJSON();
