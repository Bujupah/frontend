var db = new Dexie('db-iot');
var schema = {
        user: "++id",
        gateway: "++id",
        station: "++id",
        datasource: "++id",
        sensor: "++id"
    };
    db.version(1).stores(schema);

    function populateAJAX(table){
            // Populate from AJAX:
        db.on('ready', function () {
            return db.table(table).count(async function (count) {
                if (count > 0) {
                    console.log("Already populated");
                } else {
                    console.log("Database is empty. Populating from ajax call...");
                    return new Promise(function (resolve, reject) {
                        $.ajax("/iot/get.php?from="+table, {
                            type: 'get',
                            dataType: 'json',
                            error: function (xhr, textStatus) {
                                reject(textStatus);
                            },
                            success: function (data) {
                                resolve(data);
                            }
                        });
                    }).then(function (data) {
                        console.log("Got ajax response. We'll now add the objects.");
                        console.log("Calling bulkAdd() to insert objects...");
                        console.log(data);
                        return db.table(table).bulkAdd(data);
                    }).then(function () {
                        console.log ("Done populating.");
                    });
                }
            });
        });
    }
    function readFrom(table){
        db.table(table).each(function (obj) {
            console.log("Found object: " + JSON.stringify(obj));
        }).then(function () {
            console.log("Finished.");
        }).catch(function (error) {
            console.error(error.stack || error);
        });
    }