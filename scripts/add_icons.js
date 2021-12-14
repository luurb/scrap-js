function addSportIcon(){
    var el = document.querySelectorAll('td.sport-col');
    for(var i = 0; i < el.length; i++){
        switch(el[i].textContent){
            case 'Football':
                el[i].innerHTML += '<img src="./img/football.svg" class="ball-img"/>';
                break;
            case 'Basketball':
                el[i].innerHTML += '<img src="./img/basketball.svg" class="ball-img"/>';
                break;
            case 'Tennis':
                el[i].innerHTML += '<img src="./img/tennis-ball.svg" class="ball-img"/>';
                break;
            case 'Volleyball':
                el[i].innerHTML += '<img src="./img/volleyball.svg" class="ball-img"/>';
                break;
            case 'Esport':
                el[i].innerHTML += '<img src="./img/esport.svg" class="ball-img"/>';
                break;
        }
    }
}

window.addEventListener('load', addSportIcon);
