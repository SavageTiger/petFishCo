
app.controller('fishCtrl', ['$scope', 'FishCollection', 'Fish', function ($scope, fishCollection, fish) {

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
        });
    };

    /**
     * Image change button press event
     */
    $scope.changeImage = function () {
        // Propagate action to the ngImage directive
        $scope.$broadcast('imagePicker');
    };

    $scope.createNew = function () {
        $scope.viewModel = new fish(null);
    };

    /**
     * Save model to the back-end
     */
    $scope.saveFish = function() {
        $scope.viewModel.save();
    };

    /**
     * Query the api for fishes
     */
    fishCollection.load(function (fishCollection) {
        $scope.fishes = fishCollection;
    });

}]);
