function gameDelete(game, tr) {
    dbConnect(game);
    tr.style.animation = '2s blinker 0s linear 1';
    setTimeout(() => {
        tr.remove();
    }, 1000);
}

function dbConnect(game) {
    //let request = indexedDB.deleteDatabase('games');
    let request = indexedDB.open('games', 1);
    request.onerror = () => {
        console.log('Database failed to open');
    };

    request.onsuccess = () => {
       let db = request.result;
       let newGame = {game: game};
       addGame(newGame, db);
    };

    request.onupgradeneeded = e => {
        let db = e.target.result;
        let objectStore = db.createObjectStore('games_os', 
        {keyPath: 'id', autoIncrement: true});
        objectStore.createIndex('game', 'game');
    };
}

function addGame(newGame, db) {
    let transaction = db.transaction(['games_os'], 'readwrite');
    let objectStore = transaction.objectStore('games_os');
    let request = objectStore.add(newGame);
    transaction.oncomplete = () => {
        console.log('Added game to db');
        displayData(db);
    };

    transaction.onerror = () => {
        console.log('Transaction not opened due to error');
    };
}

function displayData(db) {
    let transaction = db.transaction(['games_os']);
    let objectStore = transaction.objectStore('games_os');
    objectStore.openCursor().onsuccess = e => {
        let cursor = e.target.result;
        if (cursor) {
            console.log(cursor.value.game);
            console.log(cursor.value.id);
            cursor.continue();
        }
    };
}
export {gameDelete};