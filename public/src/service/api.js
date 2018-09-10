
app.factory('Api', ['$q', '$http', 'Notification', function ($q, $http, notification) {

    let errorHandler = function (err) {
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

        saveEntity: function (typeName, entity)
        {
            return $q(function (resolve, reject) {
                $http({ method: entity.id ? 'PATCH' : 'POST', url: 'api.php/entity/' + typeName, data: JSON.stringify(entity) }).then(function (data) {
                    if (data.data.id) {
                        entity.id = data.data.id;

                        notification.success('Success:<br /><b>' + data.data.message + '</b>')
                    }

                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });

        }
    }

}]);
