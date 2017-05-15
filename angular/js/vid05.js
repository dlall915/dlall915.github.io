/**
 * Created by David on 5/10/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        $scope.message = "Hello Angular!";
    });