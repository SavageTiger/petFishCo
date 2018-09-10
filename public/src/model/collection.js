
app.factory('Collection', ['Api', 'Model', function (api, Model) {

    var collection = {};

    /**
     * Get list of models of certain type from the back-end and create client-side models
     *
     * @param {string} typeName
     * @param {method} callback
     */
    collection.load = function (typeName, callback) {
        api.loadEntityList(typeName).then(function (data) {
            var models = [];

            for (var i in data.data) {
                var model = new Model(typeName);

                model.unserialize(data.data[i]);

                models.push(model);
            }

            callback(models);
        });
    };

    return collection;
}]);