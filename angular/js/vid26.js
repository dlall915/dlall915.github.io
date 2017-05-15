/**
 * Created by David on 5/15/2017.
 */

var myApp = angular
    .module("myModule", ["ngRoute"])
    /* Injects the html templates into the main page according to the URL */
    .config(function ($routeProvider) {
        $routeProvider
            .when("/home", {
                templateUrl: "templates/home.html",
                controller: "homeController"
            })
            .when("/courses", {
                templateUrl: "templates/courses.html",
                controller: "coursesController"
            })
            .when("/students", {
                templateUrl: "templates/students.html",
                controller: "studentsController"
            })
    })
    .controller("homeController", function ($scope) {
        $scope.message = "Home page";
    })
    .controller("coursesController", function ($scope) {
        $scope.courses = ["C#", "VB.NET", "SQL Server", "Java", "AngularJS"];
    })
    .controller("studentsController", function ($scope, $http) {
        $http.get("php/studentsDB.php")
            .then(function (response) {
                $scope.students = response.data;
            })
    });