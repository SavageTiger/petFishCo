
app.controller('inventoryCtrl', ['$scope', 'Api', 'Collection', 'Notification', function ($scope, api, collection, notification) {

    /**
     * Open details view
     *
     * @param {uuid} aquariumId
     */
    $scope.details = function(aquariumId) {
        api.getInventoryDetails(aquariumId).then(function (data) {
            $scope.aquarium = data.data;
            $scope.viewType  = 'detail';
        });
    };

    /**
     * Add this kind of fish to the aquarium
     *
     * @param {object} fishKind
     */
    $scope.addFish = function(fishKind) {
        for (var i in $scope.aquarium.inventory) {
            if ($scope.aquarium.inventory[i].fish.id === fishKind.id) {
                notification.warning('Unable to add new fish kind: <br /><b>This kind is already present in the tank.</b>');

                return;
            }
        }

        $scope.aquarium.inventory.push({
            amount: 0,
            fish: fishKind,
            touched: true
        });
    };

    /**
     * Send an array of changed fish to the back-end
     */
    $scope.updateInventory = function() {
        var updated = [];

        angular.forEach($scope.aquarium.inventory, function (item) {
            if (item.touched) {
                updated.push({
                    fishId: item.fish.id,
                    amount: item.amount
                });
            }
        });

        api.updateInventory($scope.aquarium.id, updated).then(function() {
            $scope.loadInventoryList();
            $scope.back();
        });
    };

    /**
     * Return to list view
     */
    $scope.back = function() {
        $scope.aquarium = null;
        $scope.viewType = 'list';
    };

    // Load inventory overview
    $scope.loadInventoryList = function() {
        api.getInventoryList().then(function(data) {
            $scope.inventory = data.data;
        });
    };
    $scope.loadInventoryList();

    // Load fishes
    collection.load('fish', function(fishes) {
        $scope.fishes = fishes;
    });

    $scope.viewType  = 'list';
}]);