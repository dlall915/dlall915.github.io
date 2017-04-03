<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<?php
$q = $_GET['q'];

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

$sql="SELECT * FROM arenatopdeck WHERE class LIKE '".$q."'";
$result = mysqli_query($connect,$sql);

echo "<table>
        <tr>
            <th>Mana</th>
            <th>Name</th>
            <th>Class</th>
            <th>Rarity</th>
            <th>Set</th>
        </tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['mana'] . "</td>";
    echo "<td><a href=\"/cards/" . $row['name_link'] . "\">" . $row['name'] .  "</a>";
    echo "<td>" . $row['class'] . "</td>";
    echo "<td>" . $row['rarity'] . "</td>";
    echo "<td>" . $row['set_name'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($connect);
?>
</body>
</html>