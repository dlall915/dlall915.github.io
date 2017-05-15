<?php
/**
 * Created by IntelliJ IDEA.
 * User: David
 * Date: 5/12/2017
 * Time: 5:17 PM
 */

//database settings
include "connectdb.php";

$query="SELECT * FROM arenatopdeck";
//$data = array();
$rs=$dbhandle->query($query);

while ($row = $rs->fetch_array()) {
    $data[] = $row;
}
    print json_encode($data);
?>