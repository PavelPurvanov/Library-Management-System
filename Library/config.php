<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
        $host= 'localhost';
        $dbUser= 'IS2021'; 
        $dbPass= 'IS2021'; 
        $dbName= 'library'; 
        if(!$dbConn=mysqli_connect($host, $dbUser, $dbPass)) { 
        die('Не може да се осъществи връзка със сървъра');}
        if(!mysqli_select_db($dbConn, $dbName)) {
        die('Не може да се осъществи връзка с базата от данни');
        }
        mysqli_query($dbConn,"SET NAMES 'UTF8'");
     ?>
    </body>
</html>