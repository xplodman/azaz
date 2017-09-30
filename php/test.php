<?php

$os = array("test.phpa", "NT", "Irix", "Linux");

if (in_array(basename($_SERVER['PHP_SELF']), $os)) {
    echo "Got Irix";
}
?>