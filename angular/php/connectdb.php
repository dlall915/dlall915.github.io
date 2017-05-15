<?php
/**
 * Created by IntelliJ IDEA.
 * User: David
 * Date: 5/12/2017
 * Time: 5:08 PM
 */

define("HOSTNAME", "card-dev.cv6ut6qndgb2.us-east-1.rds.amazonaws.com");
define("USERNAME", "David");
define("PASSWORD", "arenatopdeck");
define("DATABASE", "cardDevDB");

$dbhandle = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE) or
die("Unable to connect to database.");

?>