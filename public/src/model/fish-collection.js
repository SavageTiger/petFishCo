
app.factory('FishCollection', ['Api', 'Fish', function (api, fish) {
    var fishCollection = {};

    /**
     * Get list of fishes from the back-end and create client-side models
     *
     * @param {method} callback
     */
    fishCollection.load = function (callback) {
        api.loadEntityList('fish').then(function (data) {
            var fishModels = [];

            for (var i in data.data) {
                fishModels.push(
                    new fish(
                        data.data[i].id,
                        data.data[i].name,
                        data.data[i].familyName,
                    )
                );
            }

            callback(fishModels);
        });
    };

    return fishCollection;
}]);