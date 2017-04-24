$(document).ready(function() {
    var druid = ["10", "0", "30.00"];
    var hunter = ["10", "0", "30.00"];
    var mage = ["10", "0", "30.00"];
    var paladin = ["14", "~43.49", "~12.61"];
    var priest = ["10", "0", "30.00"];
    var rogue = ["10", "0", "30.00"];
    var shaman = ["10", "0", "30.00"];
    var warlock = ["11", "~67.03", "~23.31"];
    var warrior = ["10", "0", "30.00"];

    $('.dropdown-menu li').click(function() {
        index = $(this).index();
        name = $(this).text();
        // Chain to prevent multiple DOM searches.
        $('.class-name').empty().append(name);
        $('.probabilities').empty();
        switch (index) {
            case 0:
                $('.probabilities').append(createTable(druid));
                break;
            case 1:
                $('.probabilities').append(createTable(hunter));
                break;
            case 2:
                $('.probabilities').append(createTable(mage));
                break;
            case 3:
                $('.probabilities').append(createTable(paladin));
                break;
            case 4:
                $('.probabilities').append(createTable(priest));
                break;
            case 5:
                $('.probabilities').append(createTable(rogue));
                break;
            case 6:
                $('.probabilities').append(createTable(shaman));
                break;
            case 7:
                $('.probabilities').append(createTable(warlock));
                break;
            case 8:
                $('.probabilities').append(createTable(warrior));
                break;
        }
    });
});

function createTable(class_name) {
    output = '<table><tr><td>Total</td><td>' + class_name[0] + ' cards</td></tr>' +
    '<tr><td>Class card</td><td>' + class_name[1] + '%</td></tr>' +
    '<tr><td>Neutral card</td><td>' + class_name[2] + '%</td></tr></table>';

    return output;
}