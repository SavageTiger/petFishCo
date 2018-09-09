
app.factory('Api', ['$q', '$http', 'Notification', function ($q, $http, notification) {

    var errorHandler = function (err) {
        notification.error('Error: <b><br />' + err.data.message + '</b>');
    };

    return {
        getProperties: function (propertyType) {
            return $q(function (resolve, reject) {
                $http.get('api.php/properties/list/' + propertyType).then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        loadEntityList: function (entityType) {
            return $q(function (resolve, reject) {
                $http.get('api.php/entity/list/' + entityType).then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        loadEntity: function (entityType, id) {
            return $q(function (resolve, reject) {
                $http.get('api.php/entity/load/' + entityType + '/' + id).then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        saveEntity: function (entity)
        {
            return $q(function (resolve, reject) {
                $http({ method: 'POST', url: 'api.php/entity/fish', data: JSON.stringify(entity) }).then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });

        }
    }

}]);
