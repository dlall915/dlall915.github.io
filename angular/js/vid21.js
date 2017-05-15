/**
 * Created by David on 5/15/2017.
 */

var myApp = angular
    .module("myModule", [])
    .controller("myController", function ($scope, $location, $anchorScroll) {
        $scope.scrollTo = function (scrollLocation) {
            /* Appends what is passed to the URL */
            $location.hash(scrollLocation);
            /* Creates space between the button and the top of the window */
            $anchorScroll.yOffset = 20;
            $anchorScroll();
        }
    });