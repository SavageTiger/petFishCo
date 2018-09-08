
app.controller('headerCtrl', ['$scope', function ($scope) {

    $scope.headerTpl = './partial/header.tpl.html';

    /**
     * Item click event
     *
     * @param {string} href
     * @param {string} title
     */
    $scope.click = function (href, title) {
        $scope.$parent.viewTitle = title;
        $scope.$parent.viewTpl   = './partial/'  + href + '.tpl.html';
    }
}]);
