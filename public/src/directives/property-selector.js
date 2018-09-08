
app.directive('ngPropertySelector', ['$http', function($http) {
    return {
        require: 'ngModel',
        restrict: 'E',
        transclude: true,

        link: function(scope, element, attrs, ngModel) {

            $http.get('api.php/properties/list/' + attrs.propertyType).then(function (data) {
                scope.properties = data.data;
            });

            ngModel.$render = function () {
                scope.property = ngModel.$viewValue;
            };

            scope.$watch('property', function (oldVal, newVal) {
                ngModel.$setViewValue(newVal);
            })

        },

        template: '<select class="form-control" ng-options="property for property in properties" ng-model="property"></select>'
    };
}]);