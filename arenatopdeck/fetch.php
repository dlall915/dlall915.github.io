<?php
//DB info
$host = "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com";
$db = "cardDevDB";
$user = "David";
$password = "arenatopdeck";

//Connect to the DB
$connect = mysqli_connect($host, $user, $password, $db);
$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "SELECT * FROM arenatopdeck 
        WHERE name LIKE '%".$search."%'
        OR class LIKE '%".$search."%' 
        OR type LIKE '%".$search."%' 
        OR rarity LIKE '%".$search."%' 
        OR set_name LIKE '%".$search."%'";
}
else {
    $query = "SELECT * FROM arenatopdeck ORDER BY name";
}

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $output .= '
        <div class="table-responsive">
            <table class="table table bordered">
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Mana</th>
                    <th>Type</th>
                    <th>Rarity</th>
                    <th>Set</th>
                </tr>
    ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
               <tr>
                   <td><a href="/cards/'.$row["name_link"].'">'.$row["name"].'</a></td>
                   <td>'.$row["class"].'</td>
                   <td>'.$row["mana"].'</td>
                   <td>'.$row["type"].'</td>
                   <td>'.$row["rarity"].'</td>
                   <td>'.$row["set_name"].'</td>
               </tr>
  ';
    }
    echo $output;
}
else
{
    echo 'No cards found.';
}
?>