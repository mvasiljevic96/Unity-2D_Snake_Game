<?php

    $con = mysqli_connect('localhost', 'root', '', 'unityaccess');
    
    //chech that connection happend
    if (mysqli_connect_errno())
    {
        echo "1: Connection failed."; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];

    //check if name already exists
    $namecheckquery = "SELECT username from players WHERE username= '" . $username . "';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed."); //error code #2 = namecheckquery failed

    if (mysqli_num_rows($namecheck) > 0)
    {
        echo "3: Name already exists"; //error code #3 = name exists, cannot register
        exit();
    }

    //add user to the table
    //convert password to salt and hash
    $salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
    $hash = crypt($password, $salt);
    $insertuserquery = "INSERT INTO players (username, hash, salt) VALUES ('" . $username . "', '" . $hash . "', '" . $salt . "');";
    mysqli_query($con, $insertuserquery) or die("4: Insert player query failed."); //error code #4 = insert query failed

    echo("0");

?>