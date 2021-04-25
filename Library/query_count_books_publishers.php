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

        $query = "SELECT publishers.PublisherName, Count(books.PublisherId)FROM
        books INNER JOIN publishers ON books.PublisherId=publishers.PublisherId 
        GROUP BY publishers.PublisherName
        ORDER BY publishers.PublisherName";

        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Издателство</th><th>Брой книги</th></tr>";
        echo "<tr>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<td>$r[0]</td><td>$r[1]</td></tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>