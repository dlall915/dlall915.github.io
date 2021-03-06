$(document).ready(function() {
    var druid = ["33", "~28.63", "~7.83", "~98.88"];
    var hunter = ["31", "0", "~9.68", "~91.90"];
    var mage = ["31", "0", "~9.68", "~91.90"];
    var paladin = ["35", "~24.32", "~6.54", "~95.36"];
    var priest = ["32", "~31.32", "~8.67", "~94.44"];
    var rogue = ["31", "0", "~9.68", "~91.90"];
    var shaman = ["36", "~22.59", "~6.03", "~96.40"];
    var warlock = ["34", "~26.32", "~7.13", "~97.05"];
    var warrior = ["38", "~19.74", "~5.22", "~96.02"];

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
    '<tr><td>Neutral card</td><td>' + class_name[2] + '%</td></tr>' +
    '<tr><td>5+ health minion</td><td>' + class_name[3] + '%</td></tr></table>';

    return output;
}