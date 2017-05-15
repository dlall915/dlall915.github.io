/**
 * Created by David on 5/12/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        var employees = [
            { name: "Ben", city: "London", gender: "Male", salary: 55000 },
            { name: "Sara", city: "New York", gender: "Female", salary: 68000 },
            { name: "Mark", city: "New York", gender: "Male", salary: 57000 },
            { name: "Pam", city: "London", gender: "Female", salary: 53000 },
            { name: "Todd", city: "London", gender: "Male", salary: 60000 }
        ];

        $scope.employees = employees;
    });