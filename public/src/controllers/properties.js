
app.controller('propertiesCtrl', ['$scope', 'Api', function ($scope, api) {

    /**
     * Load properties (values) of the selected property type
     *
     * @param {object} type
     */
    $scope.selectType = function (type) {
        $scope.type     = type;
        $scope.viewType = 'list';

        $scope.loadProperties(type.display_name);
    };

    /**
     * Edit property
     *
     * @param {object} property
     */
    $scope.editProperty = function (property) {
        $scope.viewType = 'edit';
        $scope.property = property;
    };

    /**
     * Query the back-end for configured properties
     *
     * @param {string} typeName
     */
    $scope.loadProperties = function(typeName) {
        api.getProperties(typeName).then(function  (data) {
            var properties = [];

            for (let id in data.data) {
                properties.push({
                    id: id,
                    value: data.data[id]
                });
            }

            $scope.properties = properties;
        });
    };

    /**
     * Create new property value
     */
    $scope.createNew = function () {
        $scope.property = { id: null, value: '' };
        $scope.viewType = 'edit';
    };

    /**
     * Save property changes
     *
     * @param {object} property
     */
    $scope.save = function(property) {
        api.saveProperty(property, $scope.type.identifier).then(function () {
            $scope.property = null;
            $scope.viewType = 'list';

            // Refresh list
            $scope.selectType($scope.type);
        });
    };

    /**
     * Show remove property view
     *
     * @param {object} property
     */
    $scope.removeProperty = function(property) {
        $scope.property = property;
        $scope.viewType = 'remove';
    };

    /**
     * Remove a property
     *
     * @param {object} property
     */
    $scope.applyRemoveProperty = function(property) {
        api.removeProperty(property).then(function () {
            $scope.property = null;
            $scope.viewType = 'list';

            // Refresh list
            $scope.selectType($scope.type);
        });
    };

    // Bootstrap
    api.getAvailableTypes().then(function (data) {
       $scope.propertyTypes = data.data;
    })

}]);
