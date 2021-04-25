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

        $query = "SELECT * from authors";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Номер</th><th>Име</th><th>Фамилия</th><th>Националност</th><th></th></tr>";
        echo "<tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<td>$row[0]</td>"
            . "<td>$row[1]</td>"
            . "<td>$row[2]</td>"
            . "<td>$row[3]</td>"
            . "<td>"
            . "<div class='btn-group'>"
            . "<a class='btn-secondary' href='author_update2.php?id=" . $row[0] . "'>Редактиране</a>"
            . "</div>"
            . "</td>"
            . "</tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>
