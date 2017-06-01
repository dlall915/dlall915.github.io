/**
 * Created by David on 5/15/2017.
 */

var myApp = angular
    .module("myModule", ["ngRoute"])
    /* Injects the html templates into the main page according to the URL */
    .config(function ($routeProvider, $locationProvider) {
        $routeProvider.caseInsensitiveMatch = true;
        $routeProvider
            .when("/home", {
                templateUrl: "templates/home.html",
                controller: "homeController",
                controllerAs: "homeCtrl"
            })
            .when("/courses", {
                templateUrl: "templates/courses.html",
                controller: "coursesController",
                controllerAs: "coursesCtrl"
            })
            .when("/students", {
                templateUrl: "templates/students.html",
                controller: "studentsController",
                controllerAs: "studentsCtrl",
                resolve: {
                    studentsList: function ($http) {
                        return $http.get("php/studentsDB.php")
                            .then(function (response) {
                                return response.data;
                            })
                    }
                }
            })
            .when("/student/:id", {
                templateUrl: "templates/studentsDetails.html",
                controller: "studentsDetailsController",
                controllerAs: "sudentsDetailsCtrl"
            })
            .otherwise( {
                redirectTo: "/home"
            })
        $locationProvider.html5Mode(true);
    })
    .controller("homeController", function () {
        this.message = "Home page";
    })
    .controller("coursesController", function () {
        this.courses = ["C#", "VB.NET", "SQL Server", "Java", "AngularJS"];
    })
    .controller("studentsController", function (studentsList, $http) {
        var viewModel = this;

        viewModel.students = studentsList;
    })
    .controller("studentsDetailsController", function ($http, $routeParams) {
        var viewModel = this;
        $http({
            url:"php/studentsDB.php",
            params:{id:$routeParams.id},
            method: "get"

        }).then(function(response){
            viewModel.student = response.data;
        })
    })