
app.controller('fishCtrl', ['$scope', 'Collection', 'Model', function ($scope, Collection, Model) {

    $scope.lastHeader = null;
    $scope.fishes     = [];

    /**
     * Render a header if the family
     * has changed in the iteration loop inside the view
     *
     * @param {Model} fish
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

    /**
     * Load a selected fish
     *
     * @param {Model} fish
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

    /**
     * Create new event
     */
    $scope.createNew = function () {
        $scope.viewModel = new Model('fish');
    };

    /**
     * Save model to the back-end
     */
    $scope.saveFish = function() {
        $scope.viewModel.save().then(function () {
            $scope.loadFishes();
        });
    };

    /**
     * Query the api for fishes
     */
    $scope.loadFishes = function () {
        Collection.load('fish', function (fishCollection) {
            $scope.fishes = fishCollection;
        });
    };

    // Bootstrap view
    $scope.loadFishes();

}]);
