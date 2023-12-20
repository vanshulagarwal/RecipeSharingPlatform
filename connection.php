<?php
    $conn=mysqli_connect("localhost","root");
    if(mysqli_connect_errno()){
        echo "ERRORRRR: ".mysqli_connect_error();
    }
    
    if(!mysqli_query($conn,"create database if not exists foodrecipe")){
        echo "ERRORRRR: database not created";
    }
    mysqli_close($conn);
    

    $conn=mysqli_connect("localhost","root","","foodrecipe");
    if(mysqli_connect_errno()){
        echo "ERRORRRR: ".mysqli_connect_error();
    }

    $sql="CREATE TABLE IF NOT EXISTS Recipes(
        id int primary key auto_increment,
        dishname varchar(50),
        timereq int,
        vegtype varchar(20),
        dishtype varchar(20),
        ingredients varchar(500),
        process varchar(10000),
        imagepath varchar(50)
    )";

    if(!mysqli_query($conn,$sql)){
        echo "ERRORRRR: table not created";
    }
?>