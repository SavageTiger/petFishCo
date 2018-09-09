
app.factory('Fish', ['Api', function (api) {

    function Fish(id, name, family) {
        this.id         = id;
        this.name       = name;
        this.familyName = family;
    }

    Fish.prototype.unserialize = function (data) {
        for (var key in data) {
            this[key] = data[key];
        }
    };

    Fish.prototype.loadClone = function(callback) {
        api.loadEntity('fish', this.id).then(function (data) {
            var fish = new Fish();

            fish.unserialize(data.data);

            callback(fish);
        });
    };

    Fish.prototype.save = function () {
        if (this.id) {

        } else {
        }

        api.saveEntity(this);
    };

    return Fish;

}]);