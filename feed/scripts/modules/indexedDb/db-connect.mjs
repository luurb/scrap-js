function dbConnect(callback) {
    //let request = indexedDB.deleteDatabase('games');
    let request = indexedDB.open('games', 1);
    request.onerror = () => {
        console.log('Database failed to open');
    };

    request.onsuccess = () => {
       let db = request.result;
       callback(db);
    };

    request.onupgradeneeded = e => {
        let db = e.target.result;
        let objectStore = db.createObjectStore('games_os', 
        {keyPath: 'id', autoIncrement: true});
        objectStore.createIndex('game', 'game');
    };
}

export {dbConnect};