<?php
//DB info
$host = "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com";
$db = "cardDevDB";
$user = "David";
$password = "arenatopdeck";
$link = mysqli_connect($host, $user, $password, $db);

$output = '';

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$term = mysqli_real_escape_string($link, $_REQUEST['term']);

if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT * FROM arenatopdeck WHERE name LIKE '" . $term . "%'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){


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




            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['name'] . "</p>";



                $output .= '
               <tr>
                   <td>'.$row["name"].'</td>
                   <td>'.$row["class"].'</td>
                   <td>'.$row["mana"].'</td>
                   <td>'.$row["type"].'</td>
                   <td>'.$row["rarity"].'</td>
                   <td>'.$row["set_name"].'</td>
               </tr>';


            }
            echo $output;
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

// close connection
mysqli_close($link);
?>