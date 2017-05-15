/**
 * Created by David on 5/12/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope) {
        var countries = [
            {
                name: "USA",
                cities: [
                    {name: "New York"},
                    {name: "Los Angeles"}
                ]
            },
            {
                name: "England",
                cities: [
                    {name: "London"},
                    {name: "Manchester"}
                ]
            }
        ];

        $scope.countries = countries;
    });