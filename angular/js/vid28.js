/**
 * Created by David on 5/15/2017.
 */

var myApp = angular
    .module("myModule", ["ngRoute"])
    /* Injects the html templates into the main page according to the URL */
    .config(function ($routeProvider, $locationProvider) {
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
            .when("/student/:id", {
                templateUrl: "templates/studentsDetails.html",
                controller: "studentsDetailsController"
            })
            .otherwise( {
                redirectTo: "/home"
            })
        $locationProvider.html5Mode(true);
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
    })
    .controller("studentsDetailsController", function ($scope, $http, $routeParams) {
        $http({
            url:"php/studentsDB.php",
            params:{id:$routeParams.id},
            method: "get"

        }).then(function(response){
            $scope.student = response.data;
        })
    })