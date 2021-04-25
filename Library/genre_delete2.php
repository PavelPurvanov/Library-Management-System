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

        $id = $nameError = "";
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }

        $query = "DELETE FROM genre WHERE GenreId='" . $id . "'";
        $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));


        $query = "SELECT * from genre";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Номер</th><th>Вид</th></tr>";
        echo "<tr>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<td>$r[0]</td><td>$r[1]</td></tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>