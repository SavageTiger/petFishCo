
app.controller('aquariaCtrl', ['$scope', 'Collection', 'Model', function($scope, Collection, Model) {

    /**
     * Load a selected aquarium
     *
     * @param {object} aquarium
     */
    $scope.selectAquarium = function (aquarium) {
        aquarium.loadClone(function(model) {
            $scope.viewModel = model;
        });
    };

    /**
     * Query the api for aquaria (/ aquariums?)
     */
    $scope.loadAquaria = function () {
        Collection.load('aquarium', function (aquariumCollection) {
            $scope.aquaria = aquariumCollection;
        });
    };

    /**
     * Save model to the back-end
     */
    $scope.saveAquarium = function() {
        $scope.viewModel.save().then(function () {
            $scope.loadAquaria();
        });
    };

    /**
     * Create new event
     */
    $scope.createNew = function () {
        $scope.viewModel = new Model('aquarium');

        $scope.viewModel.volume_unit = 'liters'
    };

    // Bootstrap view
    $scope.loadAquaria();

}]);
