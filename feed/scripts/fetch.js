function fetchJSON() {
    let request = new XMLHttpRequest();
    makeRequest();
    function makeRequest() {
        request.onreadystatechange = checkConnection;
        request.open('GET', './feed/json.php');
        request.responseType = 'text';
        request.send();
    }

    function checkConnection() {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                print();
            } else {
                alert('Not working');
            }
        }
    }

    function print() {
        const games = JSON.parse(request.response);
        let table = document.getElementsByTagName('table');
        for (let i = 0; i < games.length; i++) {
            let tbody = document.createElement('tbody');
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
            tbody.appendChild(tr);
            table[0].appendChild(tbody);
        }
    }
}

window.addEventListener('load', fetchJSON);

