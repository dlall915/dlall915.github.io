<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css"/>
        <style>
            label {
                display: block;
                padding-left: 15px;
                text-indent: -15px;
            }
            input[type="checkbox"] {
                width: 13px;
                height: 13px;
                padding: 0;
                margin:0;
                vertical-align: bottom;
                position: relative;
                top: -1px;
                *overflow: hidden;
            }
        </style>
        <script src="js/google_analytics.js"></script>
        <script src="js/sorttable.js"></script>
    </head>
    <body>
        <!-- NAVIGATION -->
        <nav class="navbar navbar-default">
            <a class="navbar-brand" href="search_list.html">Back</a>
        </nav>
        <!-- NAVIGATION -->
        <div class="container">
            <h2>Filters</h2>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form onSubmit="return filter();">
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Class</h3>
                                        <label><input type="checkbox" name="Druid" id="class"/> Druid</label>
                                        <label><input type="checkbox" name="Hunter" id="class"/> Hunter</label>
                                        <label><input type="checkbox" name="Mage" id="class"/> Mage</label>
                                        <label><input type="checkbox" name="Paladin" id="class"/> Paladin</label>
                                        <label><input type="checkbox" name="Priest" id="class"/> Priest</label>
                                        <label><input type="checkbox" name="Rogue" id="class"/> Rogue</label>
                                        <label><input type="checkbox" name="Shaman" id="class"/> Shaman</label>
                                        <label><input type="checkbox" name="Warlock" id="class"/> Warlock</label>
                                        <label><input type="checkbox" name="Warrior" id="class"/> Warrior</label>
                                        <label><input type="checkbox" name="Neutral" id="class"/> Neutral</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Mana</h3>
                                        <label><input type="checkbox" name="1" id="mana"/> 1</label>
                                        <label><input type="checkbox" name="2" id="mana"/> 2</label>
                                        <label><input type="checkbox" name="3" id="mana"/> 3</label>
                                        <label><input type="checkbox" name="4" id="mana"/> 4</label>
                                        <label><input type="checkbox" name="5" id="mana"/> 5</label>
                                        <label><input type="checkbox" name="6" id="mana"/> 6</label>
                                        <label><input type="checkbox" name="7" id="mana"/> 7</label>
                                        <label><input type="checkbox" name="8" id="mana"/> 8</label>
                                        <label><input type="checkbox" name="9" id="mana"/> 9</label>
                                        <label><input type="checkbox" name="10" id="mana"/> 10</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Type</h3>
                                        <label><input type="checkbox" name="Spell" id="type"/> Spell</label>
                                        <label><input type="checkbox" name="Minion" id="type"/> Minion</label>
                                        <label><input type="checkbox" name="Weapon" id="type"/> Weapon</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Rarity</h3>
                                        <label><input type="checkbox" name="Common" id="rarity"/> Common</label>
                                        <label><input type="checkbox" name="Rare" id="rarity"/> Rare</label>
                                        <label><input type="checkbox" name="Epic" id="rarity"/> Epic</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Set</h3>
                                        <label><input type="checkbox" name="Basic" id="set_name"/> Basic</label>
                                        <label><input type="checkbox" name="Classic" id="set_name"/> Classic</label>
                                        <label><input type="checkbox" name="Whispers of the Old Gods" id="set_name"/> Whispers of the Old Gods</label>
                                        <label><input type="checkbox" name="Mean Streets of Gadgetzan" id="set_name"/> Mean Streets of Gadgetzan</label>
                                        <label><input type="checkbox" name="Journey to Un''Goro" id="set_name"/> Journey to Un'Goro</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left;">
                                        <h3>Tribe</h3>
                                        <label><input type="checkbox" name="Beast" id="tribe"/> Beast</label>
                                        <label><input type="checkbox" name="Demon" id="tribe"/> Demon</label>
                                        <label><input type="checkbox" name="Dragon" id="tribe"/> Dragon</label>
                                        <label><input type="checkbox" name="Elemental" id="tribe"/> Elemental</label>
                                        <label><input type="checkbox" name="Totem" id="tribe"/> Totem</label>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: left; margin-top: 15px;">
                                        <input class="btn btn-primary" type="submit" value="Filter">
                                            <a href="filter_list.php" class="btn btn-danger">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-bottom: 20px">
                <a href="filter_cards.php" class="btn btn-primary">Card View</a>
            </div>
        </div>

        <script>
            function filter()
            {
                var allCheckboxes = document.querySelectorAll('input[type=checkbox]');
                /* JavaScript arrays are dynamic. */
                var checkedCheckboxes = new Array;
                var url = "filter_list.php?";
                /* Checkboxes that are checked are added to the checkedValue array. */
                var j = 0;
                for (var i=0; allCheckboxes[i]; i++){
                    if(allCheckboxes[i].checked){
                        checkedCheckboxes[j] = allCheckboxes[i];
                        j++;
                    }
                }

                /* Append each id=name for a PHP query. */
                for (var i=0; checkedCheckboxes[i]; i++) {
                    url += checkedCheckboxes[i].id + "=" + checkedCheckboxes[i].name + "&";
                }
                url = url.slice(0, -1);

                location.href = url;
                return false;
            }
        </script>

        <div class="container">
            <div class="col-md-12">
                <p style="text-align: left;"><i><strong>*Click headers to sort. Default is by mana.</strong></i></p>
                    <?php
                    /* Supports parsing multiple variables of the same name, ex. type=common, type=rare */
                    function proper_parse_str($str) {
                        # result array
                        $arr = array();

                        # split on outer delimiter
                        $pairs = explode('&', $str);

                        # loop through each pair
                        if (!empty($pairs[0])) {
                            foreach ($pairs as $i) {
                                # split into name and value
                                list($name, $value) = explode('=', $i, 2);

                                # if name already exists
                                if (isset($arr[$name])) {
                                    # stick multiple values into an array
                                    if (is_array($arr[$name])) {
                                        $arr[$name][] = $value;
                                    } else {
                                        $arr[$name] = array($arr[$name], $value);
                                    }
                                } # otherwise, simply stick it in a scalar
                                else {
                                    $arr[$name] = $value;
                                }
                            }
                        }

                        # return result array
                        return $arr;
                    }

                    /* DB info. */
                    $host = "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com";
                    $db = "cardDevDB";
                    $user = "David";
                    $password = "arenatopdeck";

                    /* Connect to the DB, hide errors from being output to the user. */
                    mysqli_report(MYSQLI_REPORT_STRICT);
                    try {
                        $connect = mysqli_connect($host, $user, $password, $db);
                    } catch (Exception $e) {
                        echo 'Connection to database failed.';
                        exit();
                    }

                    $parsed_string = proper_parse_str($_SERVER['QUERY_STRING']);

                    /* Build MySQL query. */
                    $query = '';
                    $query .= "SELECT * FROM arenatopdeck WHERE name LIKE '%'";

                    if (!empty($parsed_string)) {
                        foreach ($parsed_string as $key => $val) {
                            if (is_array($val)) {
                                $query .= " AND (" . $key . " = '" . $val[0] . "'";
                                foreach ($val as &$array_content) {
                                    $query .= " OR " . $key . " = '" . $array_content . "'";
                                }
                                $query .= ")";
                            } else {
                                $query .= " AND " . $key . " = '" . $val . "'";
                            }
                        }
                        $query = urldecode($query);

                        // Reset $token since it still references the last element of the array.
                        unset($array_content);
                    }

                    $query .= " ORDER BY mana, name";
                    $result = mysqli_query($connect, $query);

                    /* Output each card as a line of a table. */
                    echo "<table class='sortable scale-in-center'>
                            <tr>
                                <th>Mana</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Type</th>
                                <th>Rarity</th>
                                <th>Set</th>
                            </tr>";

                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['mana'] . "</td>";
                        echo "<td><a href=\"/cards/" . $row['name_link'] . "\">" . $row['name'] .  "</a>";
                        echo "<td>" . $row['class'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
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