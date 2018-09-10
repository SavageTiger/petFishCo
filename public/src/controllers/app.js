
var app = angular.module('petFishCo', ['color.picker', 'ui-notification']);

app.controller('mainCtrl', ['$scope', function ($scope) {

    $scope.colorPickerSettings = {
        format: 'hex'
    };

}]);