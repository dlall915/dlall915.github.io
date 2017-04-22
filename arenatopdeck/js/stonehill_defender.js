$(document).ready(function() {
    var warrior = '<table><tr><td>Total</td><td>38 cards</td></tr>' +
        '<tr><td>Class card</td><td>~19.74%</td></tr>' +
        '<tr><td>Neutral card</td><td>~5.22%</td></tr>' +
        '<tr><td>5+ health minion</td><td>~98.88%</td></tr></table>';

    $('.dropdown-menu li').click(function() {
        var index = $(this).index();
        var name = $(this).text();
        $('.class-name').empty();
        $('.class-name').append(name);
        if (index == 8) {
            $('.probabilities').append(warrior);
        }
        else {}
    });
});