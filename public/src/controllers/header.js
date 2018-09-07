
app.controller('headerCtrl', ['$scope', function ($scope) {

    $scope.headerTpl = './partial/header.tpl.html';

    /**
     * Item click event
     *
     * @param href
     */
    $scope.click = function (href) {
        $scope.$parent.viewTpl = './partial/'  + href + '.tpl.html';
    }
}]);
