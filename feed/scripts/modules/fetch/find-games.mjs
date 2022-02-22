//Function delete games which are in IndexedDB from JSON file
function filterGames(db, games, dbName) {
    let transaction = db.transaction([dbName +' _os'], 'readwrite');
    let objectStore = transaction.objectStore(dbName +' _os');
    return new Promise((resolve,reject) => {
        objectStore.openCursor().onsuccess = e => {
            let cursor = e.target.result;
            if (cursor) {
                let game = cursor.value.object;
                let date = game.date;
                date += ":00";
                date.replace(" ", "T");
                date = new Date(date);
                //Delete games which already started from IndexedDB
                if (date < new Date(Date.now())) {
                    objectStore.delete(cursor.value.id);
                } else {
                    for (let i = 0; i < games.length; i++) {
                        if (games[i][4] === game.teams && 
                            games[i][5] === game.bet) {
                                //Splice instead of delete because delete
                                //did not change indexes
                                games.splice(i, 1);
                                break;
                        }
                    }
                }
                cursor.continue();
            }
            //Resolve promise with filtered JSON file after loop thru 
            //every index in IndexedDB
            if (!cursor) resolve(games);
        };
    });
}

export {filterGames};