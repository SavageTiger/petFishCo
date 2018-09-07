
app.factory('Fish', ['$http', function ($http) {

    function Fish(id, name, family) {
        this.id     = id;
        this.name   = name;
        this.family = family;
        this.loaded = false;
    }

    Fish.prototype.load = function(callback) {
        var self = this;

        if (this.loaded === false) {
            $http.get('api.php/load/fish/' + this.id).then(function (data) {
                self.normalize(data.data);

                callback(self);
            });
        } else {
            callback(this);
        }
    };

    return Fish;

}]);