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
    $query = "SELECT * FROM arenatopdeck 
        ORDER BY mana, name";
}

$result = mysqli_query($connect, $query);

/* Generate the first row of a table with the labels, then populate this table in the
   while loop. Close divider, then send the HTML output. */
if (mysqli_num_rows($result) > 0) {
    // .= appends to a string
    $output .= '
        <div class="container">
            <div class="col-md-12">
            <table>
                <tr>
                    <th>Mana</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Type</th>
                    <th>Rarity</th>
                    <th>Set</th>
                </tr>
    ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
               <tr>
                   <td>'.$row["mana"].'</td>
                   <td><a href="/cards/'.$row["name_link"].'">'.$row["name"].'</a></td>
                   <td>'.$row["class"].'</td>
                   <td>'.$row["type"].'</td>
                   <td>'.$row["rarity"].'</td>
                   <td>'.$row["set_name"].'</td>
               </tr>
  ';
    }
    $output .= '</div></div>';
    echo $output;
}
/* No results. */
else {
    echo 'No cards found.';
}
