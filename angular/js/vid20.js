/**
 * Created by David on 5/15/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope, stringService) {
        $scope.transformString = function (input) {
            $scope.output = stringService.processString(input);
        }
    });