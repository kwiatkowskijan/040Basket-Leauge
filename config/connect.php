<?php

    function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $database = "040basket_league";

        $connect = new mysqli($dbhost, $dbuser, $dbpassword, $database) or die ("Connect failed: %s\n".$connect -> error);
        return $connect;
    }
    
    function CloseCon($connect)
    {
        $connect -> close();
    }

?>