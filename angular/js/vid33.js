/**
 * Created by David on 5/24/2017.
 */

var app = angular
    .module("Demo", [])
    .controller("countryController", function () {
        this.name = "USA";
    })
    .controller("stateController", function () {
        this.name = "New York";
    })
    .controller("cityController", function () {
        this.name = "Brooklyn";
    });