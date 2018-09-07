
app.controller('fishCtrl', ['$scope', 'FishCollection', function ($scope, fishCollection) {

    $scope.lastHeader = null;
    $scope.fishes     = [];

    /**
     * Render a header if the family
     * has changed in the iteration loop inside the view
     *
     * @param {Fish} fish
     *
     * @returns {boolean}
     */
    $scope.shouldRenderHeader = function (fish) {
        var shouldRender = false;

        if (fish.family !== $scope.lastHeader) {
            shouldRender = true;
        }

        $scope.lastHeader = fish.family;

        return shouldRender;
    };

    $scope.selectFish = function (fish) {
        fish.load(function() {
            $scope.fish = fish;
        });
    };

    /**
     * Query the api for fishes
     */
    fishCollection.load(function (fishCollection) {
        $scope.fishes = fishCollection;
    });

}]);
