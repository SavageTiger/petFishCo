
app.factory('Fish', ['$http', function ($http) {

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
        $http.get('api.php/entity/load/fish/' + this.id).then(function (data) {
            var fish = new Fish();

            fish.unserialize(data.data);

            callback(fish);
        });
    };

    return Fish;

}]);