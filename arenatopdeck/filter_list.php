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
</head>
<body>
    <!-- NAVIGATION -->
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="/">Home</a>
    </nav>
    <!-- NAVIGATION -->
    <div class="container">
        <h2>Filters</h2>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
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
                            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                                <h3>Type</h3>
                                <label><input type="checkbox" name="Spell" id="type"/> Spell</label>
                                <label><input type="checkbox" name="Minion" id="type"/> Minion</label>
                                <label><input type="checkbox" name="Weapon" id="type"/> Weapon</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                                <h3>Rarity</h3>
                                <label><input type="checkbox" name="Common" id="rarity"/> Common</label>
                                <label><input type="checkbox" name="Rare" id="rarity"/> Rare</label>
                                <label><input type="checkbox" name="Epic" id="rarity"/> Epic</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left; margin-top: 15px;">
                            <form onSubmit="return filter();">
                                <input type="submit" value="Filter">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                url += "&" + checkedCheckboxes[i].id + "=" + checkedCheckboxes[i].name;
            }

            location.href = url;
            return false;
        }
    </script>

    <div class="container">
        <div class="col-md-12">
                <?php
                /* TEST BEGIN */
                /* Supports parsing multiple variables of the same name, ex. type=common, type=rare */
                function proper_parse_str($str) {
                    # result array
                    $arr = array();

                    # split on outer delimiter
                    $pairs = explode('&', $str);

                    # loop through each pair
                    foreach ($pairs as $i) {
                        # split into name and value
                        list($name,$value) = explode('=', $i, 2);

                        # if name already exists
                        if( isset($arr[$name]) ) {
                            # stick multiple values into an array
                            if( is_array($arr[$name]) ) {
                                $arr[$name][] = $value;
                            }
                            else {
                                $arr[$name] = array($arr[$name], $value);
                            }
                        }
                        # otherwise, simply stick it in a scalar
                        else {
                            $arr[$name] = $value;
                        }
                    }

                    # return result array
                    return $arr;
                }

                $test = proper_parse_str($_SERVER['QUERY_STRING']);
                print_r($test);
                echo '<br>';
                print_r($test['class']);
                echo '<br>';
                print_r($test['rarity']);
                echo '<br>';
                echo '<br>';
                echo '<br>';

                /* Build MySQL query. */
                $query_test = '';
                $query_test .= "SELECT * FROM arenatopdeck WHERE name LIKE '%'";
                foreach ($test as &$value_test) {
                    echo '<br>';
                    print_r($value_test);
                    if (is_array($value_test)) {
                        echo '<br>';
                        print_r('true');
                    }
                    else {
                        echo '<br>';
                        print_r('false');
                    }
                }
                // Reset $token since it still references the last element of the array.
                unset($value_test);
                $query_test .= " ORDER BY mana, name";



                /* TEST END */

                /* Get the passed query and parse it into an array. */
                $query_string = $_SERVER['QUERY_STRING'];
                parse_str($query_string, $filter_array);

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

                /* Best implementation I could come up with to return all values from the database that share
                all the filter terms. */
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
                $result = mysqli_query($connect, $query);

                /* Output each card as a line of a table. */
                echo "<table class='scale-in-center'>
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