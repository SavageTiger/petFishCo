
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

        if (fish.familyName !== $scope.lastHeader) {
            shouldRender = true;
        }

        $scope.lastHeader = fish.familyName;

        return shouldRender;
    };

    /**
     * Load a selected fish
     *
     * @param {object} fish
     */
    $scope.selectFish = function (fish) {
        fish.loadClone(function(model) {
            $scope.viewModel = model;
            $scope.isDirty  = undefined;
        });
    };

    /**
     * Detect a model change
     */
    $scope.$watch('viewModel', function() {
        $scope.isDirty = ($scope.isDirty !== undefined);
    }, true);

    /**
     * Query the api for fishes
     */
    fishCollection.load(function (fishCollection) {
        $scope.fishes = fishCollection;
    });

}]);
