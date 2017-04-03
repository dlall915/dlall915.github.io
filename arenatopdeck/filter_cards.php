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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div style="margin-bottom: 30px;">
                <?php
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

                $sql="SELECT * FROM arenatopdeck WHERE class LIKE '".$class."'
                            ORDER BY mana, name";
                $result = mysqli_query($connect,$sql);

                while($row = mysqli_fetch_array($result)) {
                    echo "<div class=\"col-md-4 col-sm-6 col-xs-12\">
                                <a href=cards/" . $row['name_link'] . ">
                                    <img class=\"img-responsive center\"
                                        src=\"http://media.services.zam.com/v1/media/byName/hs/cards/enus/" . $row['pic_link'] . ".png\">
                                </a>
                            </div>";
                }
                mysqli_close($connect);
                ?>
            </div>
        </div>
</body>
</html>