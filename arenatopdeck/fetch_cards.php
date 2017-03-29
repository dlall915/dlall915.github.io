<?php
//DB info
$host = "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com";
$db = "cardDevDB";
$user = "David";
$password = "arenatopdeck";

//Connect to the DB
$connect = mysqli_connect($host, $user, $password, $db);
$list = True;
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "SELECT * FROM arenatopdeck 
        WHERE name LIKE '%".$search."%'
        OR class LIKE '%".$search."%' 
        OR type LIKE '%".$search."%' 
        OR rarity LIKE '%".$search."%' 
        OR set_name LIKE '%".$search."%'
        ORDER BY mana, name";
}
else {
    $query = "SELECT * FROM arenatopdeck WHERE name = 'Murloc Tinyfin'";
}

$result = mysqli_query($connect, $query);

// Generate the container for a responsive view, then populate the container with the
// while loop. Close containers, then send the HTML output.
if (mysqli_num_rows($result) > 0) {
    $output .= '
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
    ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href=/cards/'.$row["name_link"].'>
                        <img class="img-responsive"
                             src="http://media.services.zam.com/v1/media/byName/hs/cards/enus/'.$row["pic_link"].'.png">
                    </a>
                </div>
        ';
    }
    $output .= '
            </div>
        </div>';
    echo $output;
}
else
{
    echo 'No cards found.';
}

?>
