function addGame(newGame, db) {
    let transaction = db.transaction(['games_os'], 'readwrite');
    let objectStore = transaction.objectStore('games_os');
    objectStore.add(newGame);
    transaction.oncomplete = () => {
        console.log('Added game to db');
        //displayData(db);
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
            let game = getData(cursor);
            console.log(game);
            cursor.continue();
        }
    };
}

function getData(cursor) {
    let game = cursor.value.game;
    return game;
}

export{addGame, displayData};