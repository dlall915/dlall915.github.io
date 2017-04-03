<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $class = $_GET['class'];
    echo "<title>Arena Cards - " . $class . "</title>";
    ?>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/google_analytics.js"></script>
</head>
<body>
    <!-- NAVIGATION -->
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="/">Home</a>
    </nav>
    <!-- NAVIGATION -->
    <div class="container">
        <div class="col-md-12">
            <div style="margin-bottom: 30px;">
                <?php
                /* Get the passed query and parse it into an array */
                $query_string = $_SERVER['QUERY_STRING'];
                parse_str($query_string, $filter_array);
                $class = $_GET['class'];
                echo "<h2>" . $class . " Cards</h2>
                    <a href=\"filter_list.php?class=" . $class . "\" class=\"btn btn-primary\">List View</a>
                    <a href=\"filter_cards.php?class=" . $class . "\" class=\"btn btn-primary\">Card View</a>
            </div>";

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

                $query = '';
                $query .= "SELECT * FROM arenatopdeck WHERE name LIKE '%'";
                foreach ($filter_array as &$value) {
                    $query .= " AND (name LIKE '%".$value."%'
                    OR class LIKE '%".$value."%'
                    OR mana LIKE '%".$value."%'
                    OR type LIKE '%".$value."%'
                    OR rarity LIKE '%".$value."%'
                    OR set_name LIKE '%".$value."%'
                    OR keyword1 LIKE '%".$value."%'
                    OR keyword2 LIKE '%".$value."%'
                    OR keyword3 LIKE '%".$value."%'
                    OR race LIKE '%".$value."%')
                    ";
                }
                // Reset $token since it still references the last element of the array.
                unset($value);
                $query .= " ORDER BY mana, name";

                $result = mysqli_query($connect,$query);

                echo "<table class='scale-in-center'>
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
            </div>
        </div>
</body>
</html>