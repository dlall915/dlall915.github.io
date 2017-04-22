$(document).ready(function(){

    load_data();

    function load_data(query) {
        $.ajax({
            url:"../php/fetch_probabilities.php",
            method:"POST",
            data:{query:query},
            success:function(data) {
                $('#result').html(data);
            }
        });
    }

    $('#druid').select(function(){
        var search = $(this).val();
        if(search != '') {
            load_data(search);
        }
        else {
            load_data();
        }
    });
});