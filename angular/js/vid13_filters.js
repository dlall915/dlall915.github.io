/**
 * Created by David on 5/12/2017.
 */

/*
 Arguments are name of the filter being created and then the filter function.
 */
myApp.filter("gender", function () {
    return function (gender) {
        switch (gender) {
            case 1:
                return "Male";
            case 2:
                return "Female";
            case 3:
                return "Not Disclosed";
        }
    }
})