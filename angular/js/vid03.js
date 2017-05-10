/**
 * Created by David on 5/9/2017.
 */

/* Using method chaining, you can create the module, controller, and register the controller with the module, all in
   one line */
var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        var employee = {
            firstName: "David",
            lastName: "Hastings",
            gender: "Male"
        };

        $scope.employee = employee;
    });