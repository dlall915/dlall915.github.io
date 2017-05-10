/**
 * Created by David on 5/9/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        var country = {
            name: "USA",
            capital: "Washington, D.C.",
            flag: "images/american-flag.png"
        };

        $scope.country = country;
    });