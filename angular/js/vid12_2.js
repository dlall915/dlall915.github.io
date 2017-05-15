/**
 * Created by David on 5/11/2017.
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

        /*
        If search text is undefined (empty), display all rows.
        Else if there is a match with a name or city, display those rows rows.
        Else display no rows.
         */
        $scope.search = function (item) {
            if($scope.searchText == undefined) {
                return true;
            }
            else if(item.name.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 ||
                    item.city.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1) {
                return true;
            }
            else {
                return false;
            }
        }
    });