
app.controller('inventoryCtrl', ['$scope', 'Api', function ($scope, api) {

    $scope.setDirty = function(sender) {
        console.log(sender);
    };

    $scope.details = function(aquariumId) {
        api.getInventoryDetails(aquariumId).then(function (data) {
            $scope.aquarium = data.data;
            $scope.viewType  = 'detail';
        });
    };

    api.getInventoryList().then(function(data) {
        $scope.inventory = data.data;
    });

    $scope.viewType  = 'list';
}]);