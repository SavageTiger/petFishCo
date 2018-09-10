
app.directive('ngVolume', [ function(api) {
    return {
        restrict: 'E',
        scope: {
            volumeUnit: '=',
            volume: '='
        },
        transclude: true,

        link: function(scope, element, attrs) {
            scope.changeUnit = function (newValue, oldValue) {
                if (oldValue === 'liters' && newValue === 'gallons') {
                    scope.volume = scope.volume / 3.78;
                } else if (oldValue === 'gallons' && newValue === 'liters') {
                    scope.volume = scope.volume * 3.78;
                }
            };
        },

        template:
            '<div class="row">' +
            '    <div class="col-md-8"><input type="text" class="form-control"  ng-model="volume" /></div>' +
            '    <div class="col-md-3"><select ng-options="o for o in [\'liters\', \'gallons\']" ng-change="changeUnit(volumeUnit, \'{{ volumeUnit }}\')" ng-model="volumeUnit" class="form-control"></div>' +
            '</div>'
    };
}]);