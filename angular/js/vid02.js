/**
 * Created by David on 5/9/2017.
 */

/* Module */
var myApp = angular.module("myModule", []);

/* Create and register controller with the module */
myApp.controller("myController", function ($scope) {
    $scope.message = "AngularJS Tutorial";
});