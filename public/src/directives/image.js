
app.directive('ngImage', [ function() {
    return {
        require: 'ngModel',
        restrict: 'E',
        transclude: true,

        template:
            '<canvas class="fish-picture"></canvas>' +
            '<input type="file" style="display: none;">',

        link: function(scope, element, attrs, ngModel) {

            var handleFileChange = function(e) {
                var reader = new FileReader();
                var file = (e.srcElement || e.target).files[0];

                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    var trimmedBase64;

                    trimmedBase64 = e.target.result.split(/;base64,/);
                    trimmedBase64 = trimmedBase64[1];

                    renderImage(file.name, trimmedBase64);

                    ngModel.$setViewValue({ filename: file.name, binary: trimmedBase64 });
                };
            };

            var getExtension = function (fileName) {
                fileName = fileName.split(/./g);

                return fileName[fileName.length];
            };

            var renderImage = function (fileName, base64Binary) {
                var canvas  = element[0].getElementsByTagName('canvas')[0];
                var context = canvas.getContext("2d");

                var image = new Image();

                image.onload = function() {
                    context.clearRect(0, 0, canvas.width, canvas.height);
                    context.drawImage(image, 0, 0, canvas.width, canvas.height);
                };

                image.src = 'data:image/' + getExtension(fileName) +';base64,' + base64Binary;
            };

            var clearImage = function () {
                var canvas  = element[0].getElementsByTagName('canvas')[0];
                var context = canvas.getContext("2d");
                
                context.clearRect(0, 0, canvas.width, canvas.height);
            };

            ngModel.$render = function () {
                var picture = ngModel.$viewValue;

                if (picture) {
                    renderImage(picture.filename, picture.binary);
                } else {
                    clearImage();
                }
            };

            scope.$on('imagePicker', function() {
                var uploadElement = element[0].getElementsByTagName('input')[0];

                uploadElement.click();
                uploadElement.onchange = handleFileChange;
            });
        }
    };
}]);
