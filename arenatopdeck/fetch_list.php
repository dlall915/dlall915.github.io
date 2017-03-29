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
    $query = "SELECT * FROM arenatopdeck ORDER BY mana, name";
}

$result = mysqli_query($connect, $query);

// Generate the first row of a table with the labels, then populate this table in the
// while loop. Close divider, then send the HTML output.
if ((mysqli_num_rows($result) > 0) and $list) {
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
else {
    echo 'No cards found.';
}

?>
