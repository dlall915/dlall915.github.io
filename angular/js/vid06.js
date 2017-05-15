/**
 * Created by David on 5/10/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        var employees = [
            { firstName: "Ben", lastName: "Hastings", gender: "Male", salary: 55000 },
            { firstName: "Sara", lastName: "Paul", gender: "Female", salary: 68000 },
            { firstName: "Mark", lastName: "Holland", gender: "Male", salary: 57000 },
            { firstName: "Pam", lastName: "Macintosh", gender: "Female", salary: 53000 },
            { firstName: "Todd", lastName: "Barber", gender: "Male", salary: 60000 },
        ];
        $scope.employees = employees;

        var countries = [
            {
                name: "UK",
                cities: [
                    { name: "Londom" },
                    { name: "Manchester" },
                    { name: "Birmingham" },
                ]
            },
            {
                name: "USA",
                cities: [
                    { name: "Los Angeles" },
                    { name: "Chicago" },
                    { name: "Houston" },
                ]
            },
            {
                name: "Spain",
                cities: [
                    { name: "Madrid" },
                    { name: "Barcelona" },
                    { name: "Valencia" },
                ]
            },
        ];

        $scope.countries = countries;
    });