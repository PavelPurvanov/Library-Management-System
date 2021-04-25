<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include "config.php";
        include "menu_user.php";
        include "functions.php";

        $query = "SELECT * from genre";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Номер</th><th>Вид</th><th></th></tr>";
        echo "<tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<td>$row[0]</td>"
            . "<td>$row[1]</td>"
            . "<td>"
            . "<div class='btn-group'>"
            . "<a class='btn-secondary' href='genre_update2.php?id=" . $row[0] . "'>Редактиране</a>"
            . "</div>"
            . "</td>"
            . "</tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>