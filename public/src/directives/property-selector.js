
app.directive('ngPropertySelector', ['Api', function(api) {
    return {
        require: 'ngModel',
        scope: true,
        restrict: 'E',
        transclude: true,

        link: function(scope, element, attrs, ngModel) {

            api.getProperties(attrs.propertyType).then(function (data) {
                scope.properties = data.data;
            });

            ngModel.$render = function () {
                scope.property = ngModel.$viewValue;
            };

            scope.$watch('property', function (value) {
                ngModel.$setViewValue(value);
            })

        },

        template: '<select class="form-control" ng-options="property for property in properties" ng-model="property"></select>'
    };
}]);