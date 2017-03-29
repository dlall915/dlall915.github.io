<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
        <link rel="stylesheet" href="css/style.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <div style="margin-bottom: 50px;">
                <div>
                    <input type="text" name="search_text" id="search_text" placeholder="Search (name, type, etc...)"
                           class="form-control"/>
                    <div style="margin-top: 25px">
                        <a href="#" class="btn btn-primary">List View</a>
                        <a href="search_cards.php" class="btn btn-primary">Card View</a>
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </div>

        <script>
            $(document).ready(function(){

                load_data();

                function load_data(query) {
                    $.ajax({
                        url:"fetch_list.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data) {
                            $('#result').html(data);
                        }
                    });
                }

                $('#search_text').keyup(function(){
                    var search = $(this).val();
                    if(search != '') {
                        load_data(search);
                    }
                    else {
                        load_data();
                    }
                });
            });
        </script>

    </body>
</html>