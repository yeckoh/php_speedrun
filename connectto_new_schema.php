<?php
function connecttoDB()
{
    $servername = 'localhost';
    $username = 'root';

    // create connection
    $conn = new mysqli($servername, $username);

    // verify connection
    if ($conn->connect_error)
        die("could not connect to sql database! " . $conn->connect_error);
    else
        echo ("we're connected to sql!");

    return $conn;
}
