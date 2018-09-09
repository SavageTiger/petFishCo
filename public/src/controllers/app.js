
var app = angular.module('petFishCo', ['color.picker', 'ui-notification']);

app.controller('mainCtrl', ['$scope', 'Notification', function ($scope, notification) {

    $scope.colorPickerSettings = {
        format: 'hex'
    };

    notification.success('Welcome');

}]);