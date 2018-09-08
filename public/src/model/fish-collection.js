
app.factory('FishCollection', ['$http', 'Fish', function ($http, fish) {
    var fishCollection = {};

    /**
     * Get list of fishes from the back-end and create client-side models
     *
     * @param {method} callback
     */
    fishCollection.load = function (callback) {
        $http.get('api.php/entity/list/fish').then(function (data) {
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