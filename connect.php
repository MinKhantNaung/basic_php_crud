<?php

    $db = mysqli_connect('localhost', 'root', '', 'basic_php_crud');

    if($db == false) {
        die('Error' . mysqli_connect_error($db));
    } 
?>