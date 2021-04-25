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

        $query = "SELECT authors.FirstName,authors.LastName, Count(books.AuthorId)FROM
        books INNER JOIN authors ON books.AuthorId=authors.AuthorId 
        GROUP BY authors.FirstName
        ORDER BY authors.FirstName,authors.LastName";

        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Име</th><th>Фамилия</th><th>Брой книги</th></tr>";
        echo "<tr>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td></tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>