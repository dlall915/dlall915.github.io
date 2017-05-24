<?php

//database settings
include "connectdb.php";

/* Do this on GET ID request. */
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM students WHERE id = $id";
    $rs = $dbhandle->query($query);

    $row = $rs->fetch_array();
    $data = $row;

    print json_encode($data);
}

/* Otherwise show all the data */
else {
    $query = "SELECT * FROM students";
    $rs = $dbhandle->query($query);

    while ($row = $rs->fetch_array()) {
        $data[] = $row;
    }

    print json_encode($data);
}

?>