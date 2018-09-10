
app.factory('Model', ['Api', function (api) {

    function Model(typeName) {
        this.typeName = typeName;
    }

    Model.prototype.unserialize = function (data) {
        for (var key in data) {
            this[key] = data[key];
        }
    };

    Model.prototype.loadClone = function(callback) {
        var self = this;

        api.loadEntity(this.typeName, this.id).then(function (data) {
            var model = new Model(self.typeName);

            model.unserialize(data.data);

            callback(model);
        });
    };

    Model.prototype.save = function () {
        return api.saveEntity(this.typeName, this);
    };

    return Model;

}]);