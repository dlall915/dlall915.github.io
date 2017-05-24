/**
 * Created by David on 5/24/2017.
 */

var app = angular
    .module("Demo", [])
    .controller("redColorController", function ($scope, $rootScope) {
        $scope.redColor = "I am red color.";
        $rootScope.rootScopeColor = "I am root color.";
    })
    .controller("greenColorController", function ($scope) {
        $scope.greenColor = "I am green color.";
    });