
app.factory('Api', ['$q', '$http', 'Notification', function ($q, $http, notification) {

    let errorHandler = function (err) {
        notification.error('Error: <b><br />' + err.data.message + '</b>');
    };

    return {

        // -----------------------------------[ Entity routes ] -----------------------------------------------

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
                $http({ method: entity.id ? 'PATCH' : 'POST', url: 'api.php/entity/' + typeName, data: entity }).then(function (data) {
                    if (data.data.id) {
                        entity.id = data.data.id;
                    }

                    if (data.data.message) {
                        notification.success('Success:<br /><b>' + data.data.message + '</b>')
                    }

                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        // -----------------------------------[ Inventory routes ] -----------------------------------------------


        getInventoryList: function () {
            return $q(function (resolve, reject) {
                $http.get('api.php/inventory/list').then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        getInventoryDetails: function (aquariumId) {
            return $q(function (resolve, reject) {
                $http.get('api.php/inventory/details/' + aquariumId).then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        updateInventory: function (aquariumId, payload) {
            return $q(function (resolve, reject) {
                $http({ method: 'PATCH', url: 'api.php/inventory/update/' + aquariumId, data: payload }).then(function (data) {
                    if (data.data.message) {
                        notification.success('Success:<br /><b>' + data.data.message + '</b>')
                    }

                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        // -----------------------------------[ Property routes ] -----------------------------------------------

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

        getAvailableTypes: function () {
            return $q(function (resolve, reject) {
                $http.get('api.php/properties/types').then(function (data) {
                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        saveProperty: function (property, propertyType) {
            return $q(function (resolve, reject) {
                property = { id: property.id, display_name: property.value };

                $http({ method: property.id ? 'PATCH' : 'POST', url: 'api.php/properties/update/' + propertyType, data: property }).then(function (data) {
                    if (data.data.message) {
                        notification.success('Success:<br /><b>' + data.data.message + '</b>')
                    }

                    resolve(data);
                }, function (err) {
                    errorHandler(err);

                    reject(err);
                });
            });
        },

        removeProperty: function (property) {
            return $q(function (resolve, reject) {
                $http({ method: 'POST', url: 'api.php/properties/remove/' + property.id }).then(function (data) {
                    if (data.data.message) {
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
