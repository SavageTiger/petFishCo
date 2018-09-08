
var app = angular.module('petFishCo', ['color.picker', 'ui-notification']);

app.controller('mainCtrl', ['Notification', function (Notification) {

    Notification.success('Welcome');

}]);