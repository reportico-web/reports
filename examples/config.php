<?php
    $examples_host = "localhost";
    $examples_database = "";
    $examples_user = "";
    $examples_password = "";

    if ( !$examples_database ) {
        echo "To run the examples, ensure the file ".__FILE__." contains your db credentials and that the tutorials project is configured";
        die;
    }
?>
