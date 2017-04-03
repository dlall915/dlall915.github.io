<?php
/* DB info. */
$host = "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com";
$db = "cardDevDB";
$user = "David";
$password = "arenatopdeck";

/* Connect to the DB, hide errors form being output to the user. */
mysqli_report(MYSQLI_REPORT_STRICT);
try {
    $connect = mysqli_connect($host, $user, $password, $db);
} catch (Exception $e) {
    echo 'Connection to database failed.';
    exit();
}

/* Variables. */
$output = '';

/* Do this on POST request. */
if (isset($_POST["query"])) {
    // Removes special characters to create a legal SQL string.
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    // explode() breaks a string up into an array using a delimiter.
    $tokens = explode(", ", $search);
    $query .= "SELECT * FROM arenatopdeck WHERE name LIKE '%'";
    foreach ($tokens as &$token) {
        $query .= " AND (name LIKE '%".$token."%'
        OR class LIKE '%".$token."%'
        OR mana LIKE '%".$token."%'
        OR type LIKE '%".$token."%'
        OR rarity LIKE '%".$token."%'
        OR set_name LIKE '%".$token."%'
        OR keyword1 LIKE '%".$token."%'
        OR keyword2 LIKE '%".$token."%'
        OR keyword3 LIKE '%".$token."%'
        OR race LIKE '%".$token."%')
        ";
    }
    // Reset $token since it still references the last element of the array.
    unset($token);
    $query .= " ORDER BY mana, name";
}
/* Default list, which is everything. */
else {
    $query = "SELECT * FROM arenatopdeck_archive 
        WHERE NAME='Murloc Tinyfin'
        ORDER BY mana, name";
}

$result = mysqli_query($connect, $query);

/* Generate the container for a responsive view, then populate the container with the
   while loop. Close containers, then send the HTML output. */
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
/* No results. */
else {
    echo 'No cards found.';
}
