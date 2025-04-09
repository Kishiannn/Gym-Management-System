<?php

function connection (){
    //database parameters
    $server_name = "localhost"; //domain name oi ip address of database
    $username = "root"; //defult is root
    $password = ""; //windows pw is balnk, "root" for mac
    $db_name = "store_db"; // database name
    
    // create a connection object
    $conn = new mysqli($server_name, $username, $password, $db_name);
    //mysqli is a PHP class from oracle built for connectiong to a MySql
    
    
    //Checks the connection
    if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
        //die is a function that terminates a function while printing a message
    }else{
        return $conn;
        //If there is no error, retain the conn object
    }
}
?>