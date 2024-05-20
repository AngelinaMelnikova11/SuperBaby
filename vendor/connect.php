<?php

    $connect = mysqli_connect('localhost', 'root', 'root', 'baby');

    if (!$connect) {
        die('Error connect to DataBase');
    }